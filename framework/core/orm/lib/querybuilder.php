<?php
namespace Moya\core\orm\lib;

/**
 * 
 * TODO: Turn this into a driver thing? Drivers are instanced,but turning this into a DQL style syntax and sending that to the driver is unneeded overhead?
 *
 * @author tim.dhooge
 *
 */
class querybuilder {
	
	protected $mode;
	protected $model;
	
	public function __construct($model,$mode){
		$this->mode = $mode;
		$this->model = $model;
	}
	
	public function where($field,$mode,$value){
		return $this;
	}
	
	public function execute(){
		
	}
}

?>