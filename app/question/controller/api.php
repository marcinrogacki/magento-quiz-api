<?php

class question_controller_api extends core_controller_api_abstract 
{
    public function index() 
    {
    }

	public function random()
    {
        $categoryId = null;

        $random = factories::get()->obj('quiz_model_random_question');
        $random->category($categoryId);
        $question = $random->load();

        $data['question'] = $question->get();

        $random = factories::get()->obj('quiz_model_random_answer');
        $id = $question->get($question->primary());
        $random->question($id);
        $random->valid(1);
        $random->invalid(3);
        $answers = $random->collection();
        $question->answers($answers);

        $data['answers'] = $question->answers();

        $this->response($data);
	}
}
