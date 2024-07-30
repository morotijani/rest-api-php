<?php 

	require 'vendor/autoload.php';

	use Src\System\DatabaseConnector;
	
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	$dbConnection = (new DatabaseConnector())->getConnection();

	// read from or write to database
	function run($conn, $query, $var = []) {
		//$conn = $dbConnection;
		$statement = $conn->prepare($query);
		if ($statement) {
			// code...
			$check = $statement->execute($var);

			if ($check) {
				// code...
				$data = $statement->fetchAll(PDO::FETCH_OBJ); // fetch objects
				if (is_array($data) && count($data) > 0) {
					// code...
					return $data;
				}
				return $check;
			}
		}

		return false;

	}

	function dnd($data) {
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	    die;
	}
	