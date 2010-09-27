<?php
class driver {
	public function getType(){
		return get_class($this);
	}
}