<?php

namespace app\core;

class Router
{
    public $routes = [];

    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get method request
     * @param $url
     * @param $callback
     */
    public function get($url, $callback)
    {
        $this->routes['GET'][$url] = $callback;
    }

    /**
     * Post method request
     * @param $url
     * @param $callback
     */
    public function post($url, $callback)
    {
        $this->routes['POST'][$url] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            return $this->renderView('404');
        }

        /**
         * If the callback is an array containing
         * the name of the class and the method name,
         * then create an instance of the controller
         */
        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        /**
         * If the callback is a string,
         * then return a view
         */
        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        return call_user_func($callback, $this->request);
    }

    /**
     * Render the page and its parameters
     * @param $view
     * @param array $params
     * @return false|string
     */
    public function renderView($view, $params = [])
    {
        $viewContent = $this->renderOnlyView($view, $params);
        $layoutContent = $this->renderLayout();

        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }

    /**
     * Render only the view with parameters
     * @param $view
     * @param array $params
     * @return false|string
     */
    public function renderOnlyView($view, $params = [])
    {
        foreach ($params as $key => $param) {
            $$key = $param;
        }

        ob_start();
        include_once('../views/' . $view . '.php');
        return ob_get_clean();
    }

    /**
     * Render the layout of the page
     * @return false|string
     */
    public function renderLayout()
    {
        ob_start();
        include_once('../views/layouts/main.php');
        return ob_get_clean();
    }
}