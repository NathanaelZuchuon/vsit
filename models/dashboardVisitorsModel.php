<?php

namespace vsit\models;

use vsit\core\{Model};

class dashboardVisitorsModel extends Model {
	public string $table = 'visitors';
	
	public function add ($fields, $values) {
		$this->insert($fields, $values);
	}
	
	public function updateInfos ($fields, $values, $constraints) {
		$this->update($fields, $values, $constraints);
	}
	
	public function getInfos ($fields, $constraints=null, $optional_params=null) : array {
		return $this->select($fields, $constraints, $optional_params);
	}
	
	public function exec ($sql) : array {
		return $this->executeSQL($sql);
	}
	
	public function existenceCheck ($fields, $constraints) : bool {
		$arrived_at = $this->select(array($fields[0]), $constraints);
		$left_at = $this->select(array($fields[1]), $constraints);
		
		if ( count($arrived_at) != 0 || count($left_at) != 0 ) {
			if ( $arrived_at[0][0] == $left_at[0][0] ) {
				return true;
			}
		}
		return false;
	}
}
