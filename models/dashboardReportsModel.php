<?php

namespace vsit\models;

use vsit\core\{Model};

class dashboardReportsModel extends Model {
	public string $table = 'reports';
	
	public function add ($fields, $values) {
		$this->insert($fields, $values);
	}
}
