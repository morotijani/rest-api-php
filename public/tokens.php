<?php

	use Src\Jwt;
	// contains detailed user information
	$payload = [
		"sub" => $user[0]->id,
		"name" => $user[0]->name,
		"exp" => time() + 20 // expiration is shorter (20 seconds) for security reasons
	];

	$JwtController = new Jwt($_ENV["SECRET_KEY"]);

	$access_token = $JwtController->encode($payload);

	$refresh_token_expiry = time() + 432000; // expiration (5 days) to allow for longer-lasting authentication without needing frequent logins

	$refresh_token = $JwtController->encode([
		"sub" => $user[0]->id,
		"exp" => $refresh_token_expiry
	]);

	echo json_encode([
		"access_token" => $access_token,
		"refresh_token" => $refresh_token
	]);
