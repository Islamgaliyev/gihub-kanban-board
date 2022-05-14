<?php

namespace Tests\Feature\Services;

use App\Services\Authorization;
use App\Services\Exceptions\InvalidGithubResponseException;
use Github\Client;
use Github\Exception\ErrorException;
use Http\Client\Common\HttpMethodsClientInterface;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Tests\HasConfigs;

class AuthorizationTest extends TestCase
{
    use HasConfigs;

    public function testSuccessGetAccessToken()
    {
        $this->mockConfigs();

        $code = '123';
        $state = 'state';

        $client = m::mock(Client::class);
        $httpMethod = m::mock(HttpMethodsClientInterface::class);
        $response = m::mock(ResponseInterface::class);
        $stream = m::mock(StreamInterface::class);

        $client->shouldReceive('getHttpClient')->andReturn($httpMethod);
        $httpMethod->shouldReceive('post')->withArgs([
            'https://github.com/login/oauth/access_token',
            [
                'Content-type' => 'application/x-www-form-urlencoded',
            ],
            http_build_query([
                'code' => $code,
                'state' => $state,
                'client_id' => 'test_gh_client_id',
                'client_secret' => 'test_gh_client_secret',
            ]),
        ])->andReturn($response);
        $response->shouldReceive('getBody')->andReturn($stream);
        $stream->shouldReceive('__toString')->andReturn(json_encode([
            'access_token' => 'access_token',
            'type' => 'bearer',
            'scope' => 'repo',
        ], JSON_THROW_ON_ERROR));


        $this->assertEquals('access_token', (new Authorization($client))->getAccessToken($code, $state));
    }

    public function testInvalidResponseFromGithubOnGetAccessToken()
    {
        $this->mockConfigs();

        $code = '123';
        $state = 'state';

        $client = m::mock(Client::class);
        $httpMethod = m::mock(HttpMethodsClientInterface::class);
        $response = m::mock(ResponseInterface::class);
        $stream = m::mock(StreamInterface::class);

        $client->shouldReceive('getHttpClient')->andReturn($httpMethod);
        $httpMethod->shouldReceive('post')->withArgs([
            'https://github.com/login/oauth/access_token',
            [
                'Content-type' => 'application/x-www-form-urlencoded',
            ],
            http_build_query([
                'code' => $code,
                'state' => $state,
                'client_id' => 'test_gh_client_id',
                'client_secret' => 'test_gh_client_secret',
            ]),
        ])->andReturn($response);
        $response->shouldReceive('getBody')->andReturn($stream);
        $stream->shouldReceive('__toString')->andReturn(json_encode([
            'error' => 'bad_verification_code',
            'error_description' => 'The code passed is incorrect or expired.',
            'error_uri' => 'https://docs.github.com/apps/managing-oauth-apps/troubleshooting-oauth-app-access-token-request-errors/#bad-verification-code',
        ], JSON_THROW_ON_ERROR));


        $this->expectException(InvalidGithubResponseException::class);

        (new Authorization($client))->getAccessToken($code, $state);
    }

    public function testExceptionOnGetAccessToken()
    {
        $this->mockConfigs();

        $code = '123';
        $state = 'state';

        $client = m::mock(Client::class);
        $httpMethod = m::mock(HttpMethodsClientInterface::class);

        $client->shouldReceive('getHttpClient')->andReturn($httpMethod);
        $httpMethod->shouldReceive('post')->withArgs([
            'https://github.com/login/oauth/access_token',
            [
                'Content-type' => 'application/x-www-form-urlencoded',
            ],
            http_build_query([
                'code' => $code,
                'state' => $state,
                'client_id' => 'test_gh_client_id',
                'client_secret' => 'test_gh_client_secret',
            ]),
        ])->andThrow(ErrorException::class);

        $this->expectException(InvalidGithubResponseException::class);

        (new Authorization($client))->getAccessToken($code, $state);
    }
}
