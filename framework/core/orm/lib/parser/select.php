<?php
namespace Moya\core\orm\lib\parser;

use Moya\core\orm\lib\lexer;
use Moya\core\util\inflector;

class select {
	public function parse(lexer $lexer){
		
		$lexer->query->setType('SELECT');
		$lexer->query->setObject(inflector::getObjectfromcontext($lexer->getCurrentToken()));
		$lexer->query->setModel(inflector::getModelfromcontext($lexer->getCurrentToken()));
		$lexer->moveNext();
	}
}

?>