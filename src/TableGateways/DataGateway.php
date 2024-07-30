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

		public function insert() {}

		public function update() {}

		public function delete() {}
	
	}
	