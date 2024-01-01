<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
	/**
	 * The directory that holds the Migrations
	 * and Seeds directories.
	 *
	 * @var string
	 */
	public $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

	/**
	 * Lets you choose which connection group to
	 * use if no other is specified.
	 *
	 * @var string
	 */
	public $defaultGroup = 'default';

	/**
	 * The default database connection.
	 *
	 * @var array
	 */
	 
// 	'username' => 'camaster_adm_user',
// 	'password' => '0v7&wGH44~Td',
// 	'database' => 'camaster_admin',
	
	// 'username' => 'root',
	// 'password' => '',
	// 'database' => 'camaster_admin',

	// 'username' => 'camastersoftware_adm_usr',
	// 'password' => '^,57k}ab-0+^',
	// 'database' => 'camastersoftware_admin',
		
	public $default = [
		'DSN'      => '',
		'hostname' => 'localhost',
    	'username' => 'camastersoftware_adm_usr',
    	'password' => '^,57k}ab-0+^',
    	'database' => 'camastersoftware_admin',
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

	/**
	 * This database connection is used when
	 * running PHPUnit database tests.
	 *
	 * @var array
	 */
	public $tests = [
		'DSN'      => '',
		'hostname' => '127.0.0.1',
		'username' => '',
		'password' => '',
		'database' => ':memory:',
		'DBDriver' => 'SQLite3',
		'DBPrefix' => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
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

	//--------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();

		// Ensure that we always set the database group to 'tests' if
		// we are currently running an automated test suite, so that
		// we don't overwrite live data on accident.
		if (ENVIRONMENT === 'testing')
		{
			$this->defaultGroup = 'tests';
		}
		
		// 'username' => 'root',
		// 'password' => '',
		// 'database' => 'ca_admin_'.$this->sessCaFirmId,

		// 'username' => 'camaster_firm_user',
		// 'password' => 'n8XF!.kIs0Wg',
		// 'database' => 'camaster_ca_firm_'.$this->sessCaFirmId,

		$uri = service('uri');
        $uri1=$uri->getSegment(1);

		if($uri1=="admin")
		{
			$this->session = \Config\Services::session();

        	$this->sessCaFirmId=$this->session->get('caFirmId');

			if(!empty($this->sessCaFirmId))
			{
				if($_SERVER['SERVER_ADDR']=='127.0.0.1')
				{
					// $ca_firm_db_user="root";
					// $ca_firm_db_pass="";
					// $ca_firm_db_name='camaster_ca_firm_'.$this->sessCaFirmId;

					$ca_firm_db_user="root";
					$ca_firm_db_pass="";
					$ca_firm_db_name='camastersoftware_ca_firm_'.$this->sessCaFirmId;
				}
				else
				{
				    $ca_firm_db_user="camastersoftware_firm_user";
					$ca_firm_db_pass="_W8_16dQ$;)S";
					$ca_firm_db_name='camastersoftware_ca_firm_'.$this->sessCaFirmId;
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
			}
		}
		else
		{
		    $this->session = \Config\Services::session();

        	$this->sessCaFirmId=$this->session->get('caFirmId');

			if(!empty($this->sessCaFirmId))
			{
				if($_SERVER['SERVER_ADDR']=='127.0.0.1')
				{
					// $ca_firm_db_user="root";
					// $ca_firm_db_pass="";
					// $ca_firm_db_name='camaster_ca_firm_'.$this->sessCaFirmId;

					$ca_firm_db_user="root";
					$ca_firm_db_pass="";
					$ca_firm_db_name='camastersoftware_ca_firm_'.$this->sessCaFirmId;
				}
				else
				{
					$ca_firm_db_user="camastersoftware_firm_user";
					$ca_firm_db_pass="_W8_16dQ$;)S";
					$ca_firm_db_name='camastersoftware_ca_firm_'.$this->sessCaFirmId;
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
			}
		}
	}

	//--------------------------------------------------------------------

}
