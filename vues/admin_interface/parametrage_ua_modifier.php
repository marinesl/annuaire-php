<?php 
	session_start();
	// CONNEXION A LA BASE DE DONNEES
	include('../../connexion/connexionBdd.php');
?>

<!DOCTYPE html>

<head>
	<title>Annuaire - Hôpital Necker-Enfants Malades</title>
	<meta charset="utf-8"> 
	
	<!-- DECLARATION BOOTSTRAP -->
	<link href="../../outils/bootstrap/css/bootstrap.css" rel="stylesheet">
</head>

<body>

<?php 
	// INITIALISATION DE LA VARIABLE D'ERREUR
	$erreur_ua = -1;
	
	$query2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_ua WHERE id_Pua=".$_POST['id']."");
	$result2 = mysqli_fetch_assoc($query2);

	// SI LES CHAMPS DE SAISIE SONT TOUJOURS IDENTIQUES AUX DONNEES
	if($_POST['libelle2'] == $result2['lib_ua'] AND $_POST['actif'] == $result2['actif_bat'] AND $_POST['numero2'] == $result2['num_ua'] AND $_POST['ug2'] == $result2['id_Pug'])
	{
		$erreur_ua = 2;
	}
	// SINON ON MODIFIE LES DONNEES 
	else
	{
		$query1 = mysqli_query($connectBdd , "UPDATE annuaire_param_ua 
												SET lib_ua='".$_POST['libelle2']."',
												num_ua='".$_POST['numero2']."',
												id_Pug='".$_POST['ug2']."',
												actif_ua='".$_POST['actif']."',
												modificateur_ua='".$_SESSION['ANNUAIRE_ADMIN_aph']."',
												date_modif_ua='".date("Y-m-d H:i:s")."'
												WHERE id_Pua=".$_POST['id']."
												");
		$erreur_ua = 1;
	}
	
	// ON AFFICHE UN MESSAGE D'ERREUR
	if($erreur_ua == 2)
	{
		echo "<font color=\"red\">Aucune modification n'a été apportée</font><br><br>";
	}
	if($erreur_ua == 1)
	{
		echo "<font color =\"red\">Modification réussie</font><br><br>";
	}

	echo "<a href=\"../admin_accueil.php\">Retour</a>";
?>

</body>

</html>