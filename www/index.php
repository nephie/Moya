<?php
namespace Moya;

//	Set up the base environment
include 'defines.php';

//	Get the base class loaded in
include FRAMEWORK . DS . 'moya.php';

//	Load up that base class
$moya = new Moya();

//	And start it up
$moya->run();

?>