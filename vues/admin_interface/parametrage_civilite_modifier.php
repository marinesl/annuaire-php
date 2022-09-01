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
	$erreur_civilite = -1;
	
	$query2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_civilite WHERE id_Pcivilite=".$_POST['id']."");
	$result2 = mysqli_fetch_assoc($query2);

	// SI LES CHAMPS DE SAISIE SONT TOUJOURS IDENTIQUES AUX DONNEES
	if(($_POST['libelle2'] == $result2['lib_civ']) AND ($_POST['actif'] == $result2['actif_civ']))
	{
		$erreur_civilite = 2;
	}
	// SINON ON MODIFIE LES DONNEES 
	else
	{
		$query1 = mysqli_query($connectBdd,"UPDATE annuaire_param_civilite 
												SET lib_civ='".$_POST['libelle2']."',
												actif_civ='".$_POST['actif']."',
												modificateur_civ='".$_SESSION['ANNUAIRE_ADMIN_aph']."',
												date_modif_civ='".date("Y-m-d H:i:s")."'
												WHERE id_Pcivilite=".$_POST['id']."
												");
		$erreur_civilite = 1;
	}
	
	// ON AFFICHE UN MESSAGE D'ERREUR
	if($erreur_civilite == 2)
	{
		echo "<font color=\"red\">Aucune modification n'a été apportée</font><br><br>";
	}
	if($erreur_civilite == 1)
	{
		echo "<font color =\"red\">Modification réussie</font><br><br>";
	}

	echo "<a href=\"../admin_accueil.php\">Retour</a>";
?>

</body>

</html>