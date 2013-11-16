<?php
/**
 * @singleton
 */
class core_model_session
{
    /**
     * @var Zend_Db_Adapter_Pdo_Mysql 
     */
    private static $_instance = false;

    private $_alerts = [];
 
    /**
     * @return Zend_Db_Adapter_Pdo_Mysql The singleton
     */
    public function instance()
    {
        if (self::$_instance == false) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
    
    public function success($msg)
    {
        $this->_alert('success', $msg); 
    }

    public function info($msg)
    {
        $this->_alert('info', $msg); 
    }

    public function warning($msg)
    {
        $this->_alert('warning', $msg); 
    }

    public function error($msg)
    {
        $this->_alert('error', $msg); 
    }

    public function alerts()
    {
        $alerts = $this->_alerts;
        $this->_alerts;
        return $alerts;
    }

    private function _alert($type, $msg)
    {
        $alert = factories::get()->obj('core_model_alert');
        $alert->type($type);
        $alert->msg($msg);
        $this->_alerts[] = $alert; 
    }
}
