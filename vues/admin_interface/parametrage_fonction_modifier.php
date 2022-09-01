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
	$erreur_fonction = -1;
	
	$query2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_fonction WHERE id_Pfonction=".$_POST['id']."");
	$result2 = mysqli_fetch_assoc($query2);

	// SI LES CHAMPS DE SAISIE SONT TOUJOURS IDENTIQUES AUX DONNEES
	if(($_POST['libelle2'] == $result2['lib_fonc']) AND ($_POST['actif'] == $result2['actif_fonc']) AND ($_POST['ordre2'] == $result2['ordre_fonc']))
	{
		$erreur_fonction = 2;
	}
	// SINON ON MODIFIE LES DONNEES 
	else
	{
		$query1 = mysqli_query($connectBdd,"UPDATE annuaire_param_fonction
												SET lib_fonc='".$_POST['libelle2']."',
												actif_fonc='".$_POST['actif']."',
												modificateur_fonc='".$_SESSION['ANNUAIRE_ADMIN_aph']."',
												date_modif_fonc='".date("Y-m-d H:i:s")."'
												WHERE id_Pfonction=".$_POST['id']."
												");
		$erreur_fonction = 1;
	}
	
	// ON AFFICHE UN MESSAGE D'ERREUR
	if($erreur_fonction == 2)
	{
		echo "<font color=\"red\">Aucune modification n'a été apportée</font><br><br>";
	}
	if($erreur_fonction == 1)
	{
		echo "<font color =\"red\">Modification réussie</font><br><br>";
	}

	echo "<a href=\"../admin_accueil.php\">Retour</a>";
?>

</body>

</html>