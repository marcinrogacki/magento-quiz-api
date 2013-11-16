<?php

abstract class core_model_db extends core_model_abstract
{
    /**
     * Gets table name.
     */
    abstract public function table();

    /**
     * Gets id column name.
     */
    abstract public function primary();

    /**
     * Gets db adapter
     */
    public function adapter()
    {
        return factories::get()->obj('core_model_mysql')->adapter(); 
    }
  
    public function exists($id = null)
    {
        $id = is_null($id) ? $this->get($this->primary()) : $id;

        if (is_null($id)) {
            return false;
        }

        $id = (int) $id;

        $adapter = $this->adapter();
        $where = sprintf('%s = ?', $this->primary());
        
        $query = $adapter->select()
            ->from($this->table())
            ->columns($this->primary())
            ->where($where, $id, 'INTEGER')
            ->query();

        return (bool) $query->fetch();
    }

    public function colletion($raw = true)
    {
        $adapter = $this->adapter();
        
        $query = $adapter->select()
            ->from($this->table())
            ->query();

        return $query->fetchAll();
    }

    public function save()
    {
        $adapter = $this->adapter();

        if (!$this->exists()) {
            $adapter->insert($this->table(), $this->get()); 
            $id = $adapter->lastInsertId();
            $this->set($id, $this->primary());
        } else {
            $where[$this->primary() . ' = ?'] = $this->get($this->primary());
            $adapter->update($this->table(), $this->get(), $where); 
        }
    } 

    /**
     * Defines validation for properties
     * @return array
     */
    public function validator($key, validator_abstractModel $validator)
    {
        $this->_validators[$key] = $validator;
    }
}
