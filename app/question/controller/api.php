<?php

class question_controller_api extends core_controller_api_abstract 
{
    public function index() 
    {
    }

	public function random()
    {
        $categoryId = null;
        $question = factories::get()->obj('question_model_base');

        $random = factories::get()->obj('random_model_base');
        $random->load($question);
        $data['question'] = $question->get();

        $answer = factories::get()->obj('question_model_answer');
        $primary = $question->primary();
        $data['answers'] = $answer->collection('*', $question->get($primary), 'question_id'); 
        $this->response($data);
	}
}
