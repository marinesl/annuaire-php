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
	$erreur_localisation = -1;
	
	$query2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_localisation,annuaire_param_batiment,annuaire_param_etage,annuaire_param_porte
													WHERE annuaire_param_localisation.id_Pbatiment=annuaire_param_batiment.id_Pbatiment
													AND annuaire_param_localisation.id_Petage=annuaire_param_etage.id_Petage
													AND annuaire_param_localisation.id_Pporte=annuaire_param_porte.id_Pporte
													AND id_Plocalisation=".$_POST['id']."");
	$result2 = mysqli_fetch_assoc($query2);

	// SI LES CHAMPS DE SAISIE SONT VIDES
	if((empty($_POST['batiment3'])) AND (empty($_POST['etage3'])) AND (empty($_POST['porte3'])) AND ($_POST['actif'] == $result2['actif_loca']))
	{
		$erreur_localisation = 2;
	}
	// SINON ON MODIFIE LES DONNEES 
	else
	{
		$sql = "SELECT * FROM annuaire_param_batiment,annuaire_param_etage,annuaire_param_porte WHERE 1";
		
		// SI LE CHAMP 'BATIMENT' EST REMPLI
		if(!empty($_POST['batiment3']))
		{ 
			$sql .= " AND lib_bat='".$_POST['batiment3']."'"; 
		}
		
		// SI LE CHAMP 'ETAGE' EST REMPLI
		if(!empty($_POST['etage3']))
		{
			$sql .= " AND lib_eta='".$_POST['etage3']."'";
		}
		
		// SI LE CHAMP 'PORTE' EST REMPLI
		if(!empty($_POST['porte3']))
		{
			$sql .= " AND lib_porte='".$_POST['porte3']."'";
		}												
		
		$query3 = mysqli_query($connectBdd, $sql);
		
		$result3 = mysqli_fetch_assoc($query3);
		
		$query1 = mysqli_query($connectBdd , "UPDATE annuaire_param_localisation 
												SET id_Pbatiment='".$result3['id_Pbatiment']."',
												id_Petage='".$result3['id_Petage']."',
												id_Pporte='".$result3['id_Pporte']."',
												actif_loca='".$_POST['actif']."',
												modificateur_loca='".$_SESSION['ANNUAIRE_ADMIN_aph']."',
												date_modif_loca='".date("Y-m-d H:i:s")."'
												WHERE id_Plocalisation=".$_POST['id']."
												");

		$erreur_localisation = 1;
	}
	
	// ON AFFICHE UN MESSAGE D'ERREUR
	if($erreur_localisation == 2)
	{
		echo "<font color=\"red\">Aucune modification n'a été apportée</font><br><br>";
	}
	if($erreur_localisation == 1)
	{
		echo "<font color =\"red\">Modification réussie</font><br><br>";
	}

	echo "<a href=\"../admin_accueil.php\">Retour</a>";
?>

</body>

</html>