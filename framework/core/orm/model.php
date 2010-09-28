<?php
namespace Moya\core\orm;
use \Moya\core\util as util;

class model {
	protected $driver;
	protected $datastore = 'default';
	
	public function __construct(){
		
		$datastore = util\config::get($this, 'datastore');
		
		if($datastore != ''){
			$this->datastore = $datastore;
		}
		
		$driverclass = __NAMESPACE__ . '\\drivers\\' . util\config::get('datastore', $this->datastore . '/driver') . 'Driver';
		
		$this->driver = new $driverclass();
	}
	
	public function getDriver(){
		return $this->driver->getType();
	}
}