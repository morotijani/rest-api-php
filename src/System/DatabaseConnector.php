<?php 

	namespace Src\System;

	class DatabaseConnector {
		private $dbConnection = null;

		public function __construct() {
			$hostname = $_ENV['DB_HOST'];
			$port = $_ENV['DB_POR'];
			$database = $_ENV['DB_DATABASE'];
			$username = $_ENV['DB_USERNAME'];
			$password = $_ENV['DB_PASSWORD'];

			try {
				$this->dbConnection = new \PDO(
					"mysql:host"
				);
			}
		}
	}