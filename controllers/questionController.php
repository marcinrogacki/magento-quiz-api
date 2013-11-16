<?php

class questionController extends baseController
{
    public function index() 
    {
        http_response_code(501);
    }

	public function add()
    {
        $question = $this->model('question');
        $vars = [
            'title' => 'Add question',
            'js'    => [],
        ];
        $this->view('question/add', $vars);
	}
    
    public function addPost()
    {
        var_dump($this->post());
        //$this->redirect('/question/add'); 
    }
}
