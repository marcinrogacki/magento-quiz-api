<?php
class Load
{
    /**
     * Renders view
     */	
	public function view($name, array $vars = null, $layout = true)
    {
		if (isset($vars)) {
		    extract($vars);
	    }

		$this->_layout = SITE_PATH . 'application/layout.php';
		$this->_view = SITE_PATH.'views/'.$name.'View.php';

		if(!is_readable($this->_layout)){
		    throw new Exception('Layout has not been found');
        }
		if(!is_readable($this->_view)){
		    throw new Exception('View has not been found');
		}
        
        if ($layout) {	
    	    require($this->_layout);
        } else {
    	    require($this->_view);
        }
		return true;

	}	

	public function model($name){
		$model = $name.'Model';
		$modelPath = SITE_PATH.'models/'.$model.'.php';

		if(is_readable($modelPath)){
			require_once($modelPath);

			if(class_exists($model)){
				$registry = Registry::getInstance();
				$registry->$name = new $model;
				return $registry->$name;
			}
		}
		throw new Exception('Model issues.');	
	}	
}
