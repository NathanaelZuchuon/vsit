<?php

class dashboardVisitorsModel extends Model {
	public string $table = 'visitors';
	
	public function add ($fields, $values) {
		$this->insert($fields, $values);
	}
	
	public function infos ($fields, $constraints=null) : array {
		return $this->select($fields, $constraints);
	}
}
