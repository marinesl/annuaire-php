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
	<title>Annuaire - Ajouter un étage</title>

	<!-- BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link href="../outils/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/brands.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/solid.css" rel="stylesheet">
</head>

<body>

<?php
	$erreur_etage = -1;
	
	// SI LE CHAMP EST REMPLI
	if (!empty($_POST['libelle1']))
	{	
		// ON CHERCHE LA SAISIE DANS LA BASE DE DONNES
		$sql = "SELECT * FROM annuaire_php_param_etage WHERE lib_eta='".$_POST['libelle1']."'";
		$query2 = $connectBdd->prepare($sql2);
		$query2->execute();
		
		// SI LE CHAMP 'LIBELLE1' EXISTE 
		if ($query2->rowCount() >= 1)
			$erreur_etage = 2;
			
		// SINON ON INSERE DANS LA BASE DE DONNEES 
		else {
			$sql1 = "INSERT INTO annuaire_php_param_etage
					VALUES('', '".$_POST['libelle1']."', '1', '".$_SESSION['ANNUAIRE_ADMIN_aph']."', '', '".date("Y-m-d H:i:s")."', '' )";
			$query1 = $connectBdd->prepare($sql1);
			$query1->execute();

			$erreur_etage = 1;
		}
	} else
		$erreur_etage = 3;
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if ($erreur_etage == 1)
		echo "<font color=\"red\">L'étage a bien été ajouté.</font><br><br>";
	if ($erreur_etage == 2)
		echo "<font color=\"red\">L'étage existe déjà.</font><br><br>";
	if ($erreur_etage == 3)
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font><br><br>";
	
	echo "<a href=\"../admin_accueil.php\">Retour</a>";
?>

</body>

</html>