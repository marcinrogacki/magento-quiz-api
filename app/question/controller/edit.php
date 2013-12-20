<?php

class question_controller_edit extends core_controller_abstract 
{
	public function index()
    {
	}
    
    public function get()
    {
        $request = $this->request();
        $session = $this->request()->session();
        $id = $request->post()->get('id'); 

        $question = factories::get()->obj('question_model_base'); 

        if (!$question->load($id)) {
            $session->error('Question not found');
            $request->location('question/list/index');
            return $request;
        } 

        $email = $session->user()->email();
        if ($email !== $question->get('user_email')) {
            $session->error('Sorry, you are not owner of the question');
            $request->location('question/list/index');
            return $request;
        }

        $form = [];
        $form['category_id'] = $question->get('category_id');
        $form['question'] = $question->get('question');
        $form['question_id'] = $question->get($question->primary());

        $answers = factories::get()->obj('question_model_answer')
            ->collection('*', $id, 'question_id'); 

        foreach ($answers as $answer) {
            if (!$answer['is_valid']) {
                $form['invalid'][] = [
                    'id' => $answer['id'],
                    'value' => $answer['value']
                ];

            } else {
                $form['valid'][] = [
                    'id' => $answer['id'],
                    'value' => $answer['value']
                ];
            }
        }

        $session->set('form_question', $form); 
        $request->location('question/add/index');
        return $request;
    }
}
