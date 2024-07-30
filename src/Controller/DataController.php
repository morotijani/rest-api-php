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

		private function createUserFromRequest() {
			$params = (array) json_decode(file_get_contents('php://input'), true);
			$validation = $this->validateUser($params);
			$validationBody = isset($validation['body']) ? false : true;
			if (!$validationBody) {
				return $validation;
			}
			
			$insert = $this->dataGateway->insert($params);
			if ($insert) {
				// code...
				$response['status_code_header'] = 'HTTP/1.1 201 Created';
				$response['body'] = json_encode([
					'status' => 'success',
					'message' => 'User account created!'
				]);
			} else {
				$response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
				$response['body'] = json_encode([
					'status' => 'error',
					'message' => 'Something went wrong!'
				]);
			}
			return $response;
			
		}

		private function validateUser($params) {
			$response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';

			if (isset($params['user_email'])) {

				// check if email exist
				$data = run($this->db, "SELECT * FROM users WHERE user_email = ? LIMIT 1", [$params['user_email']]);
				if (is_array($data)) {
					$response['body'] = json_encode([
						'status' => 'error',
						'message' => 'Email, already exist!'
					]);
				}

				// check email validity
				if (!filter_var($params['user_email'], FILTER_VALIDATE_EMAIL)) {
					$response['body'] = json_encode([
						'status' => 'error',
						'message' => 'Invalid, email!'
					]);
				}

				if (empty($params['user_email']) || $params['user_email'] == '') {
					// code...
					$response['body'] = json_encode([
						'status' => 'error',
						'message' => 'Email is required!'
					]);
				}

			} else {
				return $this->unprocessableEntityResponse();
			}

			if (! isset($params['user_fullname'])) {
				// code...
				return $this->unprocessableEntityResponse();
			}

			if (! isset($params['user_password'])) {
				// code...
				return $this->unprocessableEntityResponse();
			}

			return $response;
		}

		private function unprocessableEntityResponse() {
			$response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
			$response['body'] = json_encode([
				'status' => 'error',
				'message' => 'Invalid input!',
			]);
			return $response;
		}

		private function notFoundResponse() {
			$response['status_code_header'] = "HTTP/1.1 404 Not Found";
			$response['body'] = '{"status": "404", "message" : "User not found!"}';;
			return $response;
		}
	}
