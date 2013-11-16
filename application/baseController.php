<?php
abstract class baseController
{
    protected $_registry;
   
    /**
     * @var Load model/view loader 
     */
    protected $_load;
    
    /**
     * @var string POST/GET data
     */
    protected $_post;
   
    public function __construct()
    {
        $this->_registry = Registry::getInstance();
        $this->_load = new load;
    }
    
    /**
     * @return void
     */
    abstract public function index();
 
    /**
     * @return void
     */
    final public function __get($key)
    {
    	if($return = $this->_registry->$key){
    		return $return;
    	}
    	return false;
    }	
    
    public function model($name)
    {
        return $this->_load->model($name);
    } 
    
    public function view($name, $vars = null, $layout = true)
    {
        return $this->_load->view($name, $vars, $layout);
    } 
    
    public function setPost($args)
    {
        $this->_post = $args;
    }
    
    public function post()
    {
        return $this->_post;
    }
    
    public function redirect($path, $permanent = false)    
    {
        if (headers_sent() === false)
        {
            header('Location: ' . $path, true, ($permanent === true) ? 301 : 302);
        }

        exit();
    }
}
