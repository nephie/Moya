<?php
namespace Moya\core\orm\lib;

/**
 * 
 * Base class for all ORM DB drivers to extend.
 * @author tim.dhooge
 *
 */
abstract class driver {
	
	static protected $instance;
	
	protected function __construct($datastore){}
	protected function __clone(){}

	abstract public function getInstance($datastore);
	
	public function compileQuery(query $query){
		$querystr = '';
		
    	$parts = $query->getPart();
		
    	foreach($parts as $part){
    		$identifier = array_keys($part);
    		$identname = '\Moya\core\orm\drivers\compiler\\' . $this->dbtype . '\\' . strtolower($identifier[0]);
    	
	    	try {
	    		$identcompiler = new $identname();
	    		$querystr .= $identcompiler->compile($query,$part[$identifier[0]]);
	    	}
	    	catch(\Exception $e){
	    		throw new \Exception('Invalid query syntax: unknown identifier \'' . strtolower($type) . '\'');
	    	}
    	}	
    	
		return $querystr;
	}
}