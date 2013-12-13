<?php

class user_controller_login extends core_controller_abstract 
{
	public function index()
    {
        $session = factories::get()->obj('session_model_session');
        $session->cookie('frontend', 'robak');
        $request = factories::get()->obj('core_model_request');
        $request->location('index');
        return $request;
    }
}
