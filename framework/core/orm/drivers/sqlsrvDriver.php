<?php
namespace Moya\core\orm\drivers;

/**
 * 
 * MSSQL ORM DB driver
 * @author tim.dhooge
 *
 */
use Moya\core\util\config;

class sqlsrvDriver extends pdoDriver {
	
	protected $leftcolident = '[';
	protected $rightcolident = ']';
	
	public function getInstance($datastore){
		if(! self::$instance[$datastore] instanceof sqlsrvDriver){
			self::$instance[$datastore] = new sqlsrvDriver($datastore); 
		}
		
		return self::$instance[$datastore];
	}
	
	protected function __construct($datastore){
		$config = config::get('datastore',$datastore);
		
		$this->pdo = new \PDO($config['driver'] . ':Server=' . $config['host'] . ' ; Database=' . $config['database'],$config['username'],$config['password']);	
	}
}
?>