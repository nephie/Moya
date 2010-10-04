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
		if(! self::$instance[$datastore] instanceof mysqlDriver){
			self::$instance[$datastore] = new mysqlDriver($datastore); 
		}
		
		return self::$instance[$datastore];
	}
}
?>