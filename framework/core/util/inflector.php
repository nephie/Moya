<?php
namespace Moya\core\util;

/**
 * 
 * Utility class to break down contexts and stuff
 * @author tim.dhooge
 *
 */
class inflector {
	
	/**
	 * 
	 * Get the basetype for a context.
	 * Context can either be a string or an object. The base type is the camelcased endpart (eg model in userModel)
	 * 
	 * @param mixed $context
	 * @return string
	 */
	public static function getBasetypefromcontext($context){
		if(is_object($context)){
			$context = get_class($context);
		}
		
		$context = strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $context));		
		@list($null,$basetype) = explode('_', $context);
		if($basetype == ''){
			$basetype = $null;
		}
		
		return $basetype;
	}
	
	/**
	 * 
	 * Get the plugin for a context.
	 * Context can either be a string or an object. the plugin is the part before a '/' for a string, or the part after \plugins\ in the namespace
	 * for an object.
	 * 
	 * @param mixed $context
	 * @return string
	 */
	public static function getPluginfromcontext($context){
		$plugin = '';
		
		if(is_object($context)){
			$rc = new \ReflectionClass($context);
			$path = $rc->getFileName();
			$dirpieces = explode(DS,$path);
			
			for($i = 0; $i < count($dirpieces); $i++){
				if($dirpieces[$i] == 'plugins'){
					$plugin = $dirpieces[$i +1];
					break;
				}
			}
		}
		else {
			@list($plugin,$null) = explode('/',$context);
			if ($null == ''){
				$plugin = $null;
			}
		}
		
		return $plugin;
	}
	
	/**
	 * 
	 * Get the specific part of a context.
	 * Context can either be a string or an object. the specific part is the part after the '/' in a string, or the last part of the namespace for
	 * an object.
	 * 
	 * @param mixed $context
	 * @return string
	 */
	public static function getSpecificfromcontext($context){
		$specific = '';
		
		if(is_object($context)){
			$specific = get_class($context);
			$pieces = explode('\\',$specific);
			$specific = array_pop($pieces);
		}
		else {
			@list($null,$specific) = explode('/',$context);
			if ($specific == ''){
				$specific = $null;
			}
		}
		
		return $specific;
	}
}
?>