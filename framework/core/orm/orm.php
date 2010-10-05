<?php
namespace Moya\core\orm;

use Moya\core\orm\lib\statement;

class orm {
	
	public static function prepare($query){
		return new statement();
	}
	
	public static function fetch($query){
		
	}
	
	public static function fetchOne($query){
		
	}
}
?>