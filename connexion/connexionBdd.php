<?php
	// CONNEXION A LA BASE DE DONNEES
	$host = "localhost";
	$user = "root";
	$password = "";
	$bdd = "annuaire";
	
	$connectBdd = mysqli_connect($host,$user,$password,$bdd);

	mysqli_query($connectBdd,"SET NAMES utf8") ;
?>

