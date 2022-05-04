<?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Services\Application;
use App\Services\Board;
use Github\Client;
use Mustache_Engine;

class BoardController extends BaseController
{
    protected Board $board;

    public function __construct(Mustache_Engine $view)
    {
        parent::__construct($view);

        $this->board = (new Board(new Client()));
    }

    public function index(Request $request)
    {
        if (!array_key_exists('gh-token', $_SESSION)) {
            $this->githubAuthorization->authorize();

            return;
        }

        $milestones = $this->board->milestones($_SESSION['gh-token']);

        echo $this->view->render('index', array('milestones' => $milestones));
    }
}
