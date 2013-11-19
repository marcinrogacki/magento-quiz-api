<?php

class question_controller_add extends core_controller_abstract 
{
	public function index()
    {
        $session = factories::get()->session();
        $category = factories::get()->obj('category_model_category');

        $vars = [
            'title' => 'Add question',
            'js'    => [],
            'alerts' => $session->alerts(),
            'categories' => $category->collection(),
        ];

        $this->view('question/view/add', $vars);
	}
    
    public function post()
    {
        $question = factories::get()->obj('question_model_base'); 

        $value = $this->request()->post('question');
        $question->set($value, 'question');

        $categoryId = $this->request()->post('category_id');
        $categoryId = ('' === $categoryId ? null : (int)$categoryId);
        $question->set($categoryId, 'category_id');
        $question->save();

        $answers = $this->request()->post('answers'); 

        $questionId = $question->get($question->primary());
        foreach ($answers as $data) {
            $data['is_valid'] = (int) isset($data['is_valid']);
            $answer= factories::get()->obj('question_model_answer'); 
            $answer->set($data);
            $answer->set($questionId, 'question_id');
            $answer->save();
        }
        
        $question->save();
        $session = factories::get()->session();
        $session->success('Question has been added');
        $this->redirect('question/add'); 
    }
}
