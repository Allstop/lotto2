<?php
namespace Mvc\Controller;

use Mvc\Core\Template;

class TemplateController
{
    public static $template = null;
    public function __construct()
    {
        self::$template = new Template(implode('/', array(dirname(dirname(dirname(__DIR__))), 'public')));
    }

    public function index()
    {
        return self::$template->render();
    }
}
