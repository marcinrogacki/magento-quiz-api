<?php

class question_controller_api extends core_controller_api_abstract 
{
    public function index() 
    {
    }

	public function random()
    {
        $categoryId = null;

        $questionsData = [];
        for ($i = 0; $i < 10; $i++) {
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

            $answersData = current($question->answers());
            $data['answers'] = array_column($answersData, 'value');

            $data['valid'] = key(array_filter($answersData, function($var) {
                return $var['is_valid'] === '1';
            }));

            $references = factories::get()->obj('question_model_question_reference')
                ->collection('*', $id, 'question_id'); 

            $urls = [];
            foreach ($references as $reference) {
                $urls[] = $reference['url'];
            }
            $data['reference'] = $urls;

            $questionsData[] = $data;
        }

        $this->response($questionsData);
	}
}
