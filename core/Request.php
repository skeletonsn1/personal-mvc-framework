<?php

namespace app\core;

class Request
{
    const REQUEST_GET  = 'get';
    const REQUEST_POST = 'post';

    public function getPath()
    {
        $path     = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if ($position === false) {
            return $path;
        }

        return substr($path, 0, $position);
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->getMethod() === self::REQUEST_GET;
    }

    public function isPost()
    {
        return $this->getMethod() === self::REQUEST_POST;
    }

    public function getBody()
    {
        $body = [];
        
        if ($this->getMethod() === self::REQUEST_GET) {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->getMethod() === self::REQUEST_POST) {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}