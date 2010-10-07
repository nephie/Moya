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
	 * Context can either be a string or an object. If it is a string, it can not be the short <plugin>\<specific> version but it must be
	 * the FQDN! 
	 * 
	 * @param mixed $context
	 * @return string
	 */
	public static function getBasetypefromcontext($context){
		if(is_object($context)){
			$context = get_class($context);
		}
		
			
		$pieces = explode('\\',$context);
		
		for($i = 0; $i < count($pieces); $i++){
			if($pieces[$i] == 'plugins'){
				$basetype = $pieces[$i + 2];
				break;
			}
		}
		
		return $basetype;
	}
	
	/**
	 * 
	 * Get the plugin for a context.
	 * Context can either be a string or an object. the plugin is the part before a '\' for a string, or the part after \plugins\ in the namespace
	 * for an object.
	 * 
	 * @param mixed $context
	 * @return string
	 */
	public static function getPluginfromcontext($context){
		$plugin = '';
		
		if(is_object($context)){
			$class = get_class($context);
			
			$pieces = explode('\\',$class);
			
			for($i = 0; $i < count($pieces); $i++){
				if($pieces[$i] == 'plugins'){
					$plugin = $pieces[$i +1];
					break;
				}
			}
		}
		else {
			$pieces = explode('\\',$context);
			if(count($pieces) == 2){
				$plugin = $pieces[0];
			}
			elseif (count($pieces) > 2){
				for($i = 0; $i < count($pieces); $i++){
					if($pieces[$i] == 'plugins'){
						$plugin = $pieces[$i +1];
						break;
					}
				}
			}
			
		}
		
		return $plugin;
	}
	
	/**
	 * 
	 * Get the specific part of a context.
	 * Context can either be a string or an object. the specific part is the part after the '\' in a string, or the last part of the namespace for
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
			@list($null,$specific) = explode('\\',$context);
			if ($specific == ''){
				$specific = $null;
			}
		}
		
		return $specific;
	}

	public static function getModelfromcontext($context){
		$basetype = inflector::getBasetypefromcontext($context);
		
		if(is_object($context) && $basetype == 'model'){
			$object = get_class($context);
		}
		else {	
			$plugin = inflector::getPluginfromcontext($context);
			$specific = inflector::getSpecificfromcontext($context);
					
			if($plugin == 'core'){
				$model = '\Moya\core\model\\' . $specific;
			}
			else {
				$model = '\Moya\plugins\\' . $plugin . '\model\\' . $specific;
			}
			
			return $model;
		}		
	}
	
	public static function getObjectfromcontext($context){
		$basetype = inflector::getBasetypefromcontext($context);
		
		if(is_object($context) && $basetype == 'object'){
			$object = get_class($context);
		}
		else {		
			$plugin = inflector::getPluginfromcontext($context);
			$specific = inflector::getSpecificfromcontext($context);
								
			if($plugin == 'core'){
				$object = '\Moya\core\object\\' . $specific;
			}
			else {
				$object = '\Moya\plugins\\' . $plugin . '\object\\' . $specific;
			}
		}
		
		return $object;
	}
}
?>