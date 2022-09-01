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
	$service_erreur = -1;
	
	$queryLoca1 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_localisation
														WHERE id_Pbatiment='".$_POST['batiment1']."'
														AND id_Pporte='".$_POST['porte1']."'
														AND id_Petage='".$_POST['etage1']."'
														");
	$resultLoca1 = mysqli_fetch_assoc($queryLoca1);
	
	// SI LA LOCALISATION N'EXISTE PAS 
	// ON L'INSERE DANS LA BASE DE DONNEES
	if(mysqli_num_rows($queryLoca1) == 0)
	{
		$queryLoca2 = mysqli_query($connectBdd, "INSERT INTO annuaire_param_localisation
														VALUES('',
																'".$_POST['batiment1']."',
																'".$_POST['etage1']."',
																'".$_POST['porte1']."',
																'1',
																'".date("Y-m-d H:i:s")."',
																'',
																'".$_SESSION['ANNUAIRE_ADMIN_aph']."',
																''
																)");
		
		$id_localisation = mysqli_insert_id($connectBdd);
		echo "<font color=\"red\">La localisation a été créée.</font><br><br>";
	}
	else
	{
		$id_localisation = $resultLoca1['id_Plocalisation'];
	}
	
	// SI LE FORMULAIRE EST REMPLI
	if((!empty($_POST['numero1'])) AND (!empty($_POST['libelle1'])) 
									AND (!empty($_POST['responsable1'])) 
									AND (!empty($_POST['pole1'])) 
									AND (!empty($_POST['batiment1']))
									AND (!empty($_POST['etage1']))
									AND (!empty($_POST['porte1']))
									)
	{	
		// ON CHERCHE LES SAISIES DANS LA BASE DE DONNEES
		$query2 = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_service WHERE id_Pservice='".$_POST['libelle1']."'");
		$result2 = mysqli_fetch_assoc($query2);

		// SI LE CHAMP 'LIBELLE1' EXISTE 
		if(mysqli_num_rows($query2) >= 1)
		{
			$service_erreur = 2;
		}
		// SINON ON INSERE DANS LA BASE DE DONNEES 
		else 
		{
			$queryPole = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_pole WHERE id_Ppole='".$_POST['pole1']."'");
			$resultPole = mysqli_fetch_assoc($queryPole);
			
			$query1 = mysqli_query($connectBdd, "INSERT INTO annuaire_param_service
															VALUES('',
																	'".$_POST['numero1']."',
																	'".$_POST['libelle1']."',
																	'".$_POST['responsable1']."',
																	'".$id_localisation."',
																	'".$resultPole['id_Ppole']."',
																	'".$_POST['synonyme1']."',
																	'1',
																	'".$_SESSION['ANNUAIRE_ADMIN_aph']."',
																	'',
																	'".date("Y-m-d H:i:s")."',
																	''
																	)");
			$service_erreur = 1;
		}
	}
	else
	{
		$service_erreur = 3;
	}
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if($service_erreur == 1)
	{
		echo "<font color=\"red\">Le service a bien été ajouté.</font>";
	}
	if($service_erreur == 2)
	{
		echo "<font color=\"red\">Le service existe déjà.</font>";
	}
	if($service_erreur == 3)
	{
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font>";
	}

	echo "<br><br><a href=\"../admin_accueil.php\">Retour</a>";	
?>

</body>

</html>