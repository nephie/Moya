<?php
namespace Moya;
use Moya\core\orm\drivers\sqlsrv;

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
				
//		$stm = orm::query('SELECT test\page WHERE [id] = {:id} OR ([title] LIKE {:title} AND [name] LIKE {:name})');
//		print_r($stm);
//		$pages = $stm->execute(array(':id' => '1',':title' => '%t%',':name' => '%'))->fetchAll();
//		print_r($pages);

		$stm = orm::query('SELECT test\page.name WHERE [title] IN (SELECT test\page.title WHERE [id] = {:id} OR ([title] LIKE {:title} AND [name] LIKE {:name}))');
		
		$pages = $stm->execute(array(':title' => '%t%',':name' => '%',':id' => '2'))->fetchAll();
		print_r($pages);

		
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