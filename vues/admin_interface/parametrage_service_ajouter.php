<?php 
	session_start();
	// CONNEXION A LA BASE DE DONNEES
	include('../../connexion/connexionBdd.php');
?>

<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Annuaire - Ajouter un service</title>

	<!-- BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link href="../outils/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/brands.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/solid.css" rel="stylesheet">
</head>

<body>

<?php
	$service_erreur = -1;
	
	$sqlLoca1 = "SELECT * 
				FROM annuaire_php_param_localisation
				WHERE id_Pbatiment='".$_POST['batiment1']."'
				AND id_Pporte='".$_POST['porte1']."'
				AND id_Petage='".$_POST['etage1']."'";
	$queryLoca1 = $connectBdd->prepare($sqlLoca1);
	$queryLoca1->execute();
	$resultLoca1 = ($queryLoca1->rowCount() === 0) ? 0 : $queryLoca1->fetchAll();
	
	// SI LA LOCALISATION N'EXISTE PAS 
	// ON L'INSERE DANS LA BASE DE DONNEES
	if ($queryLoca1->rowCount() == 0) {
		$sqlLoca2 = "INSERT INTO annuaire_php_param_localisation
					VALUES('', '".$_POST['batiment1']."', '".$_POST['etage1']."', '".$_POST['porte1']."', '1', '".date("Y-m-d H:i:s")."', '', '".$_SESSION['ANNUAIRE_ADMIN_aph']."', '' )";
		$queryLoca2 = $connectBdd->prepare($sqlLoca2);
		$queryLoca2->execute();
		$resultLoca2 = ($queryLoca2->rowCount() === 0) ? 0 : $queryLoca2->fetchAll();
		
		$id_localisation = $resultLoca2[0];
		echo "<font color=\"red\">La localisation a été créée.</font><br><br>";
	} else
		$id_localisation = $resultLoca1[0]['id_Plocalisation'];
	
	// SI LE FORMULAIRE EST REMPLI
	if ((!empty($_POST['numero1'])) AND (!empty($_POST['libelle1'])) 
									AND (!empty($_POST['responsable1'])) 
									AND (!empty($_POST['pole1'])) 
									AND (!empty($_POST['batiment1']))
									AND (!empty($_POST['etage1']))
									AND (!empty($_POST['porte1']))
									) {	
		// ON CHERCHE LES SAISIES DANS LA BASE DE DONNEES
		$sql2 = "SELECT * FROM annuaire_php_param_service WHERE id_Pservice='".$_POST['libelle1']."'";
		$query2 = $connectBdd->prepare($sql2);
		$query2->execute();

		// SI LE CHAMP 'LIBELLE1' EXISTE 
		if ($query2->rowCount() >= 1)
			$service_erreur = 2;

		// SINON ON INSERE DANS LA BASE DE DONNEES 
		else {
			$sqlPole = "SELECT * FROM annuaire_php_param_pole WHERE id_Ppole='".$_POST['pole1']."'";
			$queryPole = $connectBdd->prepare($sqlPole);
			$queryPole->execute();
			$resultPole = ($queryPole->rowCount() === 0) ? 0 : $queryPole->fetchAll();
			
			$sql1 = "INSERT INTO annuaire_php_param_service
					VALUES('', '".$_POST['numero1']."', '".$_POST['libelle1']."', '".$_POST['responsable1']."', '".$id_localisation."', '".$resultPole[0]['id_Ppole']."', '".$_POST['synonyme1']."', '1', '".$_SESSION['ANNUAIRE_ADMIN_aph']."', '', '".date("Y-m-d H:i:s")."', '' )";
			$query1 = $connectBdd->prepare($sql1);
			$query1->execute();

			$service_erreur = 1;
		}
	} else
		$service_erreur = 3;
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if ($service_erreur == 1)
		echo "<font color=\"red\">Le service a bien été ajouté.</font>";
	if ($service_erreur == 2)
		echo "<font color=\"red\">Le service existe déjà.</font>";
	if ($service_erreur == 3)
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font>";

	echo "<br><br><a href=\"../admin_accueil.php\">Retour</a>";	
?>

</body>

</html>