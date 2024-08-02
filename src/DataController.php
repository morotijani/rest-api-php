<?php
	namespace Src;

	use Src\Controller\UsersController;
	use Src\Controller\HousesController;

	class DataController {
		private $db;
		private $requestMethod;
		public $result = "{}";

    	private $dataGateway;

		public function __construct($db, $requestMethod) {

			$this->db = $db;
			$this->requestMethod = $requestMethod;

			if (isset($_GET['url'])) {
				$rawUrl = $_GET['url'];
				$URL = explode("/", trim($rawUrl, '/')); // trim the url with any last forward slash
				$table = $URL[0]; // grab the table name from the get variable
				unset($URL[0]); // and unset the key 
				$params = array_values($URL); // reset the remaing urls values keys starting from 0

				if (is_callable([$this, $table])) {
			 		$this->result = $this->$table($params);
			 	} else {
			 		$response['status_code_header'] = "HTTP/1.1 404 Not Found";
					$response['body'] = json_encode([
						'status' => 'error',
						'message' => 'Invalid URL!',
					]);
					echo $response['body'];
			 	}
			} else {
				$this->index();
			}

		}

		// load index page
		private function index() {
			require ("home.php");
		}

		private function users($params = []) {			
			$controller = new UsersController($this->db, $this->requestMethod);
			$controller->processRequest($params);
		}

		private function houses($params = []) {			
			$controller = new HousesController($this->db, $this->requestMethod);
			$controller->processRequest($params);
		}
	}
