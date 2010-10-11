<?php
namespace Moya\core\orm\lib\parser;

use Moya\core\util\config;

use Moya\core\util\inflector;

use Moya\core\orm\lib\lexer;

class where {
	
	
	/*
	 
	 array('type' => 'AND',
 			'conditions' => array(
 				array('field','mode','value'),
 				array('field','mode','value'),
 				array( 'type' => 'OR',
 					   'conditions' => array(
 					   		array('field','mode','value'),
 					   		array('field','mode','value')
 					   ),
 				array( 'type' => 'OR',
 					   'conditions' => array(
 					   		array('field','mode','value'),
 					   		array('field','mode','value')
 					   )
 			)
	 				
	 
	 */
	public function parse(lexer $lexer){
		
		$condition = $this->recursiveParse($lexer);
		
		$lexer->query->addPart(array('WHERE' => $condition));
	}
	
	protected function recursiveParse(lexer $lexer){
		$done = false;
		
		$level = array('type' => 'AND', 'conditions' => array());
		
		while(!$done){
			$token = strtolower($lexer->getCurrentToken());
			switch($token){
				case '[': $level['conditions'][] = $this->parseCondition($lexer);
					break;
				case 'and': $level['type'] = 'AND'; $lexer->moveNext();
					break;
				case 'or': $level['type'] = 'OR'; $lexer-> moveNext();
					break;
					
				case '(': $lexer->moveNext(); 
						$level['conditions'][] = $this->recursiveParse($lexer);
					break;
					
				case ')': $lexer->moveNext();
					$done = true;
					break;
				default : $done = true; 
					break;
			}
		}
		
		return $level;
	}
	
	
	protected function parseCondition(lexer $lexer){
		
		$fieldarray = $this->parseField($lexer);
		
		$mode = $lexer->getCurrentToken();		
		$lexer->moveNext();
		
		switch($lexer->getCurrentToken()){
			case '{': $value = $this->parseParameter($lexer);
				break;
			case '(': $value = ' (' . $this->parseSubselect($lexer) . ') ';
				break;
		}
		
		return array('field' => $fieldarray ,'mode' => $mode, 'value' => $value);
	}
	
	protected function parseSubselect(lexer $lexer){
		$subtokens = array();
		$nested = 0;
		
		$lexer->movenext();
		
		while($lexer->getCurrentToken() != ')' && $nested == 0){
			$subtokens[] = $lexer->getCurrentToken();
			
			$lexer->moveNext();
			
			if($lexer->getCurrentToken() == '('){
				$nested++;
			}
			elseif($lexer->getCurrentToken() == ')'){
				$nested--;
			}
		}
		
		$sublexer = new lexer();
		$subquery = $sublexer->parse($subtokens);
		
		$datastore = $subquery->getModel()->getDatastore();
		$driverclass = '\\Moya\\core\\orm\\drivers\\' . config::get('datastore', $datastore . '/driver');	

		$driver = $driverclass::getInstance($datastore);
		
		$compiledSubquery = $driver->compileQuery($subquery);
		//TODO subselects over different datastores;
		return $compiledSubquery;
	}
	
	protected function parseParameter(lexer $lexer){
		$lexer->moveNext();
		
		$param = $lexer->getCurrentToken();
		
		while(!$lexer->isNextToken('}')){
			$lexer->moveNext();
			$param .= $lexer->getCurrentToken();
		}
				
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