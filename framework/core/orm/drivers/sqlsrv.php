<?php
namespace Moya\core\orm\drivers;

/**
 * 
 * MSSQL ORM DB driver
 * @author tim.dhooge
 *
 */
use Moya\core\util\config;

class sqlsrv extends pdo {
	
	public function getInstance($datastore){
		if(! self::$instance[$datastore] instanceof sqlsrv){
			self::$instance[$datastore] = new sqlsrv($datastore); 
		}
		
		return self::$instance[$datastore];
	}
	
	protected function __construct($datastore){
		$config = config::get('datastore',$datastore);
		
		$this->dbtype = $config['driver'];
		
		$this->pdo = new \PDO($config['driver'] . ':Server=' . $config['host'] . ';Database=' . $config['database'],$config['username'],$config['password']);
		$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}
}
?>