<?php

namespace App\Lib;

class View
{
    const VIEWS_FOLDER = __DIR__ . '/../../views/';

    public static function render($action, $options = [])
    {
        if (empty($action) || !file_exists(self::VIEWS_FOLDER . $action . '.php')) {
            header("Location: /404");
            exit();
        }
        foreach ($options as $key => $option) {
            $$key = $option;
        }
        include(self::VIEWS_FOLDER . $action . '.php');
    }
}
