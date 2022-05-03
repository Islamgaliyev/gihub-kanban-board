<?php

namespace App\Http;

class Kernel
{
    public function handle()
    {
        session_start();

        new Router(new Request());
    }
}
