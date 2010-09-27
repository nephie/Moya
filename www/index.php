<?php
namespace Moya;
use \Moya\plugins\test\model as test;

require_once 'defines.php';
include FRAMEWORK . DS . 'core' . DS . 'util' . DS . 'autoloader.php';
spl_autoload_register('\\Moya\\core\\util\\autoloader');

$userModel = new test\userModel();

echo $userModel->getDriver();


?>