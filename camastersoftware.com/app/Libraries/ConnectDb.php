<?php namespace App\Libraries;

class ConnectDb
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
    
	public function admin($caFirmId)
	{
        $this->adminDB = [
            'DSN'      => '',
            'hostname' => 'localhost',
            'username' => FIRM_DB_USERNAME,
            'password' => FIRM_DB_PASSWORD,
            'database' => FIRM_DB_NAME.$caFirmId,
            'DBDriver' => 'MySQLi',
            'DBPrefix' => '',
            'pConnect' => false,
            'DBDebug'  => (ENVIRONMENT !== 'production'),
            'charset'  => 'utf8',
            'DBCollat' => 'utf8_general_ci',
            'swapPre'  => '',
            'encrypt'  => false,
            'compress' => false,
            'strictOn' => false,
            'failover' => [],
            'port'     => 3306,
        ];

        $this->adminDB = \Config\Database::connect($this->adminDB);

        if($this->adminDB)
            return true;
        else
            return false;
	}
}


?>