<?php
	namespace Src\Controller;

	use Src\TableGateways\DataGateway;

	class DataController {
		private $db;
		private $requestMethod;
		private $dataId;
		public $result = "{}";

    	private $dataGateway;

		public function __construct($db, $requestMethod, $dataId) {

			$this->db = $db;
			$this->requestMethod = $requestMethod;
			$this->dataId = $dataId;

        	$this->dataGateway = new DataGateway($db);

			if (isset($_GET['url'])) {
				$rawUrl = $_GET['url'];
				$URL = explode("/", trim($rawUrl, '/')); // trim the url with any last forward slash
				$table = $URL[0]; // grab the table name from the get variable
				unset($URL[0]); // and unset the key 
				$params = array_values($URL); // reset the remaing urls values keys starting from 0

				if (is_callable([$this, $table])) {
			 		$this->result = $this->$table($params);
			 	}
			} else {
				$this->index();
			}

		}

		// load index page
		private function index() {
			require ("home.php");
		}


		public function processRequest() {


			switch ($this->requestMethod) {

				case 'GET':
					if ($this->params) {
						// code...
						$response = $this->getUser($this->params);
					} else {
						$response = $this->getAllUsers();
					}
					break;
				case 'POST':
					$response = $this->createUserFromRequest();
					break;
				case 'PUT':
					$response = $this->updateUserFormRequest();
					break;
				case 'DELETE':
					$response = $this->deleteUser();
					break;
				default:
					$response = $this->notFoundResponse();
					break;
			}
			header($response['status_code_header']);
			if ($response['body']) {
				echo $response['body'];
			}
		}

		private function users($params = []) {
			$id = (isset($params[0]) ? $params[0] : NULL);
			if ($id) {
				// code...
				$data = run($this->db, "SELECT * FROM users WHERE user_id = ? LIMIT 1", [$id]);
				if (is_array($data)) {
					// code...
					return json_encode($data);
				}
			} else {
				$data = run($this->db, "SELECT * FROM users", []);
				if (is_array($data)) {
					// code...
					return json_encode($data);
				} 
			}
		}

		private function getAllUsers() {
			$result = $this->dataGateway()->findAll();
		}
	}
