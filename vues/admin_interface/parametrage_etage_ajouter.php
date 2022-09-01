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
	$erreur_etage = -1;
	
	// SI LE CHAMP EST REMPLI
	if(!empty($_POST['libelle1']))
	{	
		// ON CHERCHE LA SAISIE DANS LA BASE DE DONNES
		$query2 = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_etage WHERE lib_eta='".$_POST['libelle1']."'");
		$result2 = mysqli_fetch_assoc($query2);
		
		// SI LE CHAMP 'LIBELLE1' EXISTE 
		if(mysqli_num_rows($query2) >= 1)
		{
			$erreur_etage = 2;
			
		}
		// SINON ON INSERE DANS LA BASE DE DONNEES 
		else 
		{
			$query1 = mysqli_query($connectBdd,"INSERT INTO annuaire_param_etage
														VALUES('',
																'".$_POST['libelle1']."',
																'1',
																'".$_SESSION['ANNUAIRE_ADMIN_aph']."',
																'',
																'".date("Y-m-d H:i:s")."',
																''
																)");
			$erreur_etage = 1;
		}
	}
	else
	{
		$erreur_etage = 3;
	}
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if($erreur_etage == 1)
	{
		echo "<font color=\"red\">L'étage a bien été ajouté.</font><br><br>";
	}
	if($erreur_etage == 2)
	{
		echo "<font color=\"red\">L'étage existe déjà.</font><br><br>";
	}
	if($erreur_etage == 3)
	{
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font><br><br>";
	}
	
	echo "<a href=\"../admin_accueil.php\">Retour</a>";
?>

</body>

</html>