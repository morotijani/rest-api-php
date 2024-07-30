<?php
	namespace Src\TableGateways;

	class DataGateway {
		private $db = NULL;

		public function __construct($db) {
			$this->db = $db;
		}

		public function findAll() {
			$sql = "SELECT * FROM users";
			try {
				$data = run($this->db, $sql, []);
				if (is_array($data)) {
					return $data;
				}
			} catch (PDOException $e) {
				exit($e->getMessage);
			}
		}

		public function find($id) {
			if ($id) {
				$sql = "SELECT * FROM users WHERE user_id = ? LIMIT 1";
				try {
					$data = run($this->db, $sql, [$id]);
					if (is_array($data)) {
						return $data;
					}
				} catch (\PDOException $e) {
					exit($e->getMessage);
				}
			}
		}

		public function insert(Array $params) {

			$uid = array('user_id' => guidv4());
			$params = array_merge($params, $uid);

			$array_keys = array_keys($params);
			$array_key = implode(',', $array_keys);

			$array_values = array_values($params);

			$values = '';
			for ($i=0; $i < count($array_keys); $i++) { 
				// code...
				$values .= '?,';
			}
			$values = rtrim($values, ',');

			$data = run($this->db, "INSERT INTO users ($array_key) VALUES ($values)", $array_values);
			return $data;
		}

		public function update() {}

		public function delete() {}
	
	}
	