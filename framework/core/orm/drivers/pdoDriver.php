<?php
namespace Moya\core\orm\drivers;
use \Moya\core\orm\lib\driver;
use \Moya\core\util\config;

abstract class pdoDriver extends driver {
	
	protected $pdo;

	protected function __construct($datastore){
		$config = config::get('datastore',$datastore);
		
		try {
			$this->pdo = new \PDO($config['driver'] . ':Server=' . $config['host'] . ' ; Database = ' . $config['database'],$config['username'],$config['password']);
		} catch (\PDOException $e){
			//	TODO: Error handling
		}
	}
}

?>