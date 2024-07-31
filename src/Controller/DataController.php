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
					if (isset($params)) {
						$id = (isset($params[0]) ? $params[0] : NULL);
						$response = $this->updateUserFormRequest($id);
					}
					break;
				case 'DELETE':
					if (isset($params)) {
						$id = (isset($params[0]) ? $params[0] : NULL);
						$response = $this->deleteUser($id);
					}
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
				return $this->notFoundResponse();
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
			$validationBody = (isset($validation['body']) ? false : true);
			if (!$validationBody) {
				return $validation;
			}
			
			$insert = $this->dataGateway->insert($params);
			if ($insert) {
				$response['status_code_header'] = 'HTTP/1.1 201 Created';
				$response['body'] = json_encode([
					'status' => 'success',
					'message' => 'Account created!'
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

		private function updateUserFormRequest($id) {
			$result = $this->dataGateway->find($id);
			if (! is_array($result)) {
				return $this->notFoundResponse();
			}
			$params = (array) json_decode(file_get_contents('php://input'), true);
			$validation = $this->validateUser($params, $id);
			$validationBody = isset($validation['body']) ? false : true;
			if (!$validationBody) {
				return $validation;
			}
			$update = $this->dataGateway->update($id, $params);
			if ($update) {
				$response['status_code_header'] = 'HTTP/1.1 200 OK';
				$response['body'] = json_encode([
					'status' => 'success',
					'message' => 'Account updated!'
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

		private function deleteUser($id) {
			$result = $this->dataGateway->find($id);
			if (! is_array($result)) {
				return $this->notFoundResponse();
			}
			$delete = $this->dataGateway->delete($id);
			if ($delete) {
				$response['status_code_header'] = 'HTTP/1.1 200 OK';
				$response['body'] = json_encode([
					'status' => 'success',
					'message' => 'Account deleted!'
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

		private function validateUser($params, $id = null) {
			$response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';

			if (isset($params['user_email'])) {

				// check if email exist
				$data = run($this->db, "SELECT * FROM users WHERE user_email = ? LIMIT 1", [$params['user_email']], 'count');
				if ($id) {
					$data = run($this->db, "SELECT * FROM users WHERE user_email = ? AND user_id != ? ", [$params['user_email'], $id], 'count');
				}
				if ($data > 0) {
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
					$response['body'] = json_encode([
						'status' => 'error',
						'message' => 'Email is required!'
					]);
				}

			} else {
				return $this->unprocessableEntityResponse();
			}

			if (! isset($params['user_fullname'])) {
				return $this->unprocessableEntityResponse();
			}

			if (!$id) {
				if (! isset($params['user_password'])) {
					return $this->unprocessableEntityResponse();
				}
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
			$response['body'] = json_encode([
				'status' => 'error',
				'message' => 'No data found!',
			]);

			return $response;
		}
	}
