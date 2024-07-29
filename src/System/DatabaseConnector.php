<?php 

	namespace Src\System;

	class DatabaseConnector {
		private $dbConnection = null;

		public function __construct() {
			$driver = $_ENV['DB_DRIVER'];
			$hostname = $_ENV['DB_HOST'];
			$port = $_ENV['DB_PORT'];
			$database = $_ENV['DB_DATABASE'];
			$username = $_ENV['DB_USERNAME'];
			$password = $_ENV['DB_PASSWORD'];


			try {

				$string = $driver . ":host=" . $hostname . ";charset=utf8mb4;dbname=" . $database;
				$this->dbConnection = new \PDO(
					$string, $username, $password
				);
			} catch (\PDOException $e) {
				exit($e->getMessage());
			}
		}

		public function getConnection() {
			return $this->dbConnection;
		}
	}
	