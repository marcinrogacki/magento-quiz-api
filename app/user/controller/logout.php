<?php

class user_controller_logout extends core_controller_abstract 
{
	public function index()
    {
    }

	public function post()
    {
        $user = factories::get()->obj('session_model_user');
        $user->logout();

        $request = factories::get()->obj('core_model_request');
        $request->location('index');
        return $request;
    }
}
