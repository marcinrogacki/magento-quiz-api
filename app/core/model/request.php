<?php
class core_model_request extends core_model_abstract
{
    private $_module;
    private $_contr;
    private $_action;

    private $_post;
    private $_session;

    public function __construct()
    {
        $this->_session = factories::get()->obj('session_model_session');
        $this->_post = factories::get()->obj('core_model_post');
    }

    public function session(session_model_session $session = null)
    {
        if (is_null($session)) {
            return $this->_session;
        }
        $this->_session = $session;
    }

    public function post(core_model_post $post = null)
    {
        if (is_null($post)) {
            return $this->_post;
        }
        $this->_post = $post;
    }

    public function part($number)
    {
        return $this->is($number) ? $this->get($number) : false;
    }

    public function location($value = null)    
    {
        if (is_null($value)) {
            $location = '';
            if ($this->module()) {
                $location = $this->module();
            } 
            if ($this->controller()) {
                $location .= '/' . $this->controller();
            } 
            if ($this->action()) {
                $location .= '/' . $this->action();
            } 

            return $location;
        }

        $value = ltrim($value, '/');
        $parts = explode('/', $value);

        $module = isset($parts[0]) ? $parts[0] : null ;
        $controller = isset($parts[1]) ? $parts[1] : null ;
        $action = isset($parts[2]) ? $parts[2] : null ;
        
        $this->module($module);
        $this->controller($controller);
        $this->action($action);
        $this->set(explode('/', $value));
    }

    public function module($value = null)
    {
        if (is_null($value)) {
            return $this->_module;
        }
        $this->_module = $value;
    }

    public function controller($value = null)
    {
        if (is_null($value)) {
            return $this->_contr;
        }
        $this->_contr = $value;
    }

    public function action($value = null)
    {
        if (is_null($value)) {
            return $this->_action;
        }
        $this->_action = $value;
    }

    public function initPost($partStart)
    {
        $parts = array_slice($this->get(), $partStart);
        $postData = (isset($parts[0])) ? $parts : array();
        $args = [];
        $len = count($postData);
        for ($i = 0; $i < $len; $i = $i + 2) {
            $key = $postData[$i];
            $value = isset($postData[$i + 1]) ? $postData[$i + 1] : null; 
            $args[$key] = $value;
        }
        $this->post()->merge($args);
    }

    public function clear()
    {
        $this->_post->set([]);
        $this->_module = null;
        $this->_contr  = null;
        $this->_action = null;
    }
}
