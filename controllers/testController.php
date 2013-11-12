<?php

class testController extends baseController{
	
	public function index()
    {
		$get = $this->post();
        $vars['posts'] = $get;
	    $this->view('test', $vars);	
	}

	public function add()
    {
		$get = $this->post();
        $vars['posts'] = $get;
	    $this->view('test', $vars);	
	}
}
