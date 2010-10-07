<?php
namespace Moya\core\orm;

use Moya\core\util\inflector;
use Moya\core\orm\lib\lexer;
use Moya\core\orm\lib\statement;

class orm {
	
	public static function prepare($query){
		$lexer = new lexer();		
		$parsedQuery = $lexer->parse($query);
		
		return new statement();
	}
	
	public static function fetch($query){
		
	}
	
	public static function fetchOne($query){
		
	}

}
?>