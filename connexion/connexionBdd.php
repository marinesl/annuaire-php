<?php
	require __DIR__.'/../.env.php';

	// CONNEXION A LA BASE DE DONNEES
	$host = BDD_HOST;
	$port = BDD_PORT;
	$username = BDD_USER;
	$password = BDD_PASSWORD;
	$dbname = BDD_NAME;
	
	$dsn = "mysql:$host;port=$port;dbname=$dbname";

	try {
		$connectBdd = new PDO($dsn, $username, $password);
		$connectBdd->exec("set character set utf8");
	} catch (PDOException $e) {
		die("Erreur! :" . $e->getMessage());
	}
?>

