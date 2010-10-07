<?php
namespace Moya\core\orm\drivers;
use Moya\core\orm\lib\query;

use \Moya\core\orm\lib\driver;
use \Moya\core\util\config;

abstract class pdoDriver extends driver {
	
	protected $pdo;
	
	protected $leftcolident;
	protected $rightcolident;	

	public function prepare($querystr){
		return $this->pdo->prepare($querystr);
	}
	
	public function setParameter($statement,$parameter,$value){
		$statement->bindValue($parameter,$value);
	}
	
	public function fetch($statement){
		$statement->execute();
		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	public function compileQuery(query $query){
		$querystr = '';
		
		$model = $query->getModel();
		
		$querystr .= $query->getType() . ' ';
		
		$fields = $model->getDbfields();		
		$fieldnames = array_keys($fields);
		$querystr .= $this->leftcolident . implode($this->rightcolident . ', ' . $this->leftcolident,$fieldnames) . $this->rightcolident . ' ';
		
		$querystr .= 'FROM ';
		$querystr .= $this->rightcolident . $model->getTable() . $this->rightcolident . ' ';
		
		$querystr .= 'WHERE ';
		
		$conditions = $query->getCondition();
		
		$querystr .=  $this->leftcolident . $conditions['field']['model']->getTable() . $this->rightcolident . '.';
		$querystr .=  $this->leftcolident . $model->getDbfieldfor($conditions['field']['field']) . $this->rightcolident . ' ';
		$querystr .= $conditions['mode'] . ' ';
		$querystr .= $conditions['value'];
		
		return $querystr;
	}
}

?>