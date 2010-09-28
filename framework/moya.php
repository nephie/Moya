<?php
namespace Moya;

/**
 * 
 * Entry point of everything.
 * 
 * @author tim.dhooge
 *
 */
class Moya {
	
	/**
	 * 
	 * Set everything up
	 */
	public function __construct(){
		include FRAMEWORK . DS . 'core' . DS . 'util' . DS . 'autoloader.php';
		spl_autoload_register('\\Moya\\core\\util\\autoloader');
	}
	
	/**
	 * 
	 * Fire up the framework and work out the request
	 */
	public function run(){
		
	}
}

?>