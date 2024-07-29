<?php
	namespace Src\TableGateways;

	class DataGateway {
		private $db = NULL;

		public function __construct($db) {
			$this->db = $db;
		}

		public function findAll() {

		}

		public function find() {}

		public function insert() {}

		public function update() {}

		public function delete() {}
	
	}
	