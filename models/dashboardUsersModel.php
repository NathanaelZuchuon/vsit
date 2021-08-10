<?php

class dashboardUsersModel extends Model {
	public string $table = 'users';
	
	public function id ($constraints) : int {
		return $this->getId($constraints);
	}
	
	public function existenceCheck ($fields, $constraints) : bool {
		if ( count($this->select($fields, $constraints)) == 1 ) {
			return true;
		}
		return false;
	}
	
	public function updateInfos ($fields, $values, $constraints) {
		$this->update($fields, $values, $constraints);
	}
	
}
