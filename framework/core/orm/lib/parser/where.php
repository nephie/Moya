<?php
namespace Moya\core\orm\lib\parser;

use Moya\core\util\inflector;

use Moya\core\orm\lib\lexer;

class where {
	
	 protected $nestLevel = 0;
	
	public function parse(lexer $lexer){
		
		switch(strtolower($lexer->getCurrentToken())){
			case '[': $condition = $this->parseCondition($lexer);
				break;
			case '(': $this->nestlevel++; $lexer->moveNext();
				break;
			case ')': $this->nestLevel--; $lexer->moveNext();
				break;
			case 'and':
				break;
			case 'or':
				break;
		}
		
		$lexer->query->addCondition($condition);
	}
	
	
	protected function parseCondition(lexer $lexer){
		
		$fieldarray = $this->parseField($lexer);
		
		$mode = $lexer->getCurrentToken();		
		$lexer->moveNext();
		
		switch($lexer->getCurrentToken()){
			case '{': $value = $this->parseParameter($lexer);
		}
		
		return array('field' => $fieldarray ,'mode' => $mode, 'value' => $value);
	}
	
	protected function parseParameter(lexer $lexer){
		$lexer->moveNext();
		
		$param = $lexer->getCurrentToken();
		
		$lexer->moveNext();
		$lexer->moveNext();
		
		return $param;
	}
	
	protected function parseField(lexer $lexer){
		$lexer->moveNext();
		$object = '';
		if($lexer->isNextToken('.')){
			$modelclass = inflector::getModelfromcontext($lexer->getCurrentToken());
			$model = new $modelclass;
			$lexer->moveNext();
			$lexer->moveNext();
		}
		else {
			$model = $lexer->query->getModel();
		}
		
		$field = $lexer->getCurrentToken();
				
		if(!$lexer->isNextToken(']')){
			throw new \Exception('Invalid query syntax: Expected \']\' after ' . $lexer->getCurrentToken() );
		}
		
		$lexer->moveNext();
		$lexer->moveNext();
		
		return (array('model' => $model,'field' => $field));
	}
}

?>