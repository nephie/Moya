<?php
namespace Moya\core\orm\drivers;
use Moya\core\orm\lib\query;

use \Moya\core\orm\lib\driver;
use \Moya\core\util\config;

abstract class pdo extends driver {
	
	protected $pdo;
	
	protected $dbtype;
	
	public function prepare($querystr){
		return $this->pdo->prepare($querystr);
	}
	
	public function execute($statement,$params){		
		if(count($params) > 0){
			$statement->execute($params);			
		}
		else {
			$statement->execute();
		}
	}
	
	public function setParameter($statement,$parameter,$value){
		$statement->bindValue($parameter,$value);
	}
	
	public function fetchAll($statement){		
		$data=  $statement->fetchAll(\PDO::FETCH_ASSOC);
		return $data;
	}
	
	public function fetch($statement){
		$data=  $statement->fetch(\PDO::FETCH_ASSOC);
		return $data;
	}
}

?>