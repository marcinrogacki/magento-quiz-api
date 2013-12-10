<?php
class core_model_request extends core_model_abstract
{
    private $_module;
    private $_contr;
    private $_action;
    private $_post;

    public function __construct()
    {
        $parts = array_filter(explode('/', $_SERVER['REQUEST_URI']));
    	$this->set($parts);

        $this->_module = $this->part(1);
        $this->_contr = $this->part(2);
        $this->_action = $this->part(3);
    }

    public function post($key = null)
    {
        if (is_null($key)) {
            return $this->get();
        }
        return $this->get($key);
    }

    public function setPost(array $data)
    {
        $this->set($data);
    }

    public function part($number)
    {
        return $this->is($number) ? $this->get($number) : false;
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
        $this->_post = array_merge($args, $_POST);
    }

    public function clear()
    {
        $this->_post = [];
        $this->_module = null;
        $this->_contr  = null;
        $this->_action = null;
        $this->_post   = null;
    }
}
