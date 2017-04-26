<?php

require __DIR__ . '/../RestServer/RestServer.php';
require 'FibonacciController.php';

$server = new \RestServer\RestServer('debug');
$server->addClass('FibonacciController');
$server->handle();
