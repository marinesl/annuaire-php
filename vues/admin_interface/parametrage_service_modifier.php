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
	$erreur_service = -1;
	
	$query2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_service WHERE id_Pservice=".$_POST['id']."");
	$result2 = mysqli_fetch_assoc($query2);
	
	// SI LES CHAMPS DE SAISIE SONT TOUJOURS IDENTIQUES AUX DONNEES
	if(($_POST['libelle2'] == $result2['lib_ser']) AND ($_POST['numero2'] == $result2['num_ser'])
													AND (empty($_POST['responsable3']))
													AND ($_POST['synonyme2'] == $result2['synonyme_ser'])
													AND (empty($_POST['pole3']))
													AND (empty($_POST['batiment3']))
													AND (empty($_POST['porte3']))
													AND (empty($_POST['etage3']))
													AND ($_POST['actif'] == $result2['actif_bat'])
													)
	{
		$erreur_service = 2;
	}
	// SINON ON MODIFIE LES DONNEES 
	else
	{ 
		$sql = "SELECT * FROM annuaire_param_localisation,annuaire_param_batiment,annuaire_param_porte,annuaire_param_etage 
							WHERE annuaire_param_localisation.id_Pbatiment=annuaire_param_batiment.id_Pbatiment
							AND annuaire_param_localisation.id_Pporte=annuaire_param_porte.id_Pporte
							AND annuaire_param_localisation.id_Petage=annuaire_param_etage.id_Petage
							";
		
		// SI LE CHAMP 'BATIMENT' EST REMPLI
		if(!empty($_POST['batiment3'])) 
		{
			$sql .= " AND annuaire_param_batiment.id_Pbatiment='".$_POST['batiment3']."'";
			$batiment = $_POST['batiment3'];
		}
		else
		{
			$sql .= " AND annuaire_param_batiment.id_Pbatiment='".$_POST['batiment2']."'";
			$batiment = $_POST['batiment2'];
		}
		
		// SI LE CHAMP 'PORTE' EST REMPLI
		if(!empty($_POST['porte3']))
		{
			$sql .= " AND annuaire_param_porte.id_Pporte='".$_POST['porte3']."'";
			$porte = $_POST['porte3'];
		}
		else
		{
			$sql .= " AND annuaire_param_porte.id_Pporte='".$_POST['porte2']."'";
			$porte = $_POST['porte2'];
		}
		
		// SI LE CHAMP 'ETAGE' EST REMPLI
		if(!empty($_POST['etage3']))
		{
			$sql .= " AND annuaire_param_etage.id_Petage='".$_POST['etage3']."'";
			$etage = $_POST['etage3'];
		}
		else
		{
			$sql .= " AND annuaire_param_etage.id_Petage='".$_POST['etage2']."'";
			$etage = $_POST['etage2'];
		}
		
		$queryLoca = mysqli_query($connectBdd,$sql);
		$resultLoca = mysqli_fetch_assoc($queryLoca);
		$localisation = $resultLoca['id_Plocalisation'];
		
		if(mysqli_num_rows($queryLoca) == 0)
		{
			$queryLoca2 = mysqli_query($connectBdd, "INSERT INTO annuaire_param_localisation
															VALUES('',
																	'".$batiment."',
																	'".$etage."',
																	'".$porte."',
																	'1',
																	'".$_SESSION['ANNUAIRE_ADMIN_aph']."',
																	'',
																	'".date("Y-m-d H:i:s")."',
																	''
																	)");
			$localisation = mysqli_insert_id($connectBdd);
			echo "<font color=\"red\">La nouvelle localisation a été ajoutée.</font>";
		}
		
		$responsable = $result2['responsable_ser'];
		
		// LE CHAMP 'RESPONSABLE' EST REMPLI
		if(!empty($_POST['responsable3']))
		{
			$queryResp = mysqli_query($connectBdd, "SELECT * FROM annuaire_exploit_abonne,annuaire_param_civilite
																WHERE annuaire_exploit_abonne.id_Eabonne='".$_POST['responsable3']."'
																AND annuaire_exploit_abonne.id_Pcivilite=annuaire_param_civilite.id_Pcivilite
																");
			
			$resultResp = mysqli_fetch_assoc($queryResp);
			$responsable = $resultResp['lib_civ']."&nbsp;".$resultResp['nom_ab']."&nbsp;".$resultResp['prenom_personne'];
		}
		
		$query1 = mysqli_query($connectBdd , "UPDATE annuaire_param_service 
												SET lib_ser='".$_POST['libelle2']."',
												num_ser='".$_POST['numero2']."',
												responsable_ser='".$responsable."',
												id_Ppole='".$_POST['pole3']."',
												id_Plocalisation='".$localisation."',
												synonyme_ser='".$_POST['synonyme2']."',
												actif_ser='".$_POST['actif']."',
												modificateur_ser='".$_SESSION['ANNUAIRE_ADMIN_aph']."',
												date_modif_ser='".date("Y-m-d H:i:s")."'
												WHERE id_Pservice=".$_POST['id']."
												");
		$erreur_service = 1;
	}
	
	// ON AFFICHE UN MESSAGE D'ERREUR
	if($erreur_service == 2)
	{
		echo "<font color=\"red\">Aucune modification n'a été apportée</font><br><br>";
	}
	if($erreur_service == 1)
	{
		echo "<font color =\"red\">Modification réussie</font><br><br>";
	}
	
	echo "<a href=\"../admin_accueil.php\">Retour</a>";
?>

</body>

</html>