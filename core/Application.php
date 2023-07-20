<?php

namespace app\core;

/**
 * @package app\core
 */
class Application
{
    public static string $ROOT_DIR;
    public static Application $APP;

    public Router $router;
    public Response $response;
    public Request $request;
    public Controller $controller;
    public Translator $translator;

    public function __construct(string $rootDirectory, string $translationDirectory)
    {
        self::$ROOT_DIR = $rootDirectory;
        
        $this->request    = new Request();
        $this->response   = new Response();
        $this->translator = new Translator();
        
        $this->translator->setPath($translationDirectory);

        $this->router   = new Router(
            $this->request,
            $this->response,
            $this->translator
        );

        self::$APP = $this;
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
