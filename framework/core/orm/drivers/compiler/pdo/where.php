<?php
namespace Moya\core\orm\drivers\compiler\pdo;

use Moya\core\orm\lib\query;

class where {
	public function compile(query $query,$part){
		$querystr = 'WHERE '; 
				
		$querystr .=  $this->leftcolident . $part['field']['model']->getTable() . $this->rightcolident . '.';
		$querystr .=  $this->leftcolident . $part['field']['model']->getDbfieldfor($part['field']['field']) . $this->rightcolident . ' ';
		$querystr .= $part['mode'] . ' ';
		$querystr .= $part['value'];
		
		return $querystr;
	}
}
?>