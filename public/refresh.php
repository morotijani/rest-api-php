<?php
	// declare(strict_types=1);
	require "../bootstrap.php";
	
	use Src\Jwt;

	if ($_SERVER["REQUEST_METHOD"] !== "POST") {
		// code...
		http_response_code(405);
		header("Allow: POST");
		exit();
	}

	$data = (array) json_decode(file_get_contents("php://input"), true);

	if (! array_key_exists("token", $data)) {
		// code...
		http_response_code(400);
		echo json_encode(["message" => "Missing token!"]);
		exit();
	}

	$JwtController = new Jwt($_ENV['SECRET_KEY']);