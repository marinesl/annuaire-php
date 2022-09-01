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
	$erreur_pole = -1;
	
	$query2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_pole WHERE id_Ppole=".$_POST['id']."");
	$result2 = mysqli_fetch_assoc($query2);

	// SI LES CHAMPS DE SAISIE SONT TOUJOURS IDENTIQUES AUX DONNEES
	if(($_POST['numero2'] == $result2['num_pole']) AND ($_POST['libelle2'] == $result2['lib_pole']) AND ($_POST['actif'] == $result2['actif_pole']))
	{
		$erreur_pole = 2;
	}
	// SINON ON MODIFIE LES DONNEES 
	else
	{
		$query1 = mysqli_query($connectBdd , "UPDATE annuaire_param_pole
												SET lib_pole='".$_POST['libelle2']."',
												num_pole='".$_POST['numero2']."',
												actif_pole='".$_POST['actif']."',
												modificateur_pole='".$_SESSION['ANNUAIRE_ADMIN_aph']."',
												date_modif_pole='".date("Y-m-d H:i:s")."'
												WHERE id_Ppole=".$_POST['id']."
												");
		$erreur_pole = 1;
	}
	
	// ON AFFICHE UN MESSAGE D'ERREUR
	if($erreur_pole == 2)
	{
		echo "<font color=\"red\">Aucune modification n'a été apportée</font><br><br>";
	}
	if($erreur_pole == 1)
	{
		echo "<font color =\"red\">Modification réussie</font><br><br>";
	}

	echo "<a href=\"../admin_accueil.php\">Retour</a>";
?>

</body>

</html>