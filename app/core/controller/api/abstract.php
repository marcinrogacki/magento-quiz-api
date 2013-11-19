<?php
abstract class core_controller_api_abstract extends core_controller_abstract
{
    public function response($data)
    {
        $jsend = factories::get()->obj('core_model_api_jsend');
        $jsend->header();
        echo $jsend->success($data);
    } 
}
