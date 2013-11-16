<?php

abstract class core_model_abstract 
{
    /**
     * @var array
     */
    protected $_data = [];

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
    public function is($key = null)
    {
        if (is_null($key)) {
            return (bool) count($this->_data);
        }
        return isset($this->_data[$key]);
    }

    /**
     * Checks data which works as flag. True if set and not empty, false otherwise.
     */ 
    public function flag($key)
    {
       return $this->isset($key) ? (bool) $this->_data[$key] : false; 
    }
}
