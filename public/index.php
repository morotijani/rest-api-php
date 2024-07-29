<?php
	
	require "../bootstrap.php";

	use Src\Controller\DataController;

	
	// $uri = pasre_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	// $uri = explode( '/', $uri );

	$userId = NULL;
	$requestMethod = $_SERVER["REQUEST_METHOD"];

	// $app = new APP;
	$controller = new DataController($dbConnection, $requestMethod, $userId);
 	if (isset($_GET['url'])) {
 		// code...
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
		header("Access-Control-Max-Age: 3600");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	 	$controller->processRequest();
 	}

