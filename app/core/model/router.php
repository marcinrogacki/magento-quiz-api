<?php
class core_model_router extends core_model_abstract
{
    private $_controller;

    private $_module;
    private $_contr;
    private $_action;
    private $_post;

    public function __construct()
    {
        $parts = array_filter(explode('/', $_SERVER['REQUEST_URI']));
    	$this->set($parts);
    }
   
    public function controllerObj()
    {
        if (!isset($this->_controller)) {

            $controller = '';

            $factory = factories::get();

            $this->_module = $this->part(1);
            $this->_contr = $this->part(2);
            $this->_action = $this->part(3);

            if ($this->module() && $this->controller() && $this->action()) {
                $controller = $this->module() . '_controller_' . $this->controller();
                if ($factory->found($controller)) {
                    $this->_controller = $factory->obj($controller);
                    if (method_exists($this->_controller, $this->action())) {
                        $this->_initPost(3);
                        $this->_request->setPost($this->_post);
                        $this->_controller->request($this->_request);
                        return $this->_controller;
                    }
                }
            }

            if ($this->module() && $this->controller()) {
                $controller = $this->module() . '_controller_' . $this->controller();
                if ($factory->found($controller)) {
                    $this->_controller = $factory->obj($controller);
                    $this->_action = 'index';
                    $this->_initPost(2);
                    $this->_request->setPost($this->_post);
                    $this->_controller->request($this->_request);
                    return $this->_controller;
                }
            }

            if ($this->module()) {
                $controller = $this->module() . '_controller_index';
                if ($factory->found($controller)) {
                    $this->_controller = $factory->obj($controller);
                    $this->_action = 'index';
                    $this->_initPost(1);
                    $this->_request->setPost($this->_post);
                    $this->_controller->request($this->_request);
                    return $this->_controller;
                }
            }

            $controller = 'index_controller_index';
            if ($factory->found($controller)) {
                $this->_controller = $factory->obj($controller);
                $this->_action = 'index';
                $this->_initPost(0);
                $this->_request->setPost($this->_post);
                $this->_controller->request($this->_request);
                return $this->_controller;
            }

            $controller = 'core_controller_index';
            if ($factory->found($controller)) {
                $this->_controller = $factory->obj($controller);
                $this->_action = 'index';
                $this->_initPost(0);
                $this->_request->setPost($this->_post);
                $this->_controller->request($this->_request);
                return $this->_controller;
            }

            $this->site404();
        }
        return $this->_controller;
    }

    public function dispatch(core_model_request $request)
    {
        $this->_request = $request; 
		call_user_func([ $this->controllerObj(), $this->action() ]);
		return;
	}

    public function site404()
    {
        header('HTTP/1.0 404 Not Found');
        die('404 Not Found');
    }

    public function part($number)
    {
        return $this->is($number) ? $this->get($number) : false;
    }

    public function module()
    {
        return $this->_module;
    }

    public function controller()
    {
        return $this->_contr;
    }

    public function action()
    {
    	return $this->_action;
    }

    public function post()
    {
    	return $this->_post;
    }

    private function _initPost($partStart)
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
}
