<?php

require_once("vendor/autoload.php");
use Pux\Mux;

$mux = new Mux;

$mux->any('/', ['Mvc\Controller\TemplateController', 'index']);

$mux->post('/gameNum', ['Mvc\Controller\Controller', 'gameNum']);

$mux->post('/cusResult', ['Mvc\Controller\Controller', 'cusOrderResult']);

$mux->get('/result', ['Mvc\Controller\Controller', 'result']);

$mux->get('/gameid', ['Mvc\Controller\Controller', 'gameid']);

return $mux;