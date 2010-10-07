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
	
	public function fetch(){
		$data = $this->driver->fetch($this->driverstatement);
		
		$model = $this->query->getModel();
		$objects = $model->getObjects($data);
		
		return $objects;
	}
	
	public function fetchOne(){
		
	}
}
?>