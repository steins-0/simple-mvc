<?php

namespace app\core;

class Controller
{
    /**
     * Render the page with the params
     * @param $view
     * @param array $params
     * @return false|string
     */
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
}