<?php
/**
 *
 */
class random_model_base extends core_model_abstract
{
    /**
     * Gets random row.
     */
    public function load(core_model_db $model)
    {
        $ids = array_column($model->collection($model->primary()), $model->primary());
        $key = array_rand($ids);
        $id = $ids[$key];
        $model->load($id);
    } 
}
