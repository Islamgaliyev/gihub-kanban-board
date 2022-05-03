<?php

namespace App\Http\Controllers;

use Mustache_Engine;

abstract class BaseController
{
    public function __construct(protected Mustache_Engine $view)
    {
    }
}
