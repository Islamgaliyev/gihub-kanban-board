<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$kernel = new \App\Http\Kernel();

$kernel->handle();
