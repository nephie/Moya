<?php
namespace Moya\core\util;

function autoloader($class){
	$relpath = str_replace('\\', DS, $class);
	$relpath = str_replace('Moya/','',$relpath);
	$classpath = FRAMEWORK . DS . $relpath . '.php';
	
	include $classpath;
}