<?php
/**
 * Proxy - lazy loading
 */
class session_model_user extends user_model_user
{
    private function _get($method, $args = [])
    {
        $session = factories::get()->obj('session_model_session');
        $cookie = $session->cookie('frontend');

        if (null === $cookie) {
            $session->remove('user_name');
            $session->remove('user_email');
            return null;
        }

        $table = factories::get()->obj('session_model_table');
        $table->load($cookie, 'session'); 

        if ($table->exists()) {
            $value = $session->get('user_' . $method);
            if ($value) {
                return $value;
            }

            $user = factories::get()->obj('user_model_table');
            $user->load($table->get('user_email'));
            parent::_user($user);
        } else {
            $session->removeCookie('frontend');
            $session->remove('user_name');
            $session->remove('user_email');
        }

        return call_user_func_array("parent::$method", $args);
    }

    public function logout()
    {
        $session = factories::get()->obj('session_model_session');
        $cookie = $session->cookie('frontend');
        $table = factories::get()->obj('session_model_table');
        $table->load($cookie, 'session'); 
        $table->delete();
        $session->removeCookie('frontend');
        $session->remove('user_name');
        $session->remove('user_email');
    }

    public function isLoggedIn()
    {
        if (!!$this->email()) {
            return true;
        }
        return null;
    }

    public function login($user, $passwd)
    {
        if (parent::login($user, $passwd)) {
            $key = $this->_hash();

            $table = factories::get()->obj('session_model_table');
            $table->set($key, 'session');
            $table->set(parent::email(), 'user_email' );
            $table->save();

            $session = factories::get()->obj('session_model_session');
            $session->cookie('frontend', $key);
            $session->set('user_name', parent::name());
            $session->set('user_email', parent::email());

            return true;
        }
        return false;
    }

    public function name()
    {
        $value = $this->_get('name');
        return $value;
    }

    public function email()
    {
        $value = $this->_get('email');
        return $value;
    }

    private function _hash()
    {
        $rand = factories::get()->obj('core_model_random');
        $key = $rand->load();
        return $key;
    }
}
