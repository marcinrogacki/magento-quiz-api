<?php
class core_model_request extends core_model_abstract
{
    public function post($key = null)
    {
        if (is_null($key)) {
            return $this->get();
        }
        return $this->get($key);
    }

    public function setPost(array $data)
    {
        $this->set($data);
    }
}
