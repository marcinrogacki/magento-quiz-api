<?php

class question_controller_add extends core_controller_abstract 
{
	public function index()
    {
        $categories = [];

        $category = factories::get()->obj('category_model_table');
        $category->load(1);
        $categories[] = $category;

        $category = factories::get()->obj('category_model_table');
        $category->load(2);
        $categories[] = $category;

        $form = $this->request()->session()->get('form_question');
        $this->request()->session()->remove('form_question');
        $form['category_id'] = (isset($form['category_id']) ? $form['category_id'] : '');
        $form['question'] = (isset($form['question']) ? $form['question'] : '');
        $form['valid'] = (array_key_exists('valid', $form) ? $form['valid'] : []);
        $form['invalid'] = (array_key_exists('invalid', $form) ? $form['invalid'] : []);
        $form['reference'] = (array_key_exists('reference', $form) ? $form['reference'] : []);

        $vars = [
            'title' => 'Add question',
            'js'    => [ '/public/js/answer.js' ],
            'categories' => $categories,
            'form'       => $form,
        ];

        $this->view('question/view/add', $vars);
	}
    
    public function post()
    {
        $question = factories::get()->obj('question_model_base'); 
        $request = $this->request();
        $session = $request->session();
        $session->set('form_question', $request->post()->get());

        $categoryId = $request->post()->get('category_id');

        if (!$categoryId) {
            $session->error('Please choose category');
            $request->action('index');
            return $request; 
        }

        $value = $request->post()->get('question');

        if (!$value) {
            $session->error('Fill question field, please');
            $request->action('index');
            return $request; 
        }

        $valid = $this->request()->post()->get('valid'); 
        $valid = (isset($valid) ? $valid : []);
        $validCount = 0;
        foreach ($valid as $key => $answer) {
            if (!!$answer['value']) {
                $validCount++;
            } else {
                unset($valid[$key]);
            }
        }

        if (1 > $validCount) {
            $session->error('At least one valid answer is required');
            $request->action('index');
            return $request; 
        }

        $invalid = $this->request()->post()->get('invalid'); 
        $invalid = (isset($invalid) ? $invalid : []);
        $invalidCount = 0;
        foreach ($invalid as $key => $answer) {
            if (!!$answer['value']) {
                $invalidCount++;
            } else {
                unset($invalid[$key]);
            }

        }

        if (3 > $invalidCount) {
            $session->error('At least three invalid answers are required');
            $request->action('index');
            return $request; 
        }

        $question->load($request->post()->get('question_id'));
        $userEmail = $session->user()->email(); 
        if ($question->exists() && $question->get('user_email') !== $userEmail) {
            $session->error('Sorry, you are not an owner of the question');
            $session->remove('form_question');
            $request->location('question/add/index');
            return $request;
        }

        $question->set($value, 'question');
        $question->set($userEmail, 'user_email');
        $question->set($categoryId, 'category_id');
        $question->save();

        $questionId = $question->get($question->primary());

        foreach ($valid as $data) {
            $data['is_valid'] = 1;
            $answer= factories::get()->obj('question_model_answer'); 
            $answer->load($data['id']);
            $answer->set($data);
            $answer->set($questionId, 'question_id');
            $answer->save();
        }
 
        foreach ($invalid as $data) {
            $data['is_valid'] = 0;
            $answer= factories::get()->obj('question_model_answer'); 
            $answer->load($data['id']);
            $answer->set($data);
            $answer->set($questionId, 'question_id');
            $answer->save();
        }

        $references = $this->request()->post()->get('reference'); 
        $references = (isset($references) ? $references : []);
        foreach ($references as $data) {
            $reference = factories::get()->obj('question_model_question_reference'); 
            $reference->load($data['id']);
            $reference->set($data);
            $reference->set($questionId, 'question_id');
            $reference->save();
        }

        if ($request->post()->get('question_id')) {
            $session->success('Question has been updated');
        } else {
            $session->success('Question has been added');
        }
        $request->action('index');
        $session->remove('form_question');

        return $request;
    }
}
