<?php

class core_model_alert
{
    private $_type;
    private $_msg;

    private $_twitter = [
        'success' => 'alert-success',
        'info'    => 'alert-info',
        'warning' => 'alert-warning',
        'error'   => 'alert-danger',
    ];

    public function type($val = null)
    {
        if (is_null($val)) {
            return $this->_type; 
        }
        $this->_type = $val;
    }

    public function msg($val = null)
    {
        if (is_null($val)) {
            return $this->_msg; 
        }
        $this->_msg = $val;
    }

    public function twitter()
    {
        return $this->_twitter[$this->type()];
    }
}
