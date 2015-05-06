<?php

namespace Mvc\Sys;

use Mvc\Core\app;
class controller
{
    public static $app = null;

    public static function init()
    {
        self::$app = app::forge();
        self::$app->getInput();
    }
}