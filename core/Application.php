<?php

namespace app\core;

class Application
{
    public static string $ROOT_PATH;
    public Router $router;
    public Request $request;

    public static Application $app;

    public function __construct($rootPath)
    {
        $this->request = new Request();
        $this->router = new Router($this->request);

        self::$ROOT_PATH = $rootPath;
        self::$app = $this;
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}