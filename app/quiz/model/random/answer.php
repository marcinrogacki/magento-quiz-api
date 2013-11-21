<?php
/**
 *
 */
class quiz_model_random_answer
    implements quiz_model_random_interface
{
    private $_questionId = null;
    private $_valid = null;
    private $_invalid = null;

    public function question($id)
    {
        $this->_questionId = $id;
    }

    public function valid($number)
    {
        $this->_valid = (int)$number;
    }

    public function invalid($number)
    {
        $this->_invalid = (int)$number;
    }

    /**
     * Gets random row.
     */
    public function load()
    {
        throw new Exception('Rand single answer not supported'); 
    } 

    public function collection()
    {
        $answer = factories::get()->obj('question_model_answer');
        $adapter = $answer->adapter();

        $valid = $adapter->select()
            ->from($answer->table())
            ->where('question_id = ?', $this->_questionId) 
            ->where('is_valid= ?', 1);

        $valid = ((string) $valid) . ' ORDER BY rand() limit 0,' . $this->_valid;

        $invalid = $adapter->select()
            ->from($answer->table())
            ->where('question_id = ?', $this->_questionId) 
            ->where('is_valid= ?', 0);

        $invalid = ((string) $invalid) . ' ORDER BY rand() limit 0,' . $this->_invalid;

        $select = sprintf('(%s) UNION (%s) order by rand()', $invalid, $valid); 

        $answers = $adapter->query($select)->fetchAll(); 
        return $answers;
    }
}
