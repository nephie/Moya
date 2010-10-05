<?php
namespace Moya\plugins\test\model;
use Moya\core\orm\lib\model;

/**
 * 
 * Just testing
 * @author tim.dhooge
 *
 */
class pageModel extends model {
									
	protected $dbfields = array(
							'name' => array(
										'type' => 'STRING',
										'constraints' => array('required','unique','maxlength:100')
									),
							'longtitle' => array(
										'type' => 'TEXT'
									)
	);
}
?>