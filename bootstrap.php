<?php 

	require 'vendor/autoload.php';
	
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	// test code, should output:
	// api://default
	// when you run $ php bootstrap.php
	echo $_ENV['OKTAAUDIENCE'];