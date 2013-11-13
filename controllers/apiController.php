<?php

class apiController extends baseController
{
    public function index() 
    {
        header('Content-type: application/json');
        $api = $this->_getApi();
        $response = $api->getActions();
        $this->_send($response);
    }

	public function question()
    {
        $api = $this->_getApi();
        $response = $api->getQuestion();
        $this->_send($response);
	}
    
    private function _getApi()
    {
        return $this->model('api');
    }

    private function _send($response)
    {
        $viewData['response'] = $response;
	    $this->view('api', $viewData, false);	
    }
}
