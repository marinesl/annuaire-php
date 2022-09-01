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
	$erreur_civilite = -1;
	
	// SI LE CHAMP EST REMPLI
	if(!empty($_POST['libelle1']))
	{	
		// ON CHERCHE LA SAISIE DANS LA BASE DE DONNEES
		$query2 = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_civilite WHERE lib_civ='".$_POST['libelle1']."'");
		$result2 = mysqli_fetch_assoc($query2);
		
		// SI LE CHAMP 'LIBELLE1' EXISTE 
		if(mysqli_num_rows($query2) >= 1)
		{
			$erreur_civilite = 2;
		}
		// ON INSERE DANS LA BASE DE DONNEES 
		else 
		{
			$query1 = mysqli_query($connectBdd,"INSERT INTO annuaire_param_civilite
														VALUES('',
																'".$_POST['libelle1']."',
																'1',
																'".$_SESSION['ANNUAIRE_ADMIN_aph']."',
																'',
																'".date("Y-m-d H:i:s")."',
																''
																)");
			$erreur_civilite = 1;
		}
	}
	else
	{
		$erreur_civilite = 3;
	}
	
	// MESSAGE D'ERREUR
	if($erreur_civilite == 1)
	{
		echo "<font color=\"red\">La civilité a bien été ajoutée.</font><br><br>";
	}
	if($erreur_civilite == 2)
	{
		echo "<font color=\"red\">La civilité existe déjà.</font><br><br>";
	}
	if($erreur_civilite == 3)
	{
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font><br><br>";
	}

	echo "<a href=\"../admin_accueil.php\">Retour</a>";
?>

</body>

</html>