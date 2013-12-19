<?php
/**
 *
 */
class user_model_user
{
    private $_user;

    private $_passwordSalt = 'no_rainbow_please';
   
    public function login($email, $passwd)
    {
        $user = factories::get()->obj('user_model_table');

        $user->load($email, 'email');
        $hashed = $this->_encrtypt($passwd);
        if ($user->exists() && $hashed === $user->get('password')) {
            $this->_user($user);
            return true;
        }
        return false;
    }

    public function changePassword($value)
    {
        $user = factories::get()->obj('user_model_table');

        if (8 > strlen($value)) {
            return false;
        }

        $user->load($this->email());

        if ($user->exists()) {
            $hashed = $this->_encrtypt($value);
            $user->set($hashed, 'password');
            $user->save();
            return true;
        }

        return false;
    }

    public function name()
    {
        return $this->_user()->get('name'); 
    }

    public function surname()
    {
        return $this->_user()->get('surname'); 
    }

    public function email()
    {
        return $this->_user()->get('email'); 
    }

    private function _hash($value)
    {
        return hash('sha256', $value);
    }

    private function _encrtypt($passwd)
    {
        $passwd .= $this->_passwordSalt;
        return $this->_hash($passwd);
    }

    protected function _user(user_model_table $user = null)
    {
        if (is_null($user)) {
            if (!isset($this->_user)) {
                $this->_user = factories::get()->obj('user_model_table');
            }
            return $this->_user;
        }
        $this->_user = $user;
    }
}
