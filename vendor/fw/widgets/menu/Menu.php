<?php

namespace fw\widgets\menu;

use \R;
use fw\libs\Cache;

class Menu
{

    protected $data;
    protected $tree;
    protected $menuHtml;
    protected $tpl = WIDGET_MENU;
    protected $container = 'ul';
    protected $class = 'menu';
    protected $table = 'categories';
    protected $cache = 3600;
    protected $cacheKey = 'fw_menu';


    public function __construct(array $options)
    {
        if (!empty($options)) {
            $this->getOptions($options);
        }
        $this->run();
    }


    protected function getOptions(array $options)
    {
        foreach ($options as $k => $v) {
            if (property_exists($this, $k) && $v !== '') {
                $this->$k = $v;
            }
        }
    }


    protected function run()
    {
        $this->checkCache();
        $this->output();
    }


    protected function checkCache()
    {
        $cache = new Cache();
        $this->menuHtml = $cache->get($this->cacheKey);
        if (!$this->menuHtml) {
            $this->setCache($cache);
        }
    }

    protected function setCache(Cache $cache)
    {
        $this->data = R::getAssoc("SELECT * FROM {$this->table}");
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
        $cache->set($this->cacheKey, $this->menuHtml, $this->cache);
    }

    protected function getTree()
    {
        $tree = [];
        $data = $this->data;
        foreach ($data as $id => &$node) {
            if (!$node['parent']) {
                $tree[$id] = &$node;
            } else {
                $data[$node['parent']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }


    protected function getMenuHtml(array $tree, string $tab = '')
    {
        $str = '';
        foreach ($tree as $id => $node) {
            $str .= $this->catToTemplate($node, $tab, $id);
        }
        return $str;
    }

    protected function catToTemplate(array $node, string $tab, string $id)
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }


    protected function output()
    {
        echo "<{$this->container} class='{$this->class}'>";
        echo $this->menuHtml;
        echo "</{$this->container}>";
    }
}