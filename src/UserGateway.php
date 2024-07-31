<?php 
	namespace Src;

	class UserGateway {
		private $db = NULL;

		public function __construct($db) {
			$this->conn = $db;
		}

	}
