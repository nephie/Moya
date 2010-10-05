<?php
namespace Moya\core\orm;
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
	
	protected $idfield = array('id' => array(
										'type' => 'INT'
									));
	protected $dbfields = array();
	
	protected $constraints = array();
	
	protected $behaviours = array();
	protected $associations = array();
	
	/**
	 * 
	 * Constructor. This will figure out which datastore the model uses (from config or default) and load the driver for that datastore.
	 *
	 */
	public function __construct(){
		
		$datastore = util\config::get($this, 'datastore');
		
		if($datastore != ''){
			$this->datastore = $datastore;
		}
		
		$driverclass = __NAMESPACE__ . '\\drivers\\' . util\config::get('datastore', $this->datastore . '/driver') . 'Driver';
		
		$this->driver = $driverclass::getInstance($datastore);
	}
}