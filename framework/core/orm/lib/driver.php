<?php
namespace Moya\core\orm\lib;

/**
 * 
 * Base class for all ORM DB drivers to extend.
 * @author tim.dhooge
 *
 */
class driver {
	public function getType(){
		return get_class($this);
	}
}