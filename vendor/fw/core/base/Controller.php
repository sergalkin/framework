<?php

namespace fw\core\base;


abstract class Controller
{

    /**
     * Текущий маршрут
     * @var array
     */
    public $route = [];

    /**
     * вид
     * @var string
     */
    public $view;

    /**
     * Текущий шаблон
     * @var string
     */
    public $layout;

    /**
     * пользовательские данные
     * @var array
     */
    public $vars = [];

    /**
     * Controller constructor.
     * @param array $route
     */
    public function __construct(array $route)
    {
        $this->route = $route;
        $this->view = $route['action'];
    }

    /**
     *
     */
    public function getView()
    {
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->vars);
    }

    /**
     * @param $vars
     */
    public function set($vars)
    {
        $this->vars = $vars;
    }

    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function loadView(string $view, array $vars = [])
    {
        extract($vars);
        require APP . "/views/{$this->route['controller']}/{$view}.php";
    }

}