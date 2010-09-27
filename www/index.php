<?php

require_once 'defines.php';

require_once FRAMEWORK . DS . 'lib' . DS .'orm' . DS .'lib' . DS . 'model.php';
require_once FRAMEWORK . DS . 'plugins' . DS .'test' . DS .'model' . DS . 'userModel.php';
require_once FRAMEWORK . DS . 'lib' . DS . 'inflector' . DS . 'inflector.php';
require_once FRAMEWORK . DS . 'lib' . DS . 'config' . DS . 'config.php';

$userModel = new userModel();

echo $userModel->getDriver();


?>