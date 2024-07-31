<?php

	require ("../bootstrap.php");

	use Src\Controller\DataController;
	use Src\Jwt;
	use Src\Auth;
	use Src\TableGateways\UserGateway;

	$user = new UserGateway($dbConnection);

	$payload = [
		"sub" => $user['id'],
		"name" => $user["name"],
		"exp" => time() + 20
	];

	$JwtController = new Jwt($_ENV["SECRET_KEY"]);

	$access_token = $JwtController->encode($payload);

	$referesh_token_expiry = time() + 432000;

	$refresh_token = $JwtController->encode([
		"sub" => $user["id"],
		"exp" => $referesh_token_expiry
	]);

	echo json_encode([
		"access_token" => $access_token,
		"refresh_token" => $refresh_token
	]);
