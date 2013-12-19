<?php

class question_controller_add extends core_controller_abstract 
{
	public function index()
    {
        var_dump($this->request()->post());
        $categories = [];

        $category = factories::get()->obj('category_model_table');
        $category->load(1);
        $categories[] = $category;

        $category = factories::get()->obj('category_model_table');
        $category->load(2);
        $categories[] = $category;

        $vars = [
            'title' => 'Add question',
            'js'    => [ '/public/js/answer.js' ],
            'categories' => $categories,
        ];

        $this->view('question/view/add', $vars);
	}
    
    public function post()
    {
        $question = factories::get()->obj('question_model_base'); 
        $request = $this->request();
        $session = $request->session();

        $categoryId = $request->post('category_id');

        if (!$categoryId) {
            $session->error('Please choose category');
            $request->action('index');
            return $request; 
        }

        $value = $request->post('question');

        if (!$value) {
            $session->error('Fill question field, please');
            $request->action('index');
            return $request; 
        }

        $valid = $this->request()->post('valid'); 
        $valid = (isset($valid) ? $valid : []);
        $validCount = 0;
        foreach ($valid as $answer) {
            if (!!$answer['value']) {
                $validCount++;
            }
        }

        if (1 > $validCount) {
            $session->error('At least one valid answer is required');
            $request->action('index');
            return $request; 
        }

        $invalid = $this->request()->post('invalid'); 
        $invalid = (isset($invalid) ? $invalid : []);
        $invalidCount = 0;
        foreach ($invalid as $answer) {
            if (!!$answer['value']) {
                $invalidCount++;
            } 
        }

        if (3 > $invalidCount) {
            $session->error('At least three invalid answers are required');
            $request->action('index');
            return $request; 
        }

        $userEmail = $session->user()->email(); 

        $question->set($value, 'question');
        $question->set($userEmail, 'user_email');
        $question->set($categoryId, 'category_id');
        $question->save();

        $questionId = $question->get($question->primary());

        foreach ($valid as $data) {
            $data['is_valid'] = 1;
            $answer= factories::get()->obj('question_model_answer'); 
            $answer->set($data);
            $answer->set($questionId, 'question_id');
            $answer->save();
        }
 
        foreach ($invalid as $data) {
            $data['is_valid'] = 0;
            $answer= factories::get()->obj('question_model_answer'); 
            $answer->set($data);
            $answer->set($questionId, 'question_id');
            $answer->save();
        }

        $session->success('Question has been added');
        $request->action('index');

        return $request;
    }
}
