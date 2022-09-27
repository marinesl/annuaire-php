<?php 
	// CONNEXION ADMINISTRATEUR
	
	// CE SCRIPT RENVOIE UNE VARIABLE $_SESSION['ANNUAIRE_ADMIN_identification'] EGALE A 1 
	// QUI VALIDE L'IDENTIFICATION DE L'UTILISATEUR AINSI QUE SON GROUPE DANS UN ACTIVE DIRECTORY (AD)
	// IL FAUT AFFICHER LE CONTENU DE LA PAGE SI ET SEULEMENT SI $_SESSION['ANNUAIRE_ADMIN_identification'] == 1

	include('../connexion/connexionBdd.php');
	
	session_start();

	// INITIALISATION DES VARIABLES
	$_SESSION['ANNUAIRE_ADMIN_user'] = '';
	$_SESSION['ANNUAIRE_ADMIN_pass'] = '';
	$_SESSION['ANNUAIRE_ADMIN_identification'] = -1 ;
	$_SESSION['ANNUAIRE_ADMIN_admin'] = "KO" ;

	// SI LE FORMULAIRE EST REMPLI
	if (isset($_POST['user']) && isset($_POST['motdepasse']) && $_POST['user'] != '' && $_POST['motdepasse'] != '') {  
		$_SESSION['ANNUAIRE_ADMIN_user'] = $_POST['user'];
		$_SESSION['ANNUAIRE_ADMIN_pass'] = $_POST['motdepasse'];

		// ON RECHERCHE SI LA PERSONNE EXISTE DANS LA BASE DE DONNEES
		$query1 = "SELECT * FROM annuaire_php_admin_user WHERE aph_user='".$_POST['user']."' AND password_user='".md5($_POST['motdepasse'])."'" ;
		$result1 = $connectBdd->prepare($query1);
		$result1->execute();
		$ligne1 = ($result1->rowCount() === 0) ? 0 : $result1->fetchAll();

		// SI LA PERSONNE EXISTE 
		if ($result1->rowCount() == 1) {

			$_SESSION['ANNUAIRE_ADMIN_admin'] = "OK";
			$_SESSION['ANNUAIRE_ADMIN_identification'] = 1;
						
		// SI LA PERSONNE N'EXISTE PAS
		} else 
			$_SESSION['ANNUAIRE_ADMIN_identification'] = 2;
				
				
	} 	// .if (isset($_POST['user']) && isset($_POST['motdepasse']) && $_POST['user'] != '' && $_POST['motdepasse'] != '')

	// SI LA CONNEXION A FONCTIONNE
	if ($_SESSION['ANNUAIRE_ADMIN_identification'] == 1) {
		
		// INSERTION DES INFORMATIONS DANS LA TABLE ANNUAIRE_ADMIN_LOGCX
		$query3 = "INSERT INTO annuaire_php_admin_logCx
					VALUES('', 'OK', 'Connexion utilisateur : ".$_POST['user']."', '".date("Y-m-d H:i:s")."' )";
									
		$result3 = $connectBdd->prepare($query3);
		$result3->execute();
		
		// AFFICHER LE CONTENU DE LA PAGE CI-DESSOUS AINSI QUE L'ENSEMBLE DU SITE
		// SI ET SEULEMENT SI $_SESSION['ANNUAIRE_ADMIN_identification'] == 1
		$_SESSION['ANNUAIRE_ADMIN_aph'] = $_POST['user'];
		
		header('location:admin_accueil.php');
	} else {
		// S'IL Y A EU DES ERREURS
		if ($_SESSION['ANNUAIRE_ADMIN_identification'] == 2) {
			
			// INSERTION DES INFORMATIONS DANS LA TABLE ANNUAIRE_ADMIN_LOGCX
			$query3 = "INSERT INTO annuaire_php_admin_logCx
						VALUES('', 'KO', 'Echec connexion utilisateur : ".$_POST['user']."', '".date("Y-m-d H:i:s")."' )";
										
			$result3 = $connectBdd->prepare($query3);
			$result3->execute();
		}
		
		include('admin_connexion.php');
	}
?>