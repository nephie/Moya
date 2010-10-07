<?php
namespace Moya\core\orm;

use Moya\core\util\config;
use Moya\core\util\inflector;
use Moya\core\orm\lib\lexer;
use Moya\core\orm\lib\statement;

class orm {
	
	protected static $cachedStatements;
	
	public static function query($query){
		if(!self::$cachedStatements[$query] instanceof statement){
			$lexer = new lexer();		
			$parsedQuery = $lexer->parse($query);
			
			$statement = new statement();
			$statement->setQuery($parsedQuery);
			
			$datastore = $parsedQuery->getModel()->getDatastore();
			$driverclass = __NAMESPACE__ . '\\drivers\\' . config::get('datastore', $datastore . '/driver') . 'Driver';	

			$driver = $driverclass::getInstance($datastore);
			$statement->setDriver($driver);
			
			$statement->setCompiledquery($driver->compileQuery($parsedQuery));
		
			self::$cachedStatements[$query] = $statement;
		}
		
		return self::$cachedStatements[$query];
	}

}
?>