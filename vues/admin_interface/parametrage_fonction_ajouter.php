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
	$fonction_erreur = -1;
	
	// SI LE FORMULAIRE EST REMPLI
	if((!empty($_POST['libelle1'])) AND (!empty($_POST['ordre1'])))
	{	
		// ON CHERCHE LES SAISIES DANS LA BASE DE DONNEES
		$query2 = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_fonction 
														WHERE lib_fonc='".$_POST['libelle1']."'
														AND ordre_fonc='".$_POST['ordre1']."'
														");
		$result2 = mysqli_fetch_assoc($query2);

		// SI LES CHAMPS EXISTENT 
		if(mysqli_num_rows($query2) >= 1)
		{
			$fonction_erreur = 2;
		}
		// ON INSERE DANS LA BASE DE DONNEES
		else 
		{
			$query1 = mysqli_query($connectBdd,"INSERT INTO annuaire_param_fonction
														VALUES('',
																'".$_POST['libelle1']."',
																'".$_POST['ordre1']."',
																'1',
																'".$_SESSION['ANNUAIRE_ADMIN_aph']."',
																'',
																'".date("Y-m-d H:i:s")."',
																''
																)");
			$fonction_erreur = 1;
		}
	}
	else
	{
		$fonction_erreur = 3;
	}
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if($fonction_erreur == 1)
	{
		echo "<font color=\"red\">La fonction a bien été ajoutée.</font>";
	}
	if($fonction_erreur == 2)
	{
		echo "<font color=\"red\">La fonction existe déjà.</font>";
	}
	if($fonction_erreur == 3)
	{
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font>";
	}

	echo "<br><br><a href=\"../admin_accueil.php\">Retour</a>";	
?>

</body>

</html>