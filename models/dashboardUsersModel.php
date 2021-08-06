<?php

class dashboardUsersModel extends Model {
	public string $table = 'users';
	
	public function id ($constraints) : int {
		return $this->getId($constraints);
	}
	
}
