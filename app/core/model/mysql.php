<?php
/**
 * Connects with db and access through adapter.
 *
 * @singleton
 */
class core_model_mysql 
{
    /**
     * @var Zend_Db_Adapter_Pdo_Mysql 
     */
    private static $_adapter = false;
 
    /**
     * @return Zend_Db_Adapter_Pdo_Mysql The singleton
     */
    public function adapter()
    {
        if (self::$_adapter == false) {
            $this->_initAdapter($this->_getIniFile());
        }
        return self::$_adapter;
    }
    
    protected function _initAdapter($iniFile, $env = 'production')
    {
        $config = new Zend_Config_Ini($iniFile, $env);

        self::$_adapter = Zend_Db::factory(
            'Pdo_Mysql', array(
                'host'     => $config->db->host,
                'username' => $config->db->user,
                'password' => $config->db->passwd,
                'dbname'   => $config->db->name
            )
        );  
    }

    protected function _getIniFile()
    {
        return SITE_PATH . 'etc/config.ini';
    } 
}
