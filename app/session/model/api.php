<?php
/**
 */
class session_model_api
{
    private function _hash()
    {
        $rand = factories::get()->obj('core_model_random');
        $key = $rand->load();
        return $key;
    }

    public function isValid($secret)
    {
        $table = factories::get()->obj('session_model_table');
        $table->load($secret, 'session'); 

        if ($table->exists()) {
            return true;
        }

        return false;
    }

    public function generateSecret($email, $password)
    {
        if ('api@nexway.com' !== $email) {
            return false;
        }

        $user = factories::get()->obj('user_model_user');
        if (!$user->login($email, $password)) {
            return false;
        }

        $table = factories::get()->obj('session_model_table');
        $table->load($email, 'user_email');
        $table->delete();

        $key = $this->_hash();

        $table = factories::get()->obj('session_model_table');
        $table->set($key, 'session');
        $table->set($email, 'user_email');
        $table->save();

        return $key;
    }
}
