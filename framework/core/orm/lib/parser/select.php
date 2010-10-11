<?php
namespace Moya\core\orm\lib\parser;

use Moya\core\orm\lib\lexer;
use Moya\core\util\inflector;

class select {
	public function parse(lexer $lexer){
				
		$model = inflector::getModelfromcontext($lexer->getCurrentToken());
		$lexer->query->setModel(new $model());
		
		if($lexer->isNextToken('.')){
			$lexer->moveNext();
			$lexer->moveNext();
			$field = $lexer->getCurrentToken();
		}
		else {
			$field = 'OBJECT';
		}
		
		$lexer->query->addPart(array('SELECT' => $field));
		
		$lexer->moveNext();
	}
}

?>