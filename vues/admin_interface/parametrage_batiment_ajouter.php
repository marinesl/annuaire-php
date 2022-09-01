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
	$batiment_erreur = -1;
	
	// SI LE FORMULAIRE EST REMPLI
	if(!empty($_POST['libelle1']))
	{	
		// ON CHERCHE LA SAISIE DANS LA BASE DE DONNEES
		$query2 = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_batiment WHERE lib_bat='".$_POST['libelle1']."'");
		$result2 = mysqli_fetch_assoc($query2);

		// SI LE CHAMP 'LIBELLE1' EXISTE 
		if(mysqli_num_rows($query2) >= 1)
		{
			$batiment_erreur = 2;
		}
		// SINON ON INSERE DANS LA BASE DE DONNEES 
		else 
		{
			$query1 = mysqli_query($connectBdd,"INSERT INTO annuaire_param_batiment
														VALUES('',
																'".$_POST['libelle1']."',
																'1',
																'".$_SESSION['ANNUAIRE_ADMIN_aph']."',
																'',
																'".date("Y-m-d H:i:s")."',
																''
																)");
			$batiment_erreur = 1;
		}
	}
	else
	{
		$batiment_erreur = 3;
	}
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if($batiment_erreur == 1)
	{
		echo "<font color=\"red\">Le bâtiment a bien été ajouté.</font>";
	}
	if($batiment_erreur == 2)
	{
		echo "<font color=\"red\">Le bâtiment existe déjà.</font>";
	}
	if($batiment_erreur == 3)
	{
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font>";
	}

	echo "<br><br><a href=\"../admin_accueil.php\">Retour</a>";	
?>

</body>

</html>