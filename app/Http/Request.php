<?php

namespace App\Http;

class Request
{
    public array $get = [];
    public array $post = [];
    public array $cookie = [];
    public array $files = [];
    public array $request = [];
    public array $server = [];
    public string $route;

    public function __construct()
    {
        $this->route = $this->clean($_SERVER['REQUEST_URI']);
        $this->get = $this->clean($_GET);
        $this->post = $this->clean($_POST);
        $this->request = $this->clean($_REQUEST);
        $this->cookie = $this->clean($_COOKIE);
        $this->files = $this->clean($_FILES);
        $this->server = $this->clean($_SERVER);
    }

    public function clean(array|string $data): array|string
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                unset($data[$key]);
                $data[$this->clean($key)] = $this->clean($value);
            }
        } else {
            $data = htmlspecialchars($data, ENT_COMPAT);
        }

        return $data;
    }
}
