<?php
/**
 *
 */
class question_model_base extends core_model_db
{
    private $_answers = [];

    /**
     * @return array
     */
    public function answers($answer = null)
    {
        if (!is_null($answer)) {
            $this->_answers[] = $answer;
        }

        return $this->_answers;
    }

    /**
     * Gets table name.
     */
    public function table()
    {
        return 'question';
    }

    /**
     * Gets id column name.
     */
    public function primary()
    {
        return 'id';
    }

    
}
