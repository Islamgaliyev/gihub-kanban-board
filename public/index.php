<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use App\Http\Kernel;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$kernel = new Kernel();

$kernel->handle();
