<?php
/**
 *
 */
class quiz_model_random_db
    implements quiz_model_random_interface
{
    private $_class;

    public function model($class)
    {
        $this->_class = $class;
    }

    /**
     * Gets random row.
     */
    public function load()
    {
        $model = factories::get()->obj($this->_class);
        $idsCollection = $model->collection($model->primary());
        $ids = array_column($idsCollection, $model->primary());
        $key = array_rand($ids);
        $id = $ids[$key];
        $model->load($id);
        return $model;
    } 
}
