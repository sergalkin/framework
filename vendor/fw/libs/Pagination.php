<?php

namespace fw\libs;


class Pagination
{
    public $currentPage;
    public $perpage;
    public $total;
    public $countPages;
    public $uri;


    public function __construct($page, $perpage, $total)
    {
        $this->perpage = $perpage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
    }

    public function __toString()
    {
        return $this->getHtml();
    }

    public function getHtml()
    {
        $back = null; //ссылка НАЗАД
        $forward = null; // ссылка ВПЕРЕД
        $startPage = null; // ссылка В НАЧАЛО
        $endPage = null; // ссылка В КОНЕЦ
        $pageTwoLeft = null; // вторая страница слева
        $pageOneLeft = null; // первая страница слева
        $pageTwoRight = null; // вторая страница справа
        $pageOneRight = null; // первая страница справа

        if ($this->currentPage > 1) {
            $back = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" .
                ($this->currentPage - 1) . "'>&lt;</a></li>";
        }

        if ($this->currentPage < $this->countPages) {
            $forward = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" .
                ($this->currentPage + 1) . "'>&gt;</a></li>";
        }

        if ($this->currentPage > 3) {
            $startPage = "<li class='page-item'><a class='page-link' href='{$this->uri}page=1'>&laquo;</a></li>";
        }

        if ($this->currentPage < ($this->countPages - 2)) {
            $endPage = "<li class='page-item'><a class='page-link' href='{$this->uri}page={$this->countPages}'>&raquo;</a></li>";
        }

        if ($this->currentPage - 2 > 0) {
            $pageTwoLeft = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" .
                ($this->currentPage - 2) . "'>" . ($this->currentPage - 2) . "</a></li>";
        }

        if ($this->currentPage - 1 > 0) {
            $pageOneLeft = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" .
                ($this->currentPage - 1) . "'>" . ($this->currentPage - 1) . "</a></li>";
        }

        if ($this->currentPage + 2 <= $this->countPages) {
            $pageTwoRight = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" .
                ($this->currentPage + 2) . "'>" . ($this->currentPage + 2) . "</a></li>";
        }

        if ($this->currentPage + 1 <= $this->countPages) {
            $pageOneRight = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" .
                ($this->currentPage + 1) . "'>" . ($this->currentPage + 1) . "</a></li>";
        }
        return '<ul class="pagination justify-content-center">' . $startPage . $back . $pageTwoLeft . $pageOneLeft .
            '<li class="page-item active"><a class="page-link">' . $this->currentPage . '</a></li>' .
            $pageOneRight . $pageTwoRight . $forward . $endPage . '</ul>';
    }

    public function getCountPages()
    {
        return ceil($this->total / $this->perpage) ?: 1;
    }

    public function getCurrentPage($page)
    {
        if (!$page || $page < 1) {
            $page = 1;
        }
        if ($page > ($this->countPages)) {
            $page = $this->countPages;
        }
        return $page;
    }

    public function getStart()
    {
        return ($this->currentPage - 1) * $this->perpage;
    }

    public function getParams()
    {
        $url = $_SERVER['REQUEST_URI'];

        $url = explode('?', $url);

        $uri = $url[0] . '?';
        if (isset($url[1]) && $url[1] != '') {
            $params = explode('&', $url[1]);
            foreach ($params as $param) {
                if (!preg_match("#page=#", $param)) {
                    $uri .= "{$param}&amp;";
                }
            }
        }
        return $uri;
    }
}