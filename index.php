<?php
require_once('bootstrap.php');

$location = $_SERVER['REQUEST_URI'];

$router = factories::get()->obj('core_model_router');
$request = factories::get()->obj('core_model_request');
$request->location($location);
$router->dispatch($request);	
