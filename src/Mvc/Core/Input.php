<?php

namespace Mvc\Core;

class Input
{
    public static $data = null;

    public function __construct()
    {
        self::$data = array();
        self::$data = array_merge($_POST, $_GET);

    }

    public static function getData()
    {
        return self::$data;
    }

    public static function forge()
    {
        return new self();
    }

    public static function get($name, $value = null)
    {
        return isset(self::$data[$name])? self::$data[$name] : $value;
    }
    
    public static function has($name)
    {
        return isset(self::$data[$name]);
    }
}