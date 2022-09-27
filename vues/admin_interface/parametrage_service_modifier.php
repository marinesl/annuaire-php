<?php 
	session_start();
	// CONNEXION A LA BASE DE DONNEES
	include('../../connexion/connexionBdd.php');
?>

<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Annuaire - Modifier un service</title>

	<!-- BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link href="../outils/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/brands.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/solid.css" rel="stylesheet">
</head>

<body>

<?php 
	// INITIALISATION DE LA VARIABLE D'ERREUR
	$erreur_service = -1;
	
	$sql2 = "SELECT * FROM annuaire_php_param_service WHERE id_Pservice=".$_POST['id'];
	$query2 = $connectBdd->prepare($sql2);
	$query2->execute();
	$result2 = ($query2->rowCount() === 0) ? 0 : $query2->fetchAll();
		
	// SI LES CHAMPS DE SAISIE SONT TOUJOURS IDENTIQUES AUX DONNEES
	if(($_POST['libelle2'] == $result2[0]['lib_ser']) AND ($_POST['numero2'] == $result2[0]['num_ser'])
		AND (empty($_POST['responsable3'])) AND ($_POST['synonyme2'] == $result2[0]['synonyme_ser'])
		AND (empty($_POST['pole3'])) AND (empty($_POST['batiment3']))
		AND (empty($_POST['porte3'])) AND (empty($_POST['etage3']))
		AND ($_POST['actif'] == $result2[0]['actif_bat']) )

		$erreur_service = 2;

	// SINON ON MODIFIE LES DONNEES 
	else { 
		$sql = "SELECT * 
				FROM annuaire_php_param_localisation,annuaire_php_param_batiment,annuaire_php_param_porte,annuaire_php_param_etage 
				WHERE annuaire_php_param_localisation.id_Pbatiment=annuaire_php_param_batiment.id_Pbatiment
				AND annuaire_php_param_localisation.id_Pporte=annuaire_php_param_porte.id_Pporte
				AND annuaire_php_param_localisation.id_Petage=annuaire_php_param_etage.id_Petage";
		
		// SI LE CHAMP 'BATIMENT' EST REMPLI
		if (!empty($_POST['batiment3'])) {
			$sql .= " AND annuaire_php_param_batiment.id_Pbatiment='".$_POST['batiment3']."'";
			$batiment = $_POST['batiment3'];
		} else {
			$sql .= " AND annuaire_php_param_batiment.id_Pbatiment='".$_POST['batiment2']."'";
			$batiment = $_POST['batiment2'];
		}
		
		// SI LE CHAMP 'PORTE' EST REMPLI
		if (!empty($_POST['porte3'])) {
			$sql .= " AND annuaire_php_param_porte.id_Pporte='".$_POST['porte3']."'";
			$porte = $_POST['porte3'];
		} else {
			$sql .= " AND annuaire_php_param_porte.id_Pporte='".$_POST['porte2']."'";
			$porte = $_POST['porte2'];
		}
		
		// SI LE CHAMP 'ETAGE' EST REMPLI
		if (!empty($_POST['etage3'])) {
			$sql .= " AND annuaire_php_param_etage.id_Petage='".$_POST['etage3']."'";
			$etage = $_POST['etage3'];
		} else {
			$sql .= " AND annuaire_php_param_etage.id_Petage='".$_POST['etage2']."'";
			$etage = $_POST['etage2'];
		}
		
		$queryLoca = $connectBdd->prepare($sql);
		$queryLoca->execute();
		$resultLoca = ($queryLoca->rowCount() === 0) ? 0 : $queryLoca->fetchAll();

		$localisation = $resultLoca[0]['id_Plocalisation'];
		
		if ($queryLoca->rowCount() == 0) {
			$sqlLoca2 = "INSERT INTO annuaire_php_param_localisation
						VALUES('', '".$batiment."', '".$etage."', '".$porte."', '1', '".$_SESSION['ANNUAIRE_ADMIN_aph']."', '', '".date("Y-m-d H:i:s")."', '' )";
			$queryLoca2 = $connectBdd->prepare($sqlLoca2);
			$queryLoca2->execute();
			$resultLoca2 = ($queryLoca2->rowCount() === 0) ? 0 : $queryLoca2->fetchAll();

			$localisation = $resultLoca2[0];
			echo "<font color=\"red\">La nouvelle localisation a été ajoutée.</font>";
		}
		
		$responsable = $result2[0]['responsable_ser'];
		
		// LE CHAMP 'RESPONSABLE' EST REMPLI
		if (!empty($_POST['responsable3'])) {
			$sqlResp = "SELECT * 
						FROM annuaire_php_exploit_abonne,annuaire_php_param_civilite
						WHERE annuaire_php_exploit_abonne.id_Eabonne='".$_POST['responsable3']."'
						AND annuaire_php_exploit_abonne.id_Pcivilite=annuaire_php_param_civilite.id_Pcivilite";
			$queryResp = $connectBdd->prepare($sqlResp);
			$queryResp->execute();
			$resultResp = ($queryResp->rowCount() === 0) ? 0 : $queryResp->fetchAll();

			$responsable = $resultResp[0]['lib_civ']."&nbsp;".$resultResp[0]['nom_ab']."&nbsp;".$resultResp[0]['prenom_personne'];
		}
		
		$sql1 = "UPDATE annuaire_php_param_service 
				SET lib_ser='".$_POST['libelle2']."',
				num_ser='".$_POST['numero2']."',
				responsable_ser='".$responsable."',
				id_Ppole='".$_POST['pole3']."',
				id_Plocalisation='".$localisation."',
				synonyme_ser='".$_POST['synonyme2']."',
				actif_ser='".$_POST['actif']."',
				modificateur_ser='".$_SESSION['ANNUAIRE_ADMIN_aph']."',
				date_modif_ser='".date("Y-m-d H:i:s")."'
				WHERE id_Pservice=".$_POST['id'];

		$query1 = $connectBdd->prepare($sql1);
		$query1->execute();

		$erreur_service = 1;
	}
	
	// ON AFFICHE UN MESSAGE D'ERREUR
	if ($erreur_service == 2)
		echo "<font color=\"red\">Aucune modification n'a été apportée</font><br><br>";
	if ($erreur_service == 1)
		echo "<font color =\"red\">Modification réussie</font><br><br>";
	
	echo "<a href=\"../admin_accueil.php\">Retour</a>";
?>

</body>

</html>