<?php
	require_once('bootstrap.php');

//try{
    $router = factories::get()->obj('core_model_router');
    $request = factories::get()->obj('core_model_request');
    $router->dispatch($request);	
//}catch(Exception $e){
//    $controller = new errorController;
//    $controller->error($e->getMessage());
//}
