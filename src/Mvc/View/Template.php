<?php
namespace Mvc\View;

class Template
{
    public static $twig = null;
    public static $path = null;
    public function __construct($path)
    {
        self::$path = $path;
        $loader = new \Twig_Loader_Filesystem($path);
        self::$twig = new \Twig_Environment($loader);
    }
    public static function forge($path)
    {
        return new self($path);
    }
    public static function getTwig()
    {
        return self::$twig;
    }
    public static function render($filename = 'index.html', $array = array())
    {
        if (self::$twig != null) {
            return ($array) ? self::$twig->render($filename, $array) : self::$twig->render($filename);
        } else {
            return 'template error: params error';
        }
    }
    public static function getPath()
    {
        return self::$path;
    }
}