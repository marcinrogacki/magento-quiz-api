<?php

class question_controller_list extends core_controller_abstract 
{
	public function index()
    {
        $vars = [
            'title' => 'Questions list',
            'js'    => [],
        ];

        $userEmail = $this->request()->session()->user()->email();
        $questions = factories::get()->obj('question_model_base')->collection();
        foreach ($questions as &$question) {
            if ($question['user_email'] === $userEmail) {
                $question['can_edit'] = true;
            } else {
                $question['can_edit'] = false;
            }
        }

        $vars['questions'] = $questions;
        $this->view('question/view/list', $vars, true);
    }
}
