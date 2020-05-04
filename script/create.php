<?php 
	//Receive parameters : host = argv[1] - dbname = argv[2], username = argv[3] & password = argv[4]
	/* Attempt MySQL server connection. Assuming you are running MySQL
	server with default setting (user 'root' with no password '') */
	try{
		$pdo = new PDO("mysql:host=$argv[1];dbname=$argv[2]", $argv[3], $argv[4]);
		// Set the PDO error mode to exception
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
		die("ERROR DATABASE : " . $e->getMessage());
	}
	// Create tables 
	try{
		$sql = "CREATE TABLE IF NOT EXISTS clients (
			id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			client VARCHAR(30) NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)";
		$pdo->exec($sql);
		echo "Table Clients created successfully. ";
		$sql = "CREATE TABLE IF NOT EXISTS deals (
			id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			deal VARCHAR(30) NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)";
		$pdo->exec($sql);
		echo "Table Deals created successfully. ";
		$sql = "CREATE TABLE IF NOT EXISTS transactions (
			id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			client_id INT(9) UNSIGNED NOT NULL,
			deal_id INT(9) UNSIGNED NOT NULL,
			accepted INT(9) UNSIGNED NOT NULL,
			refused INT(9) UNSIGNED NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			INDEX client_index (client_id),
			INDEX deal_index (deal_id),
			FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
			FOREIGN KEY (deal_id) REFERENCES deals(id) ON DELETE CASCADE
		)";
		$pdo->exec($sql);
		echo "Table Transactions created successfully. ";

	} catch(PDOException $e){
		die($e->getMessage());
	}



?>