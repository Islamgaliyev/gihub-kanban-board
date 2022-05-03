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
