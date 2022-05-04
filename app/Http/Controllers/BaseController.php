<?php

namespace App\Http\Controllers;

use App\Services\GithubAuthorization;
use Github\Client;
use Mustache_Engine;

abstract class BaseController
{
    protected GithubAuthorization $githubAuthorization;

    public function __construct(protected Mustache_Engine $view)
    {
        $this->githubAuthorization = new GithubAuthorization(new Client());
    }
}
