<?php

class core_model_row
{
    /**
     * @var array
     */
    protected $_row = [];
 
    public function mass(array $row = null)
    {
       if (is_null($row)) {
            return $this->_row;
       }
       $this->_row = $row;
    }

    /**
     * Generig setter
     */
    public function set($key, $val)
    {
        $this->_row[$key] = $val;
    }
    
    /**
     * Generig getter 
     * @return mixed|array
     */
    public function get($key)
    {
        return $this->is($key) ? $this->_row[$key] : null;
    }

    /**
     * Check if data key exists 
     */ 
    public function is($key = null)
    {
        if (is_null($key)) {
            return (bool) count($this->_row);
        }
        return isset($this->_row[$key]);
    }

    /**
     * Checks data which works as flag. True if set and not empty, false otherwise.
     */ 
    public function flag($key)
    {
       return $this->is($key) ? (bool) $this->_row[$key] : false; 
    }
}
