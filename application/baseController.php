<?php
abstract class baseController
{
		protected $_registry;

		protected $_load;

        protected $_post;

        public function __construct()
        {
            $this->_registry = Registry::getInstance();
            $this->_load = new Load;
		}

		abstract public function index();

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

        public function view($name, $vars = null)
        {
            return $this->_load->view($name, $vars);
        } 

        public function setPost($args)
        {
            $this->_post = $args;
        }

        public function post()
        {
            return $this->_post;
        }
	}
?>
