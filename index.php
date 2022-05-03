<?php

session_start();

require_once(__DIR__ . '/vendor/autoload.php');

use App\KanbanBoard\Application;
use App\KanbanBoard\Authentication;
use App\KanbanBoard\Github;
use App\Utilities;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$repositories = explode('|', Utilities::env('GH_REPOSITORIES'));

$authentication = new Authentication();
$token = $authentication->login();

$github = new Github($token, Utilities::env('GH_ACCOUNT'));

$board = new Application($github, $repositories, array('waiting-for-feedback'));
$data = $board->board();

$m = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(__DIR__ . '/views'),
));

echo $m->render('index', array('milestones' => $data));
