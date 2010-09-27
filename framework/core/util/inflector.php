<?php
namespace Moya\core\util;

class inflector {
	
	public static function getBasetypefromcontext($subject){
		if(is_object($subject)){
			$subject = get_class($subject);
		}
		
		$subject = strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $subject));		
		@list($null,$basetype) = explode('_', $subject);
		if($basetype == ''){
			$basetype = $null;
		}
		
		return $basetype;
	}
	
	public static function getPluginfromcontext($subject){
		$plugin = '';
		
		if(is_object($subject)){
			$rc = new \ReflectionClass($subject);
			$path = $rc->getFileName();
			$dirpieces = explode('/',$path);
			
			for($i = 0; $i < count($dirpieces); $i++){
				if($dirpieces[$i] == 'plugins'){
					$plugin = $dirpieces[$i +1];
					break;
				}
			}
		}
		else {
			@list($plugin,$null) = explode('/',$subject);
			if ($null == ''){
				$plugin = $null;
			}
		}
		
		return $plugin;
	}
	
	public static function getSpecificfromcontext($subject){
		$specific = '';
		
		if(is_object($subject)){
			$specific = get_class($subject);
			$pieces = explode('\\',$specific);
			$specific = array_pop($pieces);
		}
		else {
			@list($null,$specific) = explode('/',$subject);
			if ($specific == ''){
				$specific = $null;
			}
		}
		
		return $specific;
	}
}
?>