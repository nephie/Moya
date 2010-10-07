<?php
namespace Moya\core\orm\drivers;

/**
 * 
 * MySQL ORM DB driver
 * @author tim.dhooge
 *
 */
use Moya\core\util\config;

class mysqlDriver extends pdoDriver {
	
	protected $leftcolident = '`';
	protected $rightcolident = '`';
	
	public function getInstance($datastore){
		if(! self::$instance[$datastore] instanceof mysqlDriver){
			self::$instance[$datastore] = new mysqlDriver($datastore); 
		}
		
		return self::$instance[$datastore];
	}
	
	protected function __construct($datastore){
		$config = config::get('datastore',$datastore);
		
		$this->pdo = new \PDO($config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'],$config['username'],$config['password']);	
	}
}
?>