<?php
namespace Moya\core\orm\drivers\compiler\sqlsrv;

use Moya\core\orm\drivers\compiler\pdo as pdo;

class select extends pdo\select{
	protected $leftcolident = '[';
	protected $rightcolident = ']';
}
?>