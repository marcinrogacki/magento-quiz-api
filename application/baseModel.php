<?php

abstract class baseModel
{
    /**
     * @var array
     */
    protected $_data = [];

    /**
     * Gets db adapter
     */
    public function adapter()
    {
        return Load::model('database')->adapter();
    }

    /**
     * Generig setter
     */
    public function set($val, $key = null)
    {
        if (is_null($key) && is_array($val)) {
            $this->_data = $val;
            return;
        }
        $this->_data[$key] = $val;
    }
    
    /**
     * Generig getter 
     * @return mixed|array
     */
    public function get($key = null)
    {
        if (is_null($key)) {
            return $this->_data; 
        }
        return $this->is($key) ? $this->_data[$key] : null;
    }
 
    /**
     * Check if data key exists 
     */ 
    public function is($key)
    {
       return isset($this->_data[$key]);
    }

    /**
     * Checks data which works as flag. True if set and not empty, false otherwise.
     */ 
    public function flag($key)
    {
       return $this->isset($key) ? (bool) $this->_data[$key] : false; 
    }
  
    public function exists($id = null)
    {
        $id = is_null($id) ? $this->get($this->primary()) : $id;

        if (is_null($id)) {
            return false;
        }

        $adapter = $this->adapter();
        $query = sprintf(
            "SELECT * FROM %s where %s = %s",
            $this->table(),
            $this->primary(),
            $adapter->quote($id, 'INTEGER')
        );

        return (bool) $adapter->fetchOne($query);
    }

    public function save()
    {
        $adapter = $this->adapter();

        if ($this->exists()) {
            $adapter->insert($this->_table, $this->get()); 
        } else {
            $where[$this->primary() . ' = ?'] = $this->get($this->primary());
            $adapter->update($this->_table, $this->get(), $where); 
        }
    } 

    /**
     * Gets table name.
     */
    abstract public function table();

    /**
     * Gets id column name.
     */
    abstract public function primary();

    /**
     * Defines validation for properties
     * @return array
     */
    public function validator($key, validator_abstractModel $validator)
    {
        $this->_validators[$key] = $validator;
    }
}
