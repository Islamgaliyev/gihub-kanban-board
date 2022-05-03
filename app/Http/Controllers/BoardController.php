<?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Services\Application;
use App\Services\Authentication;
use App\Services\Github;
use App\Utilities;

class BoardController extends BaseController
{
    public function index(Request $request)
    {
        $repositories = explode('|', Utilities::env('GH_REPOSITORIES'));

        $authentication = new Authentication();
        $token = $authentication->login();

        $github = new Github($token, Utilities::env('GH_ACCOUNT'));

        $board = new Application($github, $repositories, array('question'));
        $data = $board->board();

        echo $this->view->render('index', array('milestones' => $data));
    }
}
