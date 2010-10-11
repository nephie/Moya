<?php
namespace Moya\core\orm;

use Moya\core\util\config;
use Moya\core\util\inflector;
use Moya\core\orm\lib\lexer;
use Moya\core\orm\lib\statement;

class orm {
	
	protected static $cachedStatements;
	
	public static function query($query){
		$shortq = preg_replace('/\s*/m', '', $query);
		
		if(!self::$cachedStatements[$shortq] instanceof statement){
			$lexer = new lexer();		
			$parsedQuery = $lexer->parse($query);
			
			$statement = new statement();
			$statement->setQuery($parsedQuery);
			
			$datastore = $parsedQuery->getModel()->getDatastore();
			$driverclass = '\\Moya\\core\\orm\\drivers\\' . config::get('datastore', $datastore . '/driver');	

			$driver = $driverclass::getInstance($datastore);
			$statement->setDriver($driver);
			
			$statement->setCompiledquery($driver->compileQuery($parsedQuery));
			
			echo $statement->getCompiledquery() . "\n";
		
			self::$cachedStatements[$shortq] = $statement->prepare();
		}
		
		return self::$cachedStatements[$shortq];
	}

}
?>