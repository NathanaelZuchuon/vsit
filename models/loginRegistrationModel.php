<?php

namespace vsit\models;

use vsit\core\{Model};

class loginRegistrationModel extends Model {
	public string $table = 'users';
	
	public function getUserInfo ($fields, $constraints) : array {
		return $this->select($fields, $constraints);
	}
	
	public function setUserInfo ($fields, $values) {
		$this->insert($fields, $values);
	}
}
