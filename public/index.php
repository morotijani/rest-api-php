<?php
	declare(strict_types = 1);
	
	require "../bootstrap.php";

	use Src\DataController;
	use Src\Jwt;
	use Src\Auth;
	use Src\TableGateways\ApiUserGateway;
    use Src\TableGateways\RefreshTokenGateway;

	$requestMethod = $_SERVER["REQUEST_METHOD"];
	$controller = new DataController($dbConnection, $requestMethod);
 	
 	if (isset($_GET['url'])) {
		header("Access-Control-Allow-Origin: *");
		header("Content-type: application/json; charset=UTF-8");
		header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
		header("Access-Control-Max-Age: 3600");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
		
		$user = new ApiUserGateway($dbConnection);
		
		$JwtCtrl = new Jwt($_ENV["SECRET_KEY"]);
		$auth = new Auth($user, $JwtCtrl);

		if (! $auth->authenticateJWTToken()) {
			header("HTTP/1.1 401 Unauthorized");
	    	exit();
		}
		
		// Automatically delete expired tokens
		$delete_expired = new RefreshTokenGateway($dbConnection, '');
	    $delete_expired->deleteExpired();

	 	$controller->result;
 	}

