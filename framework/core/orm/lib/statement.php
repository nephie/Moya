<?php
namespace Moya\core\orm\lib;

use Moya\core\lib\getandsetLib;

class statement extends getandsetLib {
	
	protected $query;
	protected $driver;
	protected $compiledquery;
	
	protected $driverstatement;
	
	public function setParameter($parameter,$value){
		$this->driver->setParameter($this->driverstatement,$parameter,$value);
		return $this;
	}
	
	public function prepare(){
		$this->driverstatement = $this->driver->prepare($this->compiledquery);
		return $this;
	}
	
	public function execute($params = array()){
		$this->driver->execute($this->driverstatement,$params);
		return $this;
	}
	
	public function fetchAll(){
		$data = $this->driver->fetchAll($this->driverstatement);
		
		$model = $this->query->getModel();
		$objects = $model->getObjects($data);
		
		return $objects;
	}
	
	public function fetch(){
		$data = $this->driver->fetch($this->driverstatement);
		
		$model = $this->query->getModel();
		$object = $model->fillObject($data);
		
		return $object;
	}
	
	public function fetchOne(){
		
	}
}
?>