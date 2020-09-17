<?php

namespace App\Core;

class View
{
    private $layout;

    public function __construct($layout = 'layout')
    {
        $this->layout = basename($layout);
    }

    public function render($name, $args = [])
    {
        ob_start();
        extract($args);
        $viewPath = "app/view/$name.phtml";
        include BP . DIRECTORY_SEPARATOR . $viewPath;
        $content = ob_get_clean();

        if($this->layout) {
            $layoutPath = "app/view/{$this->layout}.phtml";
            include BP . DIRECTORY_SEPARATOR . $layoutPath;
        } else {
            echo $content;
        }

        return $this;
    }
}