<?php

class user_controller_login extends core_controller_abstract 
{
	public function index()
    {
    }

	public function post()
    {
        $email = $this->request()->post()->get('email');
        $passwd = $this->request()->post()->get('password');

        $session = $this->request()->session();

        $user = factories::get()->obj('session_model_user');
        if ($user->login($email, $passwd)) {
            $session->success('Successfully logged in');
        } else {
            $session->error('Invalid login credentials');
        }

        $request = factories::get()->obj('core_model_request');
        $request->location('index');
        return $request;
    }
}
