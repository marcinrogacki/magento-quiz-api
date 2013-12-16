<?php
/**
 *
 */
class category_model_table extends core_model_db
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

    public function subcategories()
    {
        $id = $this->get($this->primary()); 

        if (!$id) {
            return null;
        }

        $subcategories = [];
        $categories = $this->collection('*', $id, 'parent_id');
        foreach ($categories as $category) {
            $sub = factories::get()->obj('category_model_table'); 
            $sub->set($category);
            $subcategories[] = $sub;
        }

        return $subcategories;
    }
}
