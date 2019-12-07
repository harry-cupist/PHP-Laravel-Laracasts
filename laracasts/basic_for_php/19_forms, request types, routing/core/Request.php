<?php

class Request
{
    public static function uri()
    {
        //names?name=harry

        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    }
}