<?php

namespace Mvc\Core;

class app
{
    public static $db = null;

    public static $config = null;

    public static $input = null;

    public function __construct($filename = null, $path = null)
    {
        self::$config = config::forge($filename, $path);
        $this->getDB();
    }

    public static function forge($filename = null, $path = null)
    {
        return new self($filename, $path);
    }
    public static function getDB()
    {
        if (self::$db == null) {
            if ( self::$config == null ) {
                return '請先新增物件';
            }
            try {
                $tmp = config::get('db');
                self::$db = new \PDO($tmp['dsn'], $tmp['user'], $tmp['pwd']);
            } catch (\Exception $e) {
                echo $e->getMessage();
                return '資料庫設定錯誤';
            }
        }

        return self::$db;
    }

    public static function getConfig()
    {
        if (self::$config == null) {
            return '請先新增物件！';
        }
        return self::$config;
    }

    public static function getInput()
    {
        self::$input = Input::forge();
        return self::$input;
    }
}