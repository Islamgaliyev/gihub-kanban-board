<?php

if (!function_exists('dd')) {
    function dd(...$data): void
    {
        foreach ($data as $v) {
            echo '<pre>';
            print_r($v);
            echo "</pre>";
        }

        exit;
    }
}

if (!function_exists('env')) {
    function env($name, $default = null)
    {
        $value = $_ENV[$name];

        if (!empty($value)) {
            return $value;
        }

        return $default ?? die('Environment variable ' . $name . ' not found or has no value');
    }
}

if (!function_exists('config')) {
    function config($key, $default = null)
    {
        $appConfigs = include(__DIR__ . '/../config/app.php');

        $value = $appConfigs[$key];

        if (!empty($value)) {
            return $value;
        }

        return $default;
    }
}
