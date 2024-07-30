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
		}

		private function users($params = []) {

			switch ($this->requestMethod) {

				case 'GET':
					if ($params) {
						// code...
						$id = (isset($params[0]) ? $params[0] : NULL);
						$response = $this->getUser($id);
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
				return $response['body'];
			}
		}

		private function getAllUsers() {
			$result = $this->dataGateway->findAll();
			if (! $result) {
				return '{"status": "404", "message" : "No data found!"}';
			}
			$response['status_code_header'] = 'HTTP/1.1 200 OK';
			$response['body'] = json_encode($result);
			return $response;
		}

		private function getUser($id) {
			$result = $this->dataGateway->find($id);
			if (! $result) {
				return $this->notFoundResponse();
			}
			$response['status_code_header'] = 'HTTP/1.1 200 OK';
			$response['body'] = json_encode($result);
			return $response;
		}

		private function notFoundResponse() {
			$response['status_code_header'] = "HTTP/1.1 404 Not Found";
			$response['body'] = '{"status": "404", "message" : "User not found!"}';;
			return $response;
		}
	}
