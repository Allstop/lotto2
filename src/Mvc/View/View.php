<?php
namespace Mvc\View;
class View
{
    public static function render($data)
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}