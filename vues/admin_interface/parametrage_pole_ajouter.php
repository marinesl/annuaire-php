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
	$pole_erreur = -1;
	
	// SI LE FORMULAIRE EST REMPLI
	if((!empty($_POST['libelle1'])) AND (!empty($_POST['numero1'])))
	{	
		// ON CHERCHE LES SAISIES DANS LA BASE DE DONNEES
		$query2 = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_pole 
														WHERE lib_pole='".$_POST['libelle1']."'
														AND num_pole='".$_POST['numero1']."'
														");

		// SI LES CHAMPS EXISTENT 
		if(mysqli_num_rows($query2) >= 1)
		{
			$pole_erreur = 2;
		}
		// SINON ON INSERE DANS LA BASE DE DONNEES 
		else 
		{
			$query1 = mysqli_query($connectBdd, "INSERT INTO annuaire_param_pole
															VALUES('',
																	'".$_POST['numero1']."',
																	'".$_POST['libelle1']."',
																	'1',
																	'".$_SESSION['ANNUAIRE_ADMIN_aph']."',
																	'',
																	'".date("Y-m-d H:i:s")."',
																	''
																	)");
			$pole_erreur = 1;
		}
	}
	else
	{
		$pole_erreur = 3;
	}
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if($pole_erreur == 1)
	{
		echo "<font color=\"red\">Le pôle a bien été ajouté.</font>";
	}
	if($pole_erreur == 2)
	{
		echo "<font color=\"red\">Le pôle existe déjà.</font>";
	}
	if($pole_erreur == 3)
	{
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font>";
	}

	echo "<br><br><a href=\"../admin_accueil.php\">Retour</a>";	
?>

</body>

</html>