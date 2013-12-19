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
        return factories::get()->obj('session_model_user');
    }

    public function cookie($name, $value = null)
    {
        if (null !== $value) {
            setcookie($name, $value, strtotime('+14 days'), '/');
        } else if (isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        }
        return null;
    }

    public function removeCookie($name)
    {
        if (isset($_COOKIE[$name])) {
            unset($_COOKIE[$name]);
            setcookie($name, null, -1, '/');
            return true;
        } else {
            return false;
        }
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

//    public function form(core_controller_abstract $controller, $data = null)
//    {
//        $class = get_class($controller);
//
//        $e = new Exception();
//        $trace = $e->getTrace();
//        $funcion= isset($trace[1]) ? $trace[1]['function'];
//    }
//
//    public function retriveForm(core_controller_abstract $controller)
//    {
//    }

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
