<?php 

	require 'vendor/autoload.php';
	require "src/System/Functions.php";

	use Src\System\DatabaseConnector;
	
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	$dbConnection = (new DatabaseConnector())->getConnection();

