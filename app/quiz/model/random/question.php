<?php
/**
 *
 */
class quiz_model_random_question
    implements quiz_model_random_interface
{
    private $_categoryId = null;

    public function category($id)
    {
        $this->_categoryId = $id;
    }

    /**
     * Gets random row.
     */
    public function load()
    {
        $random = factories::get()->obj('quiz_model_random_db');
        $random->model('question_model_base');
        $question = $random->load();

        return $question;
    } 
}
