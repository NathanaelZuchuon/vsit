<?php

namespace vsit\models;

use vsit\core\{Model};

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
	
	public function getInfos ($fields, $constraints=null, $optional_params=null) : array {
		return $this->select($fields, $constraints, $optional_params);
	}

}
