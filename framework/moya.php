<?php
namespace Moya;

/**
 * 
 * Entry point of everything.
 * 
 * @author tim.dhooge
 *
 */
use Moya\core\orm\orm;

class Moya {
	
	/**
	 * 
	 * Set everything up
	 */
	public function __construct(){
		include FRAMEWORK . DS . 'core' . DS . 'util' . DS . 'autoloader.php';
		spl_autoload_register('\Moya\core\util\autoloader');
	}
	
	/**
	 * 
	 * Fire up the framework and work out the request
	 */
	public function run(){
		echo '<pre>';
		
		$statement = orm::prepare('SELECT test\pageObject WHERE [id] = :id');
		
		$statement->setParameter(':id',1);
		$pages = $statement->fetch();
		if(count($pages) == 1){
			$page1 = $page[0];
		}
		
		$statement->setParameter(':id',2);
		$page2 = $statement->fetchOne();
		
		$title = '%tes%';
		$pages = orm::fetch('SELECT test\pageObject WHERE [title] LIKE :1 ',$title);
					
		echo '</pre>';
	}
}

?>