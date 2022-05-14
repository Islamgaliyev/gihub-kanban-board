<?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Services\BoardBuilder;
use Github\Client;

class BoardController extends BaseController
{
    public function index(Request $request): void
    {
        if (!array_key_exists('gh-token', $_SESSION)) {
            $this->githubAuthorization->authorize();

            return;
        }

        $milestones = (new BoardBuilder(new Client()))->build($_SESSION['gh-token']);

        echo $this->view->render('index', array('milestones' => $milestones));
    }
}
