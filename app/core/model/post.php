<?php
class core_model_post extends core_model_abstract
{
    public function __construct()
    {
        $this->set($_POST);
    }

    public function merge($data)
    {
        $this->set(array_merge($this->get(), $data));
    }
}
