<?php

class question_controller_api extends core_controller_api_abstract 
{
    public function index() 
    {
    }

	public function random()
    {
        $categoryId = $this->request()->post()->get('category');

        $random = factories::get()->obj('quiz_model_random_question');
        $random->category($categoryId);
        $questions = $random->load();

        $data = [];
        foreach ($questions as $question) {
            $row['question'] = $question;
            $random = factories::get()->obj('quiz_model_random_answer');
            $random->question($question['id']);
            $random->valid(1);
            $random->invalid(3);
            $answers = $random->collection();

            $row['answers'] = array_column($answers, 'value');

            $row['valid'] = key(array_filter($answers, function($var) {
                return $var['is_valid'] === '1';
            }));

            $references = factories::get()->obj('question_model_question_reference')
                ->collection('*', $question['id'], 'question_id'); 

            $urls = [];
            foreach ($references as $reference) {
                $urls[] = $reference['url'];
            }
            $row['reference'] = $urls;
            $data[] = $row;
        }

        $this->response($data);
	}
}
