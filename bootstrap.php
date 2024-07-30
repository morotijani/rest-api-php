<?php 

	require 'vendor/autoload.php';

	use Src\System\DatabaseConnector;
	
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	$dbConnection = (new DatabaseConnector())->getConnection();

	// read from or write to database
	function run($conn, $query, $var = [], $res = null) {
		$statement = $conn->prepare($query);
		if ($statement) {
			// code...
			$check = $statement->execute($var);

			if ($check) {
				$response = $check;
				$data = $statement->fetchAll(PDO::FETCH_OBJ); // fetch objects

				if ($res == 'count') {
					$response = $statement->rowCount();
				} else if ($res == 'lastinsertid') {
					$response = $conn->lastInserId();
				} else {
					if (is_array($data) && count($data) > 0) {
						$response = $data;
					}
				}
				
			}
			return $response;
		}

		return false;

	}
