<?php
	// declare(strict_types=1);
	require "../bootstrap.php";

	use Src\Controller\DataController;
	use Src\Jwt;
	use Src\Auth;
	use Src\TableGateways\UserGateway;

	$user = new UserGateway($dbConnection);

	$JwtCtrl = new Jwt($_ENV["SECRET_KEY"]);
	$auth = new Auth($user, $JwtCtrl);
	if (! $auth->authenticateJWTToken()) {
		exit();
	}

	$userId = NULL;
	$requestMethod = $_SERVER["REQUEST_METHOD"];

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
