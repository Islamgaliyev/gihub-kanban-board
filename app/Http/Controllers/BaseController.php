<?php

namespace App\Http\Controllers;

use App\Services\Authorization;
use Github\Client;
use Mustache_Engine;

abstract class BaseController
{
    protected Authorization $githubAuthorization;

    public function __construct(protected Mustache_Engine $view)
    {
        $this->githubAuthorization = new Authorization(new Client());
    }
}
