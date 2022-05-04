<?php

namespace App\Services;

use App\Services\Exceptions\InvalidGithubResponseException;
use Github\Client;
use Http\Client\Exception;

class GithubAuthorization
{
    public const ACCESS_TOKEN_URL = 'https://github.com/login/oauth/access_token';

    public const AUTHORIZE_URL = 'https://github.com/login/oauth/authorize';

    protected string $clientId;

    protected string $clientSecret;

    public function __construct(protected Client $client)
    {
        $this->clientId = config('gh_client_id');
        $this->clientSecret = config('gh_client_secret');
    }

    public function getAccessToken(string $code, string $state): string
    {
        try {
            $responseString = $this->client->getHttpClient()->post(
                self::ACCESS_TOKEN_URL,
                [
                    'Content-type' => 'application/x-www-form-urlencoded',
                ],
                http_build_query([
                    'code' => $code,
                    'state' => $state,
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                ])
            )->getBody()->__toString();

            $response = json_decode($responseString, true, 512, JSON_THROW_ON_ERROR);

            if (!array_key_exists('access_token', $response)) {
                throw new InvalidGithubResponseException($responseString);
            }

            return $response['access_token'];
        } catch (Exception $e) {
            throw new InvalidGithubResponseException($e->getMessage(), 400, $e);
        }
    }

    public function authorize(): void
    {
        $state = substr(md5(mt_rand()), 0, 10);

        $url = 'Location: ' . self::AUTHORIZE_URL;
        $url .= '?client_id=' . $this->clientId;
        $url .= '&scope=repo';
        $url .= '&state=' . $state;

        header($url);
    }
}
