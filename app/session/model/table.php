<?php
/**
 *
 */
class session_model_table extends core_model_db
{
    /**
     * Gets table name.
     */
    public function table()
    {
        return 'session';
    }

    /**
     * Gets id column name.
     */
    public function primary()
    {
        return 'id';
    }
}
