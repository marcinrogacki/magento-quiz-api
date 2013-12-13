<?php
/**
 *
 */
class session_model_session
{
    private $_alertsKey = '__ALERTS__';

    public function __construct()
    {
        $status = session_status();

        if ($status == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function user()
    {
    }

    public function cookie($name, $value)
    {
       setcookie($name, $value, strtotime('+14 days'), '/');
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function remove($key)
    {
        if (isset($_SESSION[$key])) {
           unset($_SESSION[$key]);
        }
    }

    public function get($key)
    {
        if (isset($_SESSION[$key])) {
           return $_SESSION[$key];
        }
        return null;
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
        $alerts = $this->get($this->_alertsKey);
        $this->remove($this->_alertsKey);
        return $alerts;
    }
 
    private function _alert($type, $msg)
    {
        $alert = factories::get()->obj('core_model_alert');
        $alert->type($type);
        $alert->msg($msg);
        $_SESSION[$this->_alertsKey][] = $alert;
    }
}
