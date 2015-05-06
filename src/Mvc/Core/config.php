<?php

namespace Mvc\Core;

class config
{
    public static $db = null;

    public function __construct($filename = null, $path = null)
    {
        self::$db = array();
        if (!$path) {
            $path =dirname(dirname(dirname(__DIR__))).'/config';
        }
        if (!$filename) {
            $filename = 'config.php';
        }
        self::$db = require_once(implode('/',array($path, $filename)));
    }

    public static function getDB()
    {
        return self::$db;
    }

    public static function forge($filename = null, $path = null)
    {
        return new self($filename, $path);
    }

    public static function get($name)
    {
        return isset(self::$db[$name])? self::$db[$name] : "";
    }

    public static function set($name, $value)
    {
        self::$db[$name] = $value;
    }

    public function has($name)
    {
        return isset(self::$db[$name]);
    }
}
