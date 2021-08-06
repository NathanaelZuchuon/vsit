<?php

include_once __DIR__ . '\config.php';

class Model {
	
	protected $db;
	protected string $table;
	private static $_db_instance;
	
	public function __construct () {
		$this->db = $this->getInstance();
	}
	
	private function getInstance () : PDO {
		global $host;
		global $db_name;
		global $db_user;
		global $db_password;
		
		if (is_null(self::$_db_instance)) {
			try {
				self::$_db_instance = new PDO( "mysql:host=$host;dbname=$db_name", $db_user, $db_password);
			} catch (Exception $e) {
				die('Erreur : ' . $e->getMessage());
			}
		}
		
		return self::$_db_instance;
	}
	
	private function getArrayExec ($fields, $values) : array {
		// Use for the execution of the prepared request
		$array_exec = array();
		for($i=0; $i<count($fields); $i++) {
			$array_exec[ $fields[$i] ] = $values[$i];
		}
		return $array_exec;
	}
	
	private function executeQuery($query, $array_exec) {
		$req = $this->db->prepare($query);
		$req->execute($array_exec);
	}
	
	protected function execute($query) : array {
		$req = $this->db->query($query);
		$req->execute();
		return $req->fetchAll();
	}
	
	private function joinConstraints ($separator, $constraints) : string {
		// Use for multiples constraint
		return join($separator, $constraints);
	}
	
	protected function insert ($fields, $values) {
		
		$array_exec = $this->getArrayExec($fields, $values);
		
		// Table Columns
		$columns = join(', ', $fields);
		
		foreach ($fields as $cle => $field ) {
			$fields[$cle] = ":" . $field;
		}
		
		// Prepared Request
		$data = join(', ', $fields);
		
		$sql = "INSERT INTO $this->table($columns) VALUES($data)";
		
		/* For testing */
//		echo "<pre>";
//		echo $sql;
//		echo "</pre>";
//		die();
		/* ----------- */
		
		$this->executeQuery($sql, $array_exec);
	}
	
	protected function select ($fields, $constraints=null, $optional_params=null) : array {
		// $optional_params is an array that contains ORDER BY | ORDER | OFFSET | LIMIT
		// e,g: SELECT fields FROM table WHERE constraints ORDER BY *ORDER BY* *ORDER* LIMIT *OFFSET*, *LIMIT*
		
		$fields = $this->joinConstraints(', ', $fields);
		$sql = "SELECT $fields FROM $this->table";
		
		if ( !is_null($constraints) ) {
			$constraints = $this->joinConstraints(' AND ', $constraints);
			$sql .= " WHERE $constraints";
		}
		
		if ( !is_null($optional_params) ) {
			foreach ($optional_params as $name => $value) {
				$$name = $value;
			}
			
			if ( !is_null($order_by) and !is_null($order) ) {
				$sql .= " ORDER BY $order_by $order";
			}
			if ( !is_null($offset) and !is_null($limit) ) {
				$sql .= " LIMIT :offset, :limit";
			}
			
			$req = $this->db->prepare($sql);
			
			$limit = (int) $limit;
			$offset = (int) $offset;
			
			$req->bindParam(':limit', $limit, PDO::PARAM_INT);
			$req->bindParam(':offset', $offset, PDO::PARAM_INT);
		} else {
			$req = $this->db->prepare($sql);
		}
		
		/* For testing */
//		echo "<pre>";
//		echo $sql;
//		echo "</pre>";
//		die();
		/* ----------- */
		
		$req->execute();
		
		return $req->fetchAll();
		
	}
	
	protected function getId($constraints) : int {
		return $this->select(array('id'), $constraints)[0]['id'];
	}
	
	protected function update ($fields, $values, $constraints) {
		
		// Use in the declaration of prepared request
		$set = array();
		for ($i=0; $i<count($fields); $i++) {
			$set[$i] = $fields[$i] . ' = :' . $fields[$i];
		}
		$set = join(', ', $set);
		
		$array_exec = $this->getArrayExec($fields, $values);
		$constraints = $this->joinConstraints(' AND ', $constraints);
		
		$sql = "UPDATE $this->table SET $set WHERE $constraints";
		$this->executeQuery($sql, $array_exec);
	}
	
	protected function delete ($constraints) {
		$constraints = $this->joinConstraints(' AND ', $constraints);
		$req = $this->db->query("DELETE FROM $this->table WHERE $constraints");
		
		echo $req->rowCount() . ' lignes éffacées.';
	}
	
}
