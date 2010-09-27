<?php
namespace Moya\core\orm\lib;

class driver {
	public function getType(){
		return get_class($this);
	}
}