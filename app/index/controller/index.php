<?php

class index_controller_index extends core_controller_abstract
{
	
	public function index()
    {
        $session = factories::get()->obj('session_model_session');

        if (!$session->user()->isLoggedIn()) {
            $session->info('Please log in to get access for panels.');
        }

	    $this->view('index/view/index');	
	}
}
