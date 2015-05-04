<?php

require "vendor/autoload.php";

use Pux\Executor;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

$mux = require "router/route.php";

$route = $mux->dispatch($_SERVER['DOCUMENT_URI']);
echo Executor::execute($route);