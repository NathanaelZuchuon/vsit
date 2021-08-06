<?php

class dashboardPersonsModel extends Model {
	public string $table = 'persons';
	
	public function add ($fields, $values) {
		$this->insert($fields, $values);
	}
	
	public function existenceCheck ($fields, $constraints) : bool {
		if ( count($this->select($fields, $constraints)) == 1 ) {
			return true;
		}
		return false;
	}
	
	public function id ($constraints) : int {
		return $this->getId($constraints);
	}
	
	public function infos ($fields, $constraints=null) : array {
		return $this->select($fields, $constraints);
	}

}
