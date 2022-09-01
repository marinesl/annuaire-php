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
	$localisation_erreur = -1;
	
	// SI LE FORMULAIRE EST REMPLI
	if((!empty($_POST['batiment1'])) AND !empty($_POST['etage1']) AND !empty($_POST['porte1']))
	{	
		// ON CHERCHE LES SAISIES DANS LA BASE DE DONNEES
		$query2 = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_localisation,annuaire_param_batiment,annuaire_param_etage,annuaire_param_porte
														WHERE annuaire_param_localisation.id_Pbatiment=annuaire_param_batiment.id_Pbatiment
														AND annuaire_param_localisation.id_Petage=annuaire_param_etage.id_Petage
														AND annuaire_param_localisation.id_Pporte=annuaire_param_porte.id_Pporte
														AND lib_bat='".$_POST['batiment1']."'
														AND lib_eta='".$_POST['etage1']."'
														AND lib_porte='".$_POST['porte1']."'
														");
		$result2 = mysqli_fetch_assoc($query2);

		// SI LES CHAMPS EXISTENT 
		if(mysqli_num_rows($query2) >= 1)
		{
			$localisation_erreur = 2;
		}
		// ON INSERE DANS LA BASE DE DONNEES 
		else 
		{
			$query3 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_batiment,annuaire_param_etage,annuaire_param_porte
															WHERE lib_bat='".$_POST['batiment1']."'
															AND lib_eta='".$_POST['etage1']."'
															AND lib_porte='".$_POST['porte1']."'
															");
			$result3 = mysqli_fetch_assoc($query3);
			
			$query1 = mysqli_query($connectBdd, "INSERT INTO annuaire_param_localisation
															VALUES('',
																	'".$result3['id_Pbatiment']."',
																	'".$result3['id_Petage']."',
																	'".$result3['id_Pporte']."',
																	'1',
																	'".$_SESSION['ANNUAIRE_ADMIN_aph']."',
																	'',
																	'".date("Y-m-d H:i:s")."',
																	''
																	)");
			$result1 = mysqli_fetch_assoc($query1);
			$localisation_erreur = 1;
		}
	}
	else
	{
		$localisation_erreur = 3;
	}
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if($localisation_erreur == 1)
	{
		echo "<font color=\"red\">La localisation a bien été ajoutée.</font>";
	}
	if($localisation_erreur == 2)
	{
		echo "<font color=\"red\">La localisation existe déjà.</font>";
	}
	if($localisation_erreur == 3)
	{
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font>";
	}

	echo "<br><br><a href=\"../admin_accueil.php\">Retour</a>";	
?>

</body>

</html>