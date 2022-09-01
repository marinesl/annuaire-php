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
	$ug_erreur = -1;
	
	// SI LE FORMULAIRE EST REMPLI
	if(!empty($_POST['libelle1']) AND !empty($_POST['numero1']) AND !empty($_POST['service1']))
	{	
		// ON CHERCHE LES SAISIES DANS LA BASE DE DONNEES
		$query2 = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_ug WHERE lib_ug='".$_POST['libelle1']."'");

		// SI LE CHAMP 'LIBELLE1' EXISTE 
		if(mysqli_num_rows($query2) >= 1)
		{
			$ug_erreur = 2;
		}
		// SINON ON INSERE DANS LA BASE DE DONNEES 
		else 
		{
			$query1 = mysqli_query($connectBdd, "INSERT INTO annuaire_param_ug
															VALUES('',
																	'".$_POST['numero1']."',
																	'".$_POST['libelle1']."',
																	'".$_POST['service1']."',
																	'1',
																	'".$_SESSION['ANNUAIRE_ADMIN_aph']."',
																	'',
																	'".date("Y-m-d H:i:s")."',
																	''
																	)");
			$ug_erreur = 1;
		}
	}
	else
	{
		$ug_erreur = 3;
	}
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if($ug_erreur == 1)
	{
		echo "<font color=\"red\">L'UG a bien été ajoutée.</font>";
	}
	if($ug_erreur == 2)
	{
		echo "<font color=\"red\">L'UG existe déjà.</font>";
	}
	if($ug_erreur == 3)
	{
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font>";
	}

	echo "<br><br><a href=\"../admin_accueil.php\">Retour</a>";	
?>

</body>

</html>