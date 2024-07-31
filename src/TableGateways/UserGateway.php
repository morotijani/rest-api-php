<?php 
	namespace Src\TableGateways;

	class UserGateway {
		private $db = NULL;

		public function __construct($db) {
			$this->conn = $db;
		}

	}
