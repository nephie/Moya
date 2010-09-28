<?php
namespace Moya\core\util;

/**
 * 
 * Include the file containing the requested class automatically.
 * The path for the class is computed from the namespace (each subnamespace is a directory)
 * 
 * @param string $class
 */
function autoloader($class){
	$relpath = str_replace('\\', DS, $class);
	$relpath = str_replace('Moya' . DS ,'',$relpath);
	$classpath = FRAMEWORK . DS . $relpath . '.php';
	
	include $classpath;
}