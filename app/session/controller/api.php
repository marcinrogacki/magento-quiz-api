<?php

class session_controller_api extends core_controller_api_abstract 
{
    public function isAllowed()
    {
        return true;
    }

    public function index() 
    {
    }

	public function secret()
    {
        $email = $this->request()->post()->get('email');
        $password = $this->request()->post()->get('password');

        $apiSession = factories::get()->obj('session_model_api');
        $secret = $apiSession->generateSecret($email, $password);

        if (!$secret) {
            $data['email'] = 'Cannot authenticate'; 
            $data['password'] = 'Cannot authenticate'; 
            $this->response($data, core_model_api_jsend::JSEND_FAIL);
        } else {
            $data['secret'] = $secret;
            $this->response($data);
        }
	}
}
