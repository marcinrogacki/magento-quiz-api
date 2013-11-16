<?php
class request
{
	
	private $_controller;

	private $_method;

	private $_args;

    public function __construct()
    {
		$parts = explode('/',$_SERVER['REQUEST_URI']);
		$parts = array_filter($parts);
		
		$controller = ($c = array_shift($parts))? $c: 'index';
        $controller .= 'Controller';
		$controllerFile = SITE_PATH.'controllers/'.$controller.'.php';

		if(!is_readable($controllerFile)){
            header('HTTP/1.0 404 Not Found');
            die('404 Not Found');
		}

        require_once $controllerFile;
        $this->_controller = new $controller;


        if (isset($parts[0]) && method_exists($this->getController(), $parts[0])) {
		    $this->_method = array_shift($parts);
        } else {
            $this->_method = 'index';
        }

        $postData = (isset($parts[0])) ? $parts : array();
        $args = [];
        $len = count($postData);
        for ($i = 0; $i < $len; $i = $i + 2) {
            $key = $postData[$i];
            $value = isset($postData[$i + 1]) ? $postData[$i + 1] : null; 
            $args[$key] = $value;
        }
        $this->_args = array_merge($args, $_POST);
    }

	public function getController(){
		return $this->_controller;
	}
	public function getMethod(){
		return $this->_method;
	}
	public function getArgs(){
		return $this->_args;
	}
}
