<?php
namespace Mvc\Controller;

use Mvc\View\Template;

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
