<?php

namespace vendor\core\base;


class View
{
    /**
     * текущий маршрут
     *
     * @var array
     */
    public $route = [];

    /**
     * текущий вид
     *
     * @var string
     */
    public $view;

    /**
     * текущий шаблон
     *
     * @var string
     */
    public $layout;

    public $scripts = [];

    public static $meta = ['title' => '', 'desc' => '', 'keywords' => ''];


    /**
     * View constructor.
     * @param $route
     * @param null|string $layout
     * @param null|string $view
     */
    public function __construct($route, ?string $layout = '', ?string $view = '')
    {
        $this->route = $route;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        };
        $this->view = $view;
    }

    /**
     * @param array $vars
     */
    public function render(array $vars)
    {
        if (is_array($vars)) {
            extract($vars);
        }

        $file_view = APP . "/views/{$this->route['controller']}/{$this->view}.php";
        ob_start();
        if (is_file($file_view) && file_exists($file_view)) {
            require $file_view;
        } else {
            echo "<p>Не найден вид <b>{$file_view}</b></p>";
        }
        $content = ob_get_clean();


        if (false !== $this->layout) {
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($file_layout) && file_exists($file_layout)) {
                $content = $this->getScript($content);
                $scripts = [];
                if (!empty($this->scripts[0])) {
                    $scripts = $this->scripts[0];
                };
                require $file_layout;
            } else {
                echo "<p>Не найден шаблон <b>{$file_layout}</b></p>";
            }
        }

    }

    protected function getScript($content)
    {
        $pattern = "#<script.*?>.*?</script>#si";
        preg_match_all($pattern, $content, $this->scripts);
        if (!empty($this->scripts)) {
            $content = preg_replace($pattern, '', $content);
        }
        return $content;
    }

    public static function getMeta()
    {
        echo '<title>' . self::$meta['title'] . '</title>
        <meta name ="description" content ="' . self::$meta['desc'] . '">
        <meta name ="keywords" content ="' . self::$meta['keywords'] . '">';
    }

    public static function setMeta(string $title = '', string $desc = '', string $keywords = '')
    {
        self::$meta['title'] = $title;
        self::$meta['desc'] = $desc;
        self::$meta['keywords'] = $keywords;
    }

}