<?php
namespace Moya\core\orm\drivers;

/**
 * 
 * MySQL ORM DB driver
 * @author tim.dhooge
 *
 */
class mysqlDriver extends pdoDriver {
	public function getInstance($datastore){
		if(! self::$instance[$datastore] instanceof mssqlDriver){
			self::$instance[$datastore] = new mssqlDriver($datastore); 
		}
		
		return self::$instance[$datastore];
	}
}
?>