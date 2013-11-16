<?php

class question_controller_list extends core_controller_abstract 
{
	public function index()
    {
        $vars = [
            'title' => 'Questions list',
            'js'    => [],
        ];

        $question = factories::get()->obj('question_model_base'); 
        $vars['questions'] = $question->colletion();
        $this->view('question/view/list', $vars, true);
    }
}
