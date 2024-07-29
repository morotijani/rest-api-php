<?php 

	require 'vendor/autoload.php';

	use Src\System\DatabaseConnector;
	
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	$dbConnection = (new DatabaseConnector())->getConnection();

	function dnd($data) {
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	    die;
	}
	