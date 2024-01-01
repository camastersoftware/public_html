<?php namespace App\Libraries;

class ConnectDb
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
    
	public function admin($caFirmId)
	{
        // 'username' => 'camaster_firm_user',
        // 'password' => 'n8XF!.kIs0Wg',
        // 'database' => 'camaster_ca_firm_'.$caFirmId,

        if($_SERVER['SERVER_ADDR']=='127.0.0.1')
        {
            $ca_firm_db_user="root";
            $ca_firm_db_pass="";
            $ca_firm_db_name=PROJ_PREFIX.'_ca_firm_'.$caFirmId;
        }
        else
        {
            $ca_firm_db_user=FIRM_DB_USERNAME;
            $ca_firm_db_pass=FIRM_DB_PASSWORD;
            $ca_firm_db_name=PROJ_PREFIX.'_ca_firm_'.$caFirmId;
        }

        $this->adminDB = [
            'DSN'      => '',
            'hostname' => 'localhost',
            'username' => $ca_firm_db_user,
            'password' => $ca_firm_db_pass,
            'database' => $ca_firm_db_name,
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