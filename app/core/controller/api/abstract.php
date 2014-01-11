<?php
abstract class core_controller_api_abstract extends core_controller_abstract
{
    public function isAllowed()
    {
        /* temporarily disabled */
//        if (!$this->_isApiAllowed()) {
//           $data = []; 
//           $data['secret'] = 'Invalid value';
//           $data['message'] = 'Invalid secret key was provided';
//           $status = core_model_api_jsend::JSEND_ERROR;
//           $this->response($data, $status);
//           die();
//        }
        return true;
    }

    private function _isApiAllowed()
    {
        $secret = $this->request()->post()->get('secret');
        $session = factories::get()->obj('session_model_api');
        if ($session->isValid($secret)) {
            return true;
        }
        return false; 
    }

    public function response($data, $status = 'success')
    {
        $jsend = factories::get()->obj('core_model_api_jsend');
        $jsend->header();
        echo $jsend->jsend($status, $data);
    } 
}
