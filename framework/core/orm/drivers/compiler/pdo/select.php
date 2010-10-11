<?php
namespace Moya\core\orm\drivers\compiler\pdo;

use Moya\core\orm\lib\query;

class select {
	protected $leftcolident;
	protected $rightcolident;
	
	public function compile(query $query,$part){
		$querystr = '';
		
		$model = $query->getModel();
		
		$querystr .= 'SELECT ';
		
		if($part == 'OBJECT'){
			$fields = $model->getDbfields();		
			$fieldnames = array_keys($fields);
			$querystr .= $this->leftcolident . implode($this->rightcolident . ', ' . $this->leftcolident,$fieldnames) . $this->rightcolident . ' ';
		}
		else {
			$querystr .= $this->leftcolident . $query->getModel()->getDbfieldfor($part) . $this->rightcolident . ' ';
		}
		
		$querystr .= 'FROM ';
		$querystr .= $this->leftcolident . $model->getTable() . $this->rightcolident . ' ';
		
		return $querystr;
	}
}
?>