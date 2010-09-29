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
	
}