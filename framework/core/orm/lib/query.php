<?php
namespace Moya\core\orm\lib;

use Moya\core\lib\getandsetLib;

class query extends getandsetLib {
	
	protected $model;
	protected $part;
	
	public function addPart($array){
		$this->part[] = $array;
	}
}
?>