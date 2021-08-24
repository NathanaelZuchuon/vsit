<?php

namespace vsit\models;

use vsit\core\{Model};

class loginModel extends Model {
	public string $table = 'users';
	
	public function getUserInfo ($fields, $constraints) : array {
		return $this->select($fields, $constraints);
	}
}
