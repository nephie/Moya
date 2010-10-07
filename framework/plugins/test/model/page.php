<?php
namespace Moya\plugins\test\model;
use Moya\core\orm\lib\model;

/**
 * 
 * Just testing
 * @author tim.dhooge
 *
 */
class page extends model {
									
	protected $fields = array(
							'name' => array(
										'type' => 'STRING',
										'constraints' => array('required','unique','maxlength:100')
									),
							'title' => array(
										'type' => 'TEXT'
									)
	);
}
?>