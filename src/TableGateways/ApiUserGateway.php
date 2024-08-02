<?php 
	namespace Src\TableGateways;

	#[\AllowDynamicProperties]
	class ApiUserGateway {
		private $db = NULL;

		public function __construct($db) {
			$this->conn = $db;
		}

		public function getByAPIKey(string $key): array | false {
			$sql = "SELECT * FROM api_users WHERE api_key = ?";
			$statement = run($this->conn, $sql, [$key]);

			return $statement;
		}

		public function getByID(int $id): array | false {
			$sql = "SELECT * FROM api_users WHERE id = ?";
			$statement = run($this->conn, $sql, [$id]);

			return $statement;
		}

		public function getByUsername(string $username): array | false {
			$sql = "SELECT * FROM api_users WHERE username = ?";
			$statement = run($this->conn, $sql, [$username]);
			return $statement;
		}
	}
