<?php
namespace Moya;
use Moya\plugins\test\object\pageObject;
use Moya\core\orm\orm;

/**
 * 
 * Entry point of everything.
 * 
 * @author tim.dhooge
 *
 */
class Moya {
	
	/**
	 * 
	 * Set everything up
	 */
	public function __construct(){
		include FRAMEWORK . DS . 'core' . DS . 'util' . DS . 'autoloader.php';
		spl_autoload_register('\Moya\core\util\autoloader');
		
		include FRAMEWORK . DS . 'core' . DS . 'util' . DS . 'errortoexception.php';
		set_error_handler('\Moya\core\util\errortoexception' , E_ALL);
	}
	
	/**
	 * 
	 * Fire up the framework and work out the request
	 */
	public function run(){
		echo '<pre>';
		
		$statement = orm::query('SELECT test\page WHERE [id] = {1}')->prepare();
		
		$statement->setParameter(':id', 1);
		
		$pages = $statement->fetch();
		print_r($pages);
		//print_r($statement);
		/*
		//$statement = orm::prepare('SELECT test\page WHERE ( [test\page.id] = :id OR [name] LIKE :name) AND [title] LIKE :title');
		$statement->setParameter(':id',1);
		$statement->setParameter(':name','%tes%');
		$statement->setParameter(':title','%tes%');
		$pages = $statement->fetch();
		
		
		$statement->setParameter(':id',2);
		$page2 = $statement->fetchOne();
		
		$title = '%tes%';
		$pages = orm::fetch('SELECT test\page WHERE [title] LIKE :1 ',$title);
		*/			
		echo '</pre>';
	}
}

?>