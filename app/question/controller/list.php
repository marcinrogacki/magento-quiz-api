<?php

class question_controller_list extends core_controller_abstract 
{
	public function index()
    {
        $session = $this->request()->session();

        $category = factories::get()->obj('category_model_table');
        $category->load(1);
        $categories[] = $category;

        $category = factories::get()->obj('category_model_table');
        $category->load(2);
        $categories[] = $category;

        $userEmail = $this->request()->session()->user()->email();

        $categoryId = $this->request()->post()->get('category_id');
        if (!$categoryId) {
            $categoryId = $session->get('add_question_id');
        } else {
            $session->set('add_question_id', $categoryId);
        }

        if (!$categoryId) {
            $questions = factories::get()->obj('question_model_base')->collection();
        } else {
            $questions = factories::get()->obj('question_model_base')
                ->collection('*', $categoryId, 'category_id');
        }

        foreach ($questions as &$question) {
            if ($question['user_email'] === $userEmail) {
                $question['can_edit'] = true;
            } else {
                $question['can_edit'] = false;
            }
        }

        $vars = [
            'categories' => $categories,
            'questions' => $questions,
            'selected_category_id' => $categoryId,
            'title' => 'Questions list',
            'js'    => [],
        ];

        $this->view('question/view/list', $vars, true);
    }
}
