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
        $categories = factories::get()->obj('category_model_table')
            ->collection('*', $this->_categoryId, 'parent_id');
        $categories = array_column($categories, 'id');

        $question = factories::get()->obj('question_model_base');
        $adapter = $question->adapter();

        $select = $adapter->select()
            ->from($question->table())
            ->where('category_id IN (?)', $categories);

        $select = ((string) $select) . ' ORDER BY rand() limit 10';

        $questions = $adapter->query($select)->fetchAll(); 

        return $questions;
    } 
}
