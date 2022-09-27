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
	<title>Annuaire - Ajouter une localisation</title>

	<!-- BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link href="../outils/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/brands.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/solid.css" rel="stylesheet">
</head>

<body>

<?php
	$localisation_erreur = -1;
	
	// SI LE FORMULAIRE EST REMPLI
	if ((!empty($_POST['batiment1'])) AND !empty($_POST['etage1']) AND !empty($_POST['porte1'])) {	
		// ON CHERCHE LES SAISIES DANS LA BASE DE DONNEES
		$sql2 = "SELECT * 
				FROM annuaire_php_param_localisation,annuaire_php_param_batiment,annuaire_php_param_etage,annuaire_php_param_porte
				WHERE annuaire_php_param_localisation.id_Pbatiment=annuaire_php_param_batiment.id_Pbatiment
				AND annuaire_php_param_localisation.id_Petage=annuaire_php_param_etage.id_Petage
				AND annuaire_php_param_localisation.id_Pporte=annuaire_php_param_porte.id_Pporte
				AND lib_bat='".$_POST['batiment1']."'
				AND lib_eta='".$_POST['etage1']."'
				AND lib_porte='".$_POST['porte1']."'";
		$query2 = $connectBdd->prepare($sql2);
		$query2->execute();

		// SI LES CHAMPS EXISTENT 
		if ($query2->rowCount() >= 1)
			$localisation_erreur = 2;

		// ON INSERE DANS LA BASE DE DONNEES 
		else {
			$sql3 = "SELECT * 
					FROM annuaire_php_param_batiment,annuaire_php_param_etage,annuaire_php_param_porte
					WHERE lib_bat='".$_POST['batiment1']."'
					AND lib_eta='".$_POST['etage1']."'
					AND lib_porte='".$_POST['porte1']."'";
			$query3 = $connectBdd->prepare($sql3);
			$query3->execute();
			$result3 = ($query3->rowCount() === 0) ? 0 : $query3->fetchAll();

			$sql1 = "INSERT INTO annuaire_php_param_localisation
					VALUES('', '".$result3[0]['id_Pbatiment']."', '".$result3[0]['id_Petage']."', '".$result3[0]['id_Pporte']."', '1', '".$_SESSION['ANNUAIRE_ADMIN_aph']."', '', '".date("Y-m-d H:i:s")."', '' )";
			$query1 = $connectBdd->prepare($sql1);
			$query1->execute();

			$localisation_erreur = 1;
		}
	} else
		$localisation_erreur = 3;
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if ($localisation_erreur == 1)
		echo "<font color=\"red\">La localisation a bien été ajoutée.</font>";
	if ($localisation_erreur == 2)
		echo "<font color=\"red\">La localisation existe déjà.</font>";
	if ($localisation_erreur == 3)
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font>";

	echo "<br><br><a href=\"../admin_accueil.php\">Retour</a>";	
?>

</body>

</html>