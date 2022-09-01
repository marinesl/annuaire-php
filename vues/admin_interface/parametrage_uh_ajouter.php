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
	$uh_erreur = -1;
	
	// SI LE FORMULAIRE EST REMPLI
	if(!empty($_POST['libelle1']) AND !empty($_POST['numero1']) AND !empty($_POST['ua1']))
	{	
		// ON CHERCHE LES SAISIES DANS LA BASE DE DONNEES
		$query2 = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_uh WHERE lib_uh='".$_POST['libelle1']."'");

		// SI LE CHAMP 'LIBELLE1' EXISTE 
		if(mysqli_num_rows($query2) >= 1)
		{
			$uh_erreur = 2;
		}
		// SINON ON INSERE DANS LA BASE DE DONNEES ET
		else 
		{
			$query1 = mysqli_query($connectBdd, "INSERT INTO annuaire_param_uh
															VALUES('',
																	'".$_POST['numero1']."',
																	'".$_POST['libelle1']."',
																	'".$_POST['ua1']."',
																	'1',
																	'".$_SESSION['ANNUAIRE_ADMIN_aph']."',
																	'',
																	'".date("Y-m-d H:i:s")."',
																	''
																	)");
			$uh_erreur = 1;
		}
	}
	else
	{
		$uh_erreur = 3;
	}
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if($uh_erreur == 1)
	{
		echo "<font color=\"red\">L'UH a bien été ajoutée.</font>";
	}
	if($uh_erreur == 2)
	{
		echo "<font color=\"red\">L'UH existe déjà.</font>";
	}
	if($uh_erreur == 3)
	{
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font>";
	}

	echo "<br><br><a href=\"../admin_accueil.php\">Retour</a>";	
?>

</body>

</html>