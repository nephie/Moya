<?php
namespace Moya\core\orm\drivers;

/**
 * 
 * MSSQL ORM DB driver
 * @author tim.dhooge
 *
 */
class sqlsrvDriver extends pdoDriver {
	
	public function getInstance($datastore){
		if(! self::$instance[$datastore] instanceof sqlsrvDriver){
			self::$instance[$datastore] = new sqlsrvDriver($datastore); 
		}
		
		return self::$instance[$datastore];
	}
}
?>