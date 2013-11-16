<?php

class factories
{
    /**
     * @return core_model_factory_interface
     */
    static public function get($factory = 'core')
    {
        $factory = $factory . '_model_factory';
        return new $factory; 
    }
}
