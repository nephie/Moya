<?php
namespace Moya\core\orm\lib;

use Moya\core\util\inflector;

use Moya\core\lib\getandsetLib;
use \Moya\core\util\config;

/**
 * 
 * Base class for all models that use this ORM to extend.
 * @author tim.dhooge
 *
 */
class model extends getandsetLib {
	protected $datastore = 'default';
	
	protected $idfield = array('id' => array(
										'type' => 'INT'
									));
	protected $fields = array();
	protected $mapDbToObject = array();
	protected $behaviours = array();
	protected $associations = array();
	
	protected $table;
	
	/**
	 * 
	 * Constructor. This will figure out which datastore the model uses (from config or default).
	 *
	 */
	public function __construct(){
		
		$datastore = config::get($this, 'datastore');
		
		if($datastore != ''){
			$this->datastore = $datastore;
		}
		
		$map = config::get($this, 'mapDbToObject');
		if(is_array($map)){
			$this->mapDbToObject = $map;
		}
		
		if($this->table == ''){
			$this->table = inflector::getSpecificfromcontext($this);
		}
	}
	
	public function getDbfieldfor($field){
		$flipmap = array_flip($this->mapDbToObject);
				
		if(isset($flipmap[$field])){
			return $flipmap[$field];
		}
		else {
			return $field;
		}
	}
	
	public function getObjectfieldfor($field){
		if(isset($this->mapDbToObject[$field])){
			return $this->mapDbToObject[$field];
		}
		else {
			return $field;
		}
	}
	
	public function getDbfields(){
		$output = array();

		foreach($this->idfield as $field => $conf){
			$output[$this->getDbfieldfor($field)] = $conf;
		}
		
		foreach($this->fields as $field => $conf){
			$output[$this->getDbfieldfor($field)] = $conf;
		}
		
		return $output;
	}
	
	public function getObjects($data){
		$objects = array();
		
		foreach($data as $row){
			$objects[] = $this->fillObject($row);
		}
		
		return $objects;
	}
	
	/**
     * This function will return a object filled with the data contained in the array given as parameter
     *
     */
	protected  function fillObject($data){
		$objecttype = inflector::getObjectfromcontext($this);
		$object = new $objecttype();

		foreach($data as $field => $value){
			$objectfield = $this->getObjectfieldfor($field);
			
			$func = 'set' . ucfirst($objectfield);
			$object->$func($value);
		}
		
		return $object;
	}
	
}