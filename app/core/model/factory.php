<?php

class core_model_factory implements core_model_factory_interface
{
    public function obj($class)
    {
        return new $class;
    }

    public function found($class)
    {
        $file = SITE_PATH . 'app/' . str_replace('_', '/', $class) . '.php';
        return is_readable($file);
    }

    public function session()
    {
        return core_model_session::instance();
    }
}
