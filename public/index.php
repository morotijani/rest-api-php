<?php
	// declare(strict_types=1);
	require "../bootstrap.php";

	require "tokens.php";


	use Src\Controller\DataController;
	use Src\Jwt;
	use Src\Auth;
	use Src\UserGateway;

	$user = new UserGateway($dbConnection);

	$JwtCtrl = new Jwt($_ENV["SECRET_KEY"]);
	$auth = new Auth($user, $JwtCtrl);
	//dnd($_SERVER);
	if (! $auth->authenticateJWTToken()) {
		// code...
		exit();
	}

	$userId = NULL;
	$requestMethod = $_SERVER["REQUEST_METHOD"];

	// eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjEyMzQ1IiwibmFtZSI6ImFkbWluIn0.xbLM0qm331YhqpWD0amSnNi2lUygNlyvqWqBJPpMfjM

	// $payload = [
	// 	'id' => "12345",
	// 	"name" => "admin"
	// ];

	// $JwtController = new Jwt($_ENV["SECRET_KEY"]);
	// $token = $JwtController->encode($payload);

	// echo json_encode(["token" => $token]);

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

 	$refresh_token_gateway = new RefreshTokenGateway($dbConnection, $_ENV['SECRET_KEY']);
 	$refresh_token_gateway->create($refresh_token, $refresh_token_expiry);

 	// function authenticate() {
 	// 	try {
 	// 		switch (true) {
 	// 			case array_ey_exists('HTTP_AUTHORIZATION', $_SERVER):
 	// 				$authHeader = $_SERVER['HTTP_AUTHORIZATION'];
 	// 				break;
 	// 			case array_key_exists('Authorization', $_SERVER): 
    //                 $authHeader = $_SERVER['Authorization'];
    //                 break;
 	// 			default:
 	// 				// code...
 	// 				$authHeader = NULL;
 	// 				break;
 	// 		}

 	// 		preg_match('/Brearer\s(\S+)/', $authHeader, $matches);
 	// 		if (!isset($matches[1])) {
 	// 			throw new \Exception('No Bearer Token!');
 	// 		}
 	// 		$jwtVerifier = 
 	// 	} catch (Exception $e) {
 			
 	// 	}
 	// }
