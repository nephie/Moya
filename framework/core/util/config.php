<?php
namespace Moya\core\util;

/**
 * 
 * Config util class. Provides a static method for reading config values.
 * @author tim.dhooge
 *
 */
class config {
	
	/**
	 * 
	 * Get a configuration value for a given context
	 * 
	 * The context can either be a string with format [<plugin>/]specificPart (where Part is the basetype like 'model') or an object,in which 
	 * case the namespace will provide the information
	 * 
	 * The field is what configuration field you desire. Nested configuration values can be requested by the base value, which will return an array
	 * or specific with the following format: 'base/sub/subsub'
	 *   
	 * @param mixed $context
	 * @param string $field
	 */
	public static function get($context, $field){
		$basetype = inflector::getBasetypefromcontext($context);
		$specific = inflector::getSpecificfromcontext($context);
		$plugin = inflector::getPluginfromcontext($context);
					
		if($context == $basetype){
			if($plugin == ''){
				if(file_exists(FRAMEWORK . DS . 'config' . DS . $specific . '.php')){
					require(FRAMEWORK . DS . 'config' . DS . $specific . '.php');
				}
			}
			elseif ($plugin == '%'){
				foreach(scandir(FRAMEWORK . DS . 'plugins') as $dynplugin){
					if(file_exists(FRAMEWORK . DS .'plugins' . DS . $dynplugin . DS . 'config' . DS . $specific . '.php')){
						require(FRAMEWORK . DS .'plugins' . DS . $dynplugin . DS . 'config' . DS . $specific . '.php');
						break;
					}
				}
			}			
			else {
				if(file_exists(FRAMEWORK . DS .'plugins' . DS . $plugin . DS . 'config' . DS . $specific . '.php')){
					require(FRAMEWORK . DS .'plugins' . DS . $plugin . DS . 'config' . DS . $specific . '.php');
				}
			}
		}
		else {
			if($plugin == ''){
				if(file_exists(FRAMEWORK . DS . 'config' . DS . $basetype . DS . $specific . '.php')){
					require(FRAMEWORK . DS . 'config' . DS . $basetype . DS . $specific . '.php');
				}
			}
			elseif ($plugin == '%'){
				foreach(scandir(FRAMEWORK . DS . 'plugins') as $dynplugin){
					if(file_exists(FRAMEWORK . DS .'plugins' . DS . $dynplugin . DS . 'config' . DS . $basetype . DS . $specific . '.php')){
						require(FRAMEWORK . DS .'plugins' . DS . $dynplugin . DS . 'config' . DS . $basetype . DS . $specific . '.php');
						break;
					}
				}
			}
			else {				
				if(file_exists(FRAMEWORK . DS .'plugins' . DS . $plugin . DS . 'config' . DS . $basetype . DS . $specific . '.php')){
					require(FRAMEWORK . DS .'plugins' . DS . $plugin . DS . 'config' . DS . $basetype . DS . $specific . '.php');
				}
			}
		}
		
		$fieldpieces = explode('/', $field);
		if(count($fieldpieces) == 1){
			return $config[$field];
		}
		else {
			$tmp = $config;
			for($i = 0; $i < count($fieldpieces); $i++){
				$tmp = $tmp[$fieldpieces[$i]];
			}
			
			return $tmp;
		}
	}
}
?>