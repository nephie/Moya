<?php
namespace Moya\core\orm\drivers\compiler\sqlsrv;

use Moya\core\orm\drivers\compiler\pdo as pdo;

class where extends pdo\where {
	protected $leftcolident = '[';
	protected $rightcolident = ']';
}
?>