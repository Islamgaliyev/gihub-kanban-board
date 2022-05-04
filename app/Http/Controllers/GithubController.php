<?php

namespace App\Http\Controllers;

use App\Http\Request;

class GithubController extends BaseController
{
    public function callback(Request $request)
    {
        $token = $this->githubAuthorization->getAccessToken($request->get('code'), $request->get('state'));

        $_SESSION['gh-token'] = $token;

        header('Location: ' . config('app_main_page_url'));
    }
}
