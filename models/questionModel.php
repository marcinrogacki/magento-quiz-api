<?php
/**
 *
 */
class questionModel extends baseModel
{
    /**
     * @var string
     */
    private $_question;

    public function __construct()
    {
        $obj = new core_model_request;
        $zend = new Zend_Db;
    }

    /**
     * @var array
     */
    private $_answers = [];

    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->_question;
    }

    /**
     * @param string $value
     */
    public function setQuestion($value)
    {
        $this->_question = $value;
    }
 
    /**
     * @return array
     */
    public function getAnswers()
    {
        return $this->_answers;
    }

    /**
     * @param answerModel $answer 
     */
    public function addAnswer(answerModel $answer)
    {
        $this->_answers[] = $answer;
    }

    /**
     * Gets table name.
     */
    public function table()
    {
    }

    /**
     * Gets id column name.
     */
    public function primary()
    {
    }
}
