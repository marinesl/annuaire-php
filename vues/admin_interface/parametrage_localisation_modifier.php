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
	<title>Annuaire - Modifier une localisation</title>

	<!-- BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link href="../outils/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/brands.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/solid.css" rel="stylesheet">
</head>

<body>

<?php 
	// INITIALISATION DE LA VARIABLE D'ERREUR
	$erreur_localisation = -1;
	
	$sql2 =  "SELECT * 
				FROM annuaire_php_param_localisation,annuaire_php_param_batiment,annuaire_php_param_etage,annuaire_php_param_porte
				WHERE annuaire_php_param_localisation.id_Pbatiment=annuaire_php_param_batiment.id_Pbatiment
				AND annuaire_php_param_localisation.id_Petage=annuaire_php_param_etage.id_Petage
				AND annuaire_php_param_localisation.id_Pporte=annuaire_php_param_porte.id_Pporte
				AND id_Plocalisation=".$_POST['id'];
	$query2 = $connectBdd->prepare($sql2);
	$query2->execute();
	$result2 = ($query2->rowCount() === 0) ? 0 : $query2->fetchAll();

	// SI LES CHAMPS DE SAISIE SONT VIDES
	if ((empty($_POST['batiment3'])) AND (empty($_POST['etage3'])) AND (empty($_POST['porte3'])) AND ($_POST['actif'] == $result2[0]['actif_loca']))
		$erreur_localisation = 2;

	// SINON ON MODIFIE LES DONNEES 
	else {
		$sql = "SELECT * FROM annuaire_php_param_batiment,annuaire_php_param_etage,annuaire_php_param_porte WHERE 1";
		
		// SI LE CHAMP 'BATIMENT' EST REMPLI
		if (!empty($_POST['batiment3']))
			$sql .= " AND lib_bat='".$_POST['batiment3']."'"; 
		
		// SI LE CHAMP 'ETAGE' EST REMPLI
		if (!empty($_POST['etage3']))
			$sql .= " AND lib_eta='".$_POST['etage3']."'";
		
		// SI LE CHAMP 'PORTE' EST REMPLI
		if (!empty($_POST['porte3']))
			$sql .= " AND lib_porte='".$_POST['porte3']."'";
		
		$query3 = $connectBdd->prepare($sql3);
		$query3->execute();
		$result3 = ($query3->rowCount() === 0) ? 0 : $query3->fetchAll();
		
		$sql1 = "UPDATE annuaire_php_param_localisation 
				SET id_Pbatiment='".$result3[0]['id_Pbatiment']."',
				id_Petage='".$result3[0]['id_Petage']."',
				id_Pporte='".$result3[0]['id_Pporte']."',
				actif_loca='".$_POST['actif']."',
				modificateur_loca='".$_SESSION['ANNUAIRE_ADMIN_aph']."',
				date_modif_loca='".date("Y-m-d H:i:s")."'
				WHERE id_Plocalisation=".$_POST['id'];
		$query1 = $connectBdd->prepare($sql1);
		$query1->execute();

		$erreur_localisation = 1;
	}
	
	// ON AFFICHE UN MESSAGE D'ERREUR
	if ($erreur_localisation == 2)
		echo "<font color=\"red\">Aucune modification n'a été apportée</font><br><br>";
	if ($erreur_localisation == 1)
		echo "<font color =\"red\">Modification réussie</font><br><br>";

	echo "<a href=\"../admin_accueil.php\">Retour</a>";
?>

</body>

</html>