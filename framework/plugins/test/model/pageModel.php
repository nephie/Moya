<?php
namespace Moya\plugins\test\model;
use Moya\core\orm\model;

/**
 * 
 * Just testing
 * @author tim.dhooge
 *
 */
class pageModel extends model {
	protected $dbfields = array('name','longtitle');
	protected $mapping = array('longtitle' => 'title');
	
	protected $constraints = array(
		'name' => array('required', 'unique')
	);
}
?>