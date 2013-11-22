<?php
require_once('bootstrap.php');

$router = factories::get()->obj('core_model_router');
$request = factories::get()->obj('core_model_request');
$router->dispatch($request);	
