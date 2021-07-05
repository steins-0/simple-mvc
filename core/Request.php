<?php

namespace app\core;

class Request
{
    /**
     * Get the url path
     * @return false|mixed|string
     */
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        // Verify if the url path have question mark
        $position = strpos($path, '?');

        if ($position === false) {
            return $path;
        }

        return substr($path, 0, $position);
    }
    /**
     * Get the request method name
     * @return mixed
     */
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Filter the request data and
     * get the body
     * @return array
     */
    public function getBody()
    {
        $body = [];

        if ($this->method() === 'GET') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_var($value);
            }
        }

        if ($this->method() === 'POST') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_var($value);
            }
        }

        return $body;
    }

    public function dd(...$data)
    {
        foreach ($data as $value) {
            if (is_array($value) || is_object($value)) {
                echo '<pre>'; print_r($value); die;
            } else {
                echo $value;
            }
        }
    }
}