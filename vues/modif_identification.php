<?php

	// CONNEXION MODIFICATION
	
	// CE SCRIPT RENVOIE UNE VARIABLE $_SESSION['ANNUAIRE_MODIF_identification'] EGALE A 1
	// QUI VALIDE L'IDENTIFICATION AINSI QUE SON GROUPE DANS UN ACTIVE DIRECTORY (AD)
	// IL FAUT AFFICHER SI ET SEULEMENT SI $_SESSION['ANNUAIRE_MODIF_identification'] == 1
	
	include('../connexion/connexionBdd.php');

	session_start();
	
	// INITIALISATION DES VARIABLES
	$_SESSION['ANNUAIRE_MODIF_user'];
	$_SESSION['ANNUAIRE_MODIF_pass'];
	$_SESSION['ANNUAIRE_MODIF_identification'] = -1 ;
	
	// SI LA FORMULAIRE EST REMPLI
	if (isset($_POST['user']) && isset($_POST['motdepasse']) && $_POST['user'] != '' && $_POST['motdepasse'] != '') {

		$_SESSION['ANNUAIRE_MODIF_user'] = $_POST['user'];
		$_SESSION['ANNUAIRE_MODIF_pass'] = $_POST['motdepasse'];

		// ON TESTE SI LA PERSONNE EXISTE DANS LA TABLE ANNUAIRE_ADMIN_USER
		$query2 = "SELECT * FROM annuaire_php_admin_user WHERE aph_user='".$_POST['user']."'";
		$result2 = $connectBdd->prepare($query2);
		$result2->execute();
					
		// SI LA PERSONNE EXISTE DANS LA TABLE ANNUAIRE_ADMIN_USER
		// ON FAIT UN UPDATE
		if ($result2->rowCount() == 1)
			$_SESSION['ANNUAIRE_MODIF_identification'] = 1;
		else
			$_SESSION['ANNUAIRE_MODIF_identification'] = 2;
	}


	if ($_SESSION['ANNUAIRE_MODIF_identification'] == 1) {
		
		//ON INSERE LES INFORMATIONS DANS LA TABLE ANNUAIRE_ADMIN_LOGCX
		$query5 = "INSERT INTO annuaire_php_admin_logCx
					VALUES('', 'OK', 'Connexion utilisateur : ".$_POST['user']."', '".date("Y-m-d H:i:s")."' )";

		$result5 = $connectBdd->prepare($query5);
		$result5->execute();
		
		// AFFICHER LE CONTENU DE LA PAGE CI-DESSOUS AINSI QUE L'ENSEMBLE DU SITE
		// SI ET SEULEMENT SI $_SESSION['ANNUAIRE_MODIF_identification'] = 1
		$_SESSION['ANNUAIRE_MODIF_identification'] = $_POST['user'];
		
		header('location:modif_accueil.php');

	} else if ($_SESSION['ANNUAIRE_MODIF_identification'] == 2) {
		
		// ON INSERE LES INFORMATIONS DANS LA TABLE ANNUAIRE_ADMIN_LOGCX
		$query5 = "INSERT INTO annuaire_php_admin_logCx
					VALUES('', 'KO', 'Echec connexion utilisateur : ".$_POST['user']."', '".date("Y-m-d H:i:s")."' )";
									
		$result5 = $connectBdd->prepare($query5);
		$result5->execute();
	} else
		include('modif_connexion.php');
?>