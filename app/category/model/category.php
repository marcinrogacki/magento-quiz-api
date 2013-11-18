<?php
/**
 *
 */
class category_model_category extends core_model_db
{
    /**
     * Gets table name.
     */
    public function table()
    {
        return 'category';
    }

    /**
     * Gets id column name.
     */
    public function primary()
    {
        return 'id';
    }

    
}
