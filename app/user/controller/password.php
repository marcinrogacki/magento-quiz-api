<?php

class user_controller_password extends core_controller_abstract 
{
	public function index()
    {
        $this->view('user/view/password');
    }

	public function post()
    {
        $request = $this->request();
        $password = $request->post('password');
        $user = $request->session()->user();
        if ($user->changePassword($password)) {
            $request->session()->success('Password has been changed');
            $request->action('index');
        } else {
            $request->action('index');
            $request->session()->error('Password has not been changed.');
            $request->session()->info('Remeber that password requires at least 8 chars.');
        }

        return $request;
    }
}
