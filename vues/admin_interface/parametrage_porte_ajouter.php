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
	$porte_erreur = -1;
	
	// SI LE FORMULAIRE EST REMPLI
	if(!empty($_POST['libelle1']))
	{	
		// ON CHERCHE LA SAISIE DANS LA BASE DE DONNEES
		$query2 = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_porte WHERE lib_porte='".$_POST['libelle1']."'");

		// SI LE CHAMP 'LIBELLE1' EXISTE 
		if(mysqli_num_rows($query2) >= 1)
		{
			$porte_erreur = 2;
		}
		// SINON ON INSERE DANS LA BASE DE DONNEES 
		else 
		{
			$query1 = mysqli_query($connectBdd, "INSERT INTO annuaire_param_porte
															VALUES('',
																	'".$_POST['libelle1']."',
																	'1',
																	'".$_SESSION['ANNUAIRE_ADMIN_aph']."',
																	'',
																	'".date("Y-m-d H:i:s")."',
																	''
																	)");
			$porte_erreur = 1;
		}
	}
	else
	{
		$porte_erreur = 3;
	}
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if($porte_erreur == 1)
	{
		echo "<font color=\"red\">La porte a bien été ajoutée.</font>";
	}
	if($porte_erreur == 2)
	{
		echo "<font color=\"red\">La porte existe déjà.</font>";
	}
	if($porte_erreur == 3)
	{
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font>";
	}

	echo "<br><br><a href=\"../admin_accueil.php\">Retour</a>";	
?>

</body>

</html>