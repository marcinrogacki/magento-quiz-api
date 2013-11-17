<?php

class core_model_table
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
    public function row($number = 0)
    {
        if (is_null($key)) {
            return current($this->_row);
        }
        return $this->is($key, $row) ? $this->_row[$row - 1][$key] : null;
    }

    /**
     * Generig getter 
     * @return mixed|array
     */
    public function get($key = null, $row = 1)
    {
        if (is_null($key)) {
            return current($this->_row);
        }
        return $this->is($key, $row) ? $this->_row[$row - 1][$key] : null;
    }

    /**
     * Check if data key exists 
     */ 
    public function is($key = null, $row = 1)
    {
        $row = $row - 1;
        if (is_null($key)) {
            return (bool) count($this->_row);
        }
        return array_key_exists($row - 1, $this->_row)
               && isset($this->_row[$row - 1][$key]);
    }

    /**
     * Checks data which works as flag. True if set and not empty, false otherwise.
     */ 
    public function flag($key)
    {
       return $this->is($key) ? (bool) $this->_row[$key] : false; 
    }
}
