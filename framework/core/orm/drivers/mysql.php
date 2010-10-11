<?php
namespace Moya\core\orm\drivers;

/**
 * 
 * MySQL ORM DB driver
 * @author tim.dhooge
 *
 */
use Moya\core\util\config;

class mysql extends pdo {
		
	public function getInstance($datastore){
		if(! self::$instance[$datastore] instanceof mysql){
			self::$instance[$datastore] = new mysql($datastore); 
		}
		
		return self::$instance[$datastore];
	}
	
	protected function __construct($datastore){
		$config = config::get('datastore',$datastore);
		
		$this->dbtype = $config['driver'];
		
		$this->pdo = new \PDO($config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'],$config['username'],$config['password']);
		$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);	
	}
}
?>