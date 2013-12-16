<?php
/**
 *
 */
class user_model_table extends core_model_db
{
    /**
     * Gets table name.
     */
    public function table()
    {
        return 'user';
    }

    /**
     * Gets id column name.
     */
    public function primary()
    {
        return 'email';
    }
}
