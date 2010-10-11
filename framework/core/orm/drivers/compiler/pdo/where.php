<?php
namespace Moya\core\orm\drivers\compiler\pdo;

use Moya\core\orm\lib\query;

class where {
	public function compile(query $query,$part){
		$querystr = 'WHERE '; 
		
		$querystr .= $this->recursiveCompile($part);
		
		return $querystr;
	}
	
	protected function recursiveCompile($part){
					
		$compiledPartConditons = array(); 
			
		$querystr .= '(';
			
		foreach($part['conditions'] as $partcond){
			if(!isset($partcond['type'])){
				$compiledPartConditons[] = $this->compileCondition($partcond);
			}
			else {
				$compiledPartConditons[] = $this->recursiveCompile($partcond);
			}
		}
		
		$querystr .= implode(' ' . $part['type'] . ' ',$compiledPartConditons);
		
		$querystr .= ')';
		
		return $querystr;
	}
	
	protected function compileCondition($part){
		$querystr = '';
		
		$querystr .=  $this->leftcolident . $part['field']['model']->getTable() . $this->rightcolident . '.';
		$querystr .=  $this->leftcolident . $part['field']['model']->getDbfieldfor($part['field']['field']) . $this->rightcolident . ' ';
		$querystr .= $part['mode'] . ' ';
		$querystr .= $part['value'];
		
		return $querystr;
	}
}
?>