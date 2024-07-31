<?php 
	namespace Src\TableGateways;

	class UserGateway {
		private $db = NULL;

		public function __construct($db) {
			$this->conn = $db;
		}

		public function getByID(int $id): array | false {
			$sql = "SELECT * FROM user WHERE id = ?";
			$statement = run($this->conn, $sql, [$id]);

			return $statement;
		}

		public function getByUsername(string $username): array | false {
			$sql = "SELECT * FROM user WHERE username = ?";
			$statement = run($this->conn, $sql, [$username]);
			return $statement;
		}

	}
