<?php
namespace Moya\core\orm\lib\parser;

use Moya\core\orm\lib\lexer;
use Moya\core\util\inflector;

class select {
	public function parse(lexer $lexer){
		
		$lexer->query->setType('SELECT');
				
		$model = inflector::getModelfromcontext($lexer->getCurrentToken());
		$lexer->query->setModel(new $model());
		$lexer->moveNext();
	}
}

?>