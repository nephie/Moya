<?php
namespace Moya\core\orm\lib\parser;

use Moya\core\orm\lib\lexer;
use Moya\core\util\inflector;

class select {
	public function parse(lexer $lexer){
				
		$model = inflector::getModelfromcontext($lexer->getCurrentToken());
		$lexer->query->setModel(new $model());
		$lexer->query->addPart(array('SELECT' => 'SELECT'));
		
		$lexer->moveNext();
	}
}

?>