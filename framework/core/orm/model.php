<?php
namespace Moya\core\orm;
use Moya\core\orm\lib\querybuilder;
use \Moya\core\util as util;

/**
 * 
 * Base class for all models that use this ORM to extend.
 * @author tim.dhooge
 *
 */
class model {
	protected $driver;
	protected $datastore = 'default';
	
	protected $idfield = 'id';
	protected $dbfields = array();
	protected $mapping = array();
	
	protected $constraints = array();
	
	protected $behaviours = array();
	protected $associations = array();
	
	/**
	 * 
	 * Constructor. This will figure out which datastore the model uses (from config or default) and load the driver for that datastore.
	 *
	 * @TODO actually connect and stuff? 
	 */
	public function __construct(){
		
		$datastore = util\config::get($this, 'datastore');
		
		if($datastore != ''){
			$this->datastore = $datastore;
		}
		
		$driverclass = __NAMESPACE__ . '\\drivers\\' . util\config::get('datastore', $this->datastore . '/driver') . 'Driver';
		
		$this->driver = $driverclass::getInstance($datastore);
	}
	
	
	/**
	 * 
	 * Magic function for the select, delete functions
	 */
	public function __call($method, $arguments){
		switch($method){
			case 'get': return new querybuilder($this,'get');
				break;
		}
	}
}