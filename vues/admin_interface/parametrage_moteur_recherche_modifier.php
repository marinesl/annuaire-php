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
	$erreur_moteur = -1;
	
	if(empty($_POST['abonne3']))
	{
		$abonne2 = explode("_",$_POST['abonne2']);
	} 
	else
	{
		$abonne2 = explode("_",$_POST['abonne3']);
	}
	
	$query2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_moteur_recherche,annuaire_exploit_abonne
													WHERE annuaire_param_moteur_recherche.id_Eabonne=annuaire_exploit_abonne.id_Eabonne
													AND id_Pmoteur_rch=".$_POST['id']."
													");
	$result2 = mysqli_fetch_assoc($query2);

	// SI LES CHAMPS DE SAISIE SONT TOUJOURS IDENTIQUES AUX DONNEES
	if((empty($_POST['abonne3'])) AND ($_POST['info2'] == $result2['info_integrale']))
	{
		$erreur_moteur = 2;
	}
	// SINON ON MODIFIE LES DONNEES 
	else
	{
		$query3 = mysqli_query($connectBdd, "SELECT * FROM annuaire_exploit_abonne
												WHERE nom_ab='".$abonne2[0]."'
												AND prenom_personne='".$abonne2[1]."'
												");
		$result3 = mysqli_fetch_assoc($query3);
		
		$query1 = mysqli_query($connectBdd , "UPDATE annuaire_param_moteur_recherche 
												SET id_Eabonne='".$result3['id_Eabonne']."',
												info_integrale='".$_POST['info2']."'
												WHERE id_Pmoteur_rch=".$_POST['id']."
												");
		$erreur_moteur = 1;
	}
	
	// ON AFFICHE UN MESSAGE D'ERREUR
	if($erreur_moteur == 2)
	{
		echo "<font color=\"red\">Aucune modification n'a été apportée</font><br><br>";
	}
	if($erreur_moteur == 1)
	{
		echo "<font color =\"red\">Modification réussie</font><br><br>";
	}

	echo "<a href=\"../admin_accueil.php\">Retour</a>";
?>

</body>

</html>