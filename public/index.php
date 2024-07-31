<?php
	
	require "../bootstrap.php";
	require "../src/System/Functions.php";

	use Src\Controller\DataController;

	
	// $uri = pasre_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	// $uri = explode( '/', $uri );

	$userId = NULL;
	$requestMethod = $_SERVER["REQUEST_METHOD"];

	if (! authenticate()) {
		header("HTTP/1.1 401 Unauthorized");
		exit('Unauthorized!');
	}

	// $app = new APP;
	$controller = new DataController($dbConnection, $requestMethod, $userId);
 	if (isset($_GET['url'])) {
 		// code...
		header("Access-Control-Allow-Origin: *");
		header("Content-type: application/json; charset=UTF-8");
		header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
		header("Access-Control-Max-Age: 3600");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	 	$result = $controller->result;
	 	echo $result;
 	}

 	function authenticate() {
 		try {
 			switch (true) {
 				case array_ey_exists('HTTP_AUTHORIZATION', $_SERVER):
 					$authHeader = $_SERVER['HTTP_AUTHORIZATION'];
 					break;
 				case array_key_exists('Authorization', $_SERVER): 
                    $authHeader = $_SERVER['Authorization'];
                    break;
 				default:
 					// code...
 					$authHeader = NULL;
 					break;
 			}

 			preg_match('/Brearer\s(\S+)/', $authHeader, $matches);
 			if (!isset($matches[1])) {
 				throw new \Exception('No Bearer Token!');
 			}
 			$jwtVerifier = 
 		} catch (Exception $e) {
 			
 		}
 	}
