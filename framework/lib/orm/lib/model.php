<?php
class model {
	protected $driver;
	protected $datastore = 'default';
	
	public function __construct(){
		require_once(FRAMEWORK . DS . 'lib' . DS .'orm' . DS .'lib' . DS .'driver.php');
		
		$datastore = config::get($this, 'datastore');
		if($datastore != ''){
			$this->datastore = $datastore;
		}
		
		$driverclass = config::get('datastore', $this->datastore . '/driver') . 'Driver';
		if(file_exists(FRAMEWORK . DS . 'lib' . DS .'orm' . DS .'drivers' . DS .'' . $driverclass . '.php')){
			require_once(FRAMEWORK . DS . 'lib' . DS .'orm' . DS .'drivers' . DS .'' . $driverclass . '.php');
			$this->driver = new $driverclass();
		}
		else {
			throw new Exception('Driver ' . $driverclass . ' not found.');
		}
	}
	
	public function getDriver(){
		return $this->driver->getType();
	}
}