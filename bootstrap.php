<?php 

	require 'vendor/autoload.php';
	require "src/System/Functions.php";
	require_once "src/ErrorHandler.php";

	set_error_handler('ErrorHandler::handleError');
	set_exception_handler('ErrorHandler::handleException');
	
	use Src\InvalidSignatureException;
	use Src\System\DatabaseConnector;
	
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	$dbConnection = (new DatabaseConnector())->getConnection();
