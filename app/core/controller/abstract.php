<?php
abstract class core_controller_abstract 
{
    private $_request;

    /**
     * @return void
     */
    abstract public function index();
    
    /**
     *
     */
    public function request(core_model_request $request = null)
    {
        if (is_null($request)) {
            return $this->_request;
        }
        $this->_request = $request;
    }

    /**
     *
     */
    public function view($path, $vars = null, $layout = true)
    {
		if (isset($vars)) {
		    extract($vars);
	    }

		$this->_layout = SITE_PATH . 'app/core/view/layout.phtml';
		$this->_view = SITE_PATH . 'app/' . $path . '.phtml';

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
}
