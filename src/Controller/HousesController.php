<?php
	namespace Src\Controller;

	use Src\TableGateways\HousesGateway;
	use Src\TableGateways\UsersGateway;

	class HousesController {
		private $db;
		private $requestMethod;
		public $result = "{}";

    	private $houseGateway;
    	private $userGateway;

		public function __construct($db, $requestMethod) {

			$this->db = $db;
			$this->requestMethod = $requestMethod;
        	$this->houseGateway = new HousesGateway($db);
        	$this->userGateway = new UsersGateway($db);
		}

		public function processRequest($params) {
			$page = ((isset($params[0]) && $params[0] == 'page') && isset($params[1]) && !empty($params[1]) ? (int)$params[1] : '');
			switch ($this->requestMethod) {

				case 'GET':
					if ($params) {
						if ($params[0] == 'page') {
							$response = $this->getAllHouses($page);
						} else {
							$id = (isset($params[0]) ? $params[0] : NULL);
							$response = $this->getHouse($id);
						}
					} else {
						$response = $this->getAllHouses($page);
					}
					break;
				case 'POST':
					$response = $this->createHouseFromRequest();
					break;
				case 'PUT':
					if (isset($params)) {
						$id = (isset($params[0]) ? $params[0] : NULL);
						$response = $this->updateHouseFormRequest($id);
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

		private function getAllHouses($page) {
			$result = $this->houseGateway->findAll($page);
			if (! $result) {
				return $this->notFoundResponse();
			}
			$response['status_code_header'] = 'HTTP/1.1 200 OK';
			$response['body'] = json_encode($result);
			return $response;
		}

		private function getHouse($id) {
			$result = $this->houseGateway->find($id);
			if (! $result) {
				return $this->notFoundResponse();
			}
			$response['status_code_header'] = 'HTTP/1.1 200 OK';
			$response['body'] = json_encode($result);
			return $response;
		}

		private function createHouseFromRequest() {
			$params = (array) json_decode(file_get_contents('php://input'), true);
			$validation = $this->validateData($params);
			$validationBody = (isset($validation['body']) ? false : true);
			if (!$validationBody) {
				return $validation;
			}
			
			$this->houseGateway->insert($params);
			
			$response['status_code_header'] = 'HTTP/1.1 201 Created';
			$response['body'] = json_encode([
				'status' => 'success',
				'message' => 'Data created!'
			]);
			
			return $response;
			
		}

		private function updateHouseFormRequest($id) {
			$result = $this->houseGateway->find($id);
			if (! is_array($result)) {
				return $this->notFoundResponse();
			}
			$params = (array) json_decode(file_get_contents('php://input'), true);
			$validation = $this->validateData($params, $id);
			$validationBody = isset($validation['body']) ? false : true;
			if (!$validationBody) {
				return $validation;
			}
			$this->houseGateway->update($id, $params);

			$response['status_code_header'] = 'HTTP/1.1 200 OK';
			$response['body'] = json_encode([
				'status' => 'success',
				'message' => 'Data updated!'
			]);

			return $response;
		}

		private function deleteUser($id) {
			$result = $this->houseGateway->find($id);
			if (! is_array($result)) {
				return $this->notFoundResponse();
			}

			$this->houseGateway->delete($id);
			
			$response['status_code_header'] = 'HTTP/1.1 200 OK';
			$response['body'] = json_encode([
				'status' => 'success',
				'message' => 'Data deleted!'
			]);
			return $response;
		}

		private function validateData($params, $id = null) {
			$response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';

			// check if house name already exist
			if ($id) {
				$query = "SELECT * FROM houses WHERE house_name = ? AND house_id != ?";
				$query_params = [$params['house_name'], $id];
			} else {
				$query = "SELECT * FROM houses WHERE house_name = ? LIMIT 1";
				$query_params = [$params['house_name']];
			}
			$data = run($this->db, $query, $query_params);
			if (is_array($data)) {
				$response['body'] = json_encode([
					'status' => 'error',
					'message' => $params['house_name'] . ' house, already exist!'
				]);
			}

			$user = $this->userGateway->find($params['user_id']);
			if (! $user) {
				$response['body'] = json_encode([
					'status' => 'error',
					'message' => 'User not found!'
				]);
			}


			if (! isset($params['user_id'])) {
				return $this->unprocessableEntityResponse();
			}

			if (! isset($params['house_name'])) {
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
			$response['body'] = json_encode([
				'status' => 'error',
				'message' => 'No data found!',
			]);

			return $response;
		}
	}
