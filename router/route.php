<?php

require_once("vendor/autoload.php");
use Pux\Mux;

$mux = new Mux;

//$mux->any('/', ['Mvc\Controller\TemplateController', 'index']);
//
//$mux->post('/gameNumUpdate', ['Mvc\Controller\Controller', 'gameNumUpdate']);
//
//$mux->post('/orderResultUpdate', ['Mvc\Controller\Controller', 'orderResultUpdate']);
//
//$mux->get('/ordersResult', ['Mvc\Controller\Controller', 'ordersResult']);
//
//$mux->get('/gameResult', ['Mvc\Controller\Controller', 'gameResult']);

$mux->any('/', ['Mvc\Controller\TemplateController', 'index']);
$mux->post('/gameNumUpdate', ['Mvc\Controller\MainController', 'gameNumUpdate']);
$mux->post('/orderResultUpdate', ['Mvc\Controller\MainController', 'orderResultUpdate']);
$mux->get('/ordersResult', ['Mvc\Controller\MainController', 'ordersResult']);
$mux->get('/gameResult', ['Mvc\Controller\MainController', 'gameResult']);
return $mux;