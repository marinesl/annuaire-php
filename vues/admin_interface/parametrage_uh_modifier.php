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
	$erreur_uh = -1;
	
	$query2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_uh WHERE id_Puh=".$_POST['id']."");
	$result2 = mysqli_fetch_assoc($query2);

	// SI LES CHAMPS DE SAISIE SONT TOUJOURS IDENTIQUES AUX DONNEES
	if(($_POST['libelle2'] == $result2['lib_uh']) AND ($_POST['actif'] == $result2['actif_uh']) AND ($_POST['numero2'] == $result2['num_ua']) AND ($_POST['ua2'] == $result2['id_Pua']))
	{
		$erreur_uh = 2;
	}
	// SINON ON MODIFIE LES DONNEES 
	else
	{
		$query1 = mysqli_query($connectBdd , "UPDATE annuaire_param_uh
												SET lib_uh='".$_POST['libelle2']."',
												num_uh='".$_POST['numero2']."',
												id_Pua='".$_POST['ua2']."',
												actif_uh='".$_POST['actif']."',
												modificateur_uh='".$_SESSION['ANNUAIRE_ADMIN_aph']."',
												date_modif_uh='".date("Y-m-d H:i:s")."'
												WHERE id_Puh=".$_POST['id']."
												");
		$erreur_uh = 1;
	}
	
	// ON AFFICHE UN MESSAGE D'ERREUR
	if($erreur_uh == 2)
	{
		echo "<font color=\"red\">Aucune modification n'a été apportée</font><br><br>";
	}
	if($erreur_uh == 1)
	{
		echo "<font color =\"red\">Modification réussie</font><br><br>";
	}

	echo "<a href=\"../admin_accueil.php\">Retour</a>";
?>

</body>

</html>