<?php
	namespace Src\Controller;

	use Src\TableGateways\UsersGateway;

	class UsersController {
		private $db;
		private $requestMethod;
		public $result = "{}";

    	private $userGateway;

		public function __construct($db, $requestMethod) {

			$this->db = $db;
			$this->requestMethod = $requestMethod;
        	$this->userGateway = new UsersGateway($db);
		}

		public function processRequest($params) {
			$page = ((isset($params[0]) && $params[0] == 'page') && isset($params[1]) && !empty($params[1]) ? (int)$params[1] : '');
			switch ($this->requestMethod) {

				case 'GET':
					if ($params) {
						if ($params[0] == 'page') {
							$response = $this->getAllUsers($page);
						} else {
							$id = (isset($params[0]) ? $params[0] : NULL);
							$response = $this->getUser($id);
						}
					} else {
						$response = $this->getAllUsers($page);
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
				echo $response['body'];
			}
		}

		private function getAllUsers($page) {
			$result = $this->userGateway->findAll($page);
			if (! $result) {
				return $this->notFoundResponse();
			}
			$response['status_code_header'] = 'HTTP/1.1 200 OK';
			$response['body'] = json_encode($result);
			return $response;
		}

		private function getUser($id) {
			$result = $this->userGateway->find($id);
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
			
			$this->userGateway->insert($params);
			
			$response['status_code_header'] = 'HTTP/1.1 201 Created';
			$response['body'] = json_encode([
				'status' => 'success',
				'message' => 'Account created!'
			]);
			
			return $response;
			
		}

		private function updateUserFormRequest($id) {
			$result = $this->userGateway->find($id);
			if (! is_array($result)) {
				return $this->notFoundResponse();
			}
			$params = (array) json_decode(file_get_contents('php://input'), true);
			$validation = $this->validateUser($params, $id);
			$validationBody = isset($validation['body']) ? false : true;
			if (!$validationBody) {
				return $validation;
			}
			$this->userGateway->update($id, $params);

			$response['status_code_header'] = 'HTTP/1.1 200 OK';
			$response['body'] = json_encode([
				'status' => 'success',
				'message' => 'Account updated!'
			]);

			return $response;
		}

		private function deleteUser($id) {
			$result = $this->userGateway->find($id);
			if (! is_array($result)) {
				return $this->notFoundResponse();
			}

			$this->userGateway->delete($id);
			
			$response['status_code_header'] = 'HTTP/1.1 200 OK';
			$response['body'] = json_encode([
				'status' => 'success',
				'message' => 'Account deleted!'
			]);
			return $response;
		}

		private function validateUser($params, $id = null) {
			$response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';

			if (isset($params['user_email'])) {

				// check if email exist
				if ($id) {
					$query = "SELECT * FROM users WHERE user_email = ? AND user_id != ?";
					$query_params = [$params['user_email'], $id];
				} else {
					$query = "SELECT * FROM users WHERE user_email = ? LIMIT 1";
					$query_params = [$params['user_email']];
				}
				$data = run($this->db, $query, $query_params);
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
