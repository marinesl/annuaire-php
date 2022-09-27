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
	<title>Annuaire - Modifier un UA</title>

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
	$erreur_ua = -1;
	
	$sql2 = "SELECT * FROM annuaire_php_param_ua WHERE id_Pua=".$_POST['id'];
	$query2 = $connectBdd->prepare($sql2);
	$query2->execute();
	$result2 = ($query2->rowCount() === 0) ? 0 : $query2->fetchAll();

	// SI LES CHAMPS DE SAISIE SONT TOUJOURS IDENTIQUES AUX DONNEES
	if ($_POST['libelle2'] == $result2[0]['lib_ua'] AND $_POST['actif'] == $result2[0]['actif_bat'] 
			AND $_POST['numero2'] == $result2[0]['num_ua'] AND $_POST['ug2'] == $result2[0]['id_Pug'])
		$erreur_ua = 2;
	
	// SINON ON MODIFIE LES DONNEES 
	else {
		$sql1 = "UPDATE annuaire_php_param_ua 
				SET lib_ua='".$_POST['libelle2']."',
				num_ua='".$_POST['numero2']."',
				id_Pug='".$_POST['ug2']."',
				actif_ua='".$_POST['actif']."',
				modificateur_ua='".$_SESSION['ANNUAIRE_ADMIN_aph']."',
				date_modif_ua='".date("Y-m-d H:i:s")."'
				WHERE id_Pua=".$_POST['id'];
		$query1 = $connectBdd->prepare($sql1);
		$query1->execute();

		$erreur_ua = 1;
	}
	
	// ON AFFICHE UN MESSAGE D'ERREUR
	if ($erreur_ua == 2)
		echo "<font color=\"red\">Aucune modification n'a été apportée</font><br><br>";
	if ($erreur_ua == 1)
		echo "<font color =\"red\">Modification réussie</font><br><br>";

	echo "<a href=\"../admin_accueil.php\">Retour</a>";
?>

</body>

</html>