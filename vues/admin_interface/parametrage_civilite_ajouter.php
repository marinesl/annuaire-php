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
	<title>Annuaire - Ajouter une civilité</title>

	<!-- BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link href="../outils/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/brands.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/solid.css" rel="stylesheet">
</head>

<body>

<?php
	$erreur_civilite = -1;
	
	// SI LE CHAMP EST REMPLI
	if (!empty($_POST['libelle1'])) {	
		// ON CHERCHE LA SAISIE DANS LA BASE DE DONNEES
		$sql2 = "SELECT * FROM annuaire_php_param_civilite WHERE lib_civ='".$_POST['libelle1']."'";
		$query2 = $connectBdd->prepare($sql2);
		$query2->execute();
		
		// SI LE CHAMP 'LIBELLE1' EXISTE 
		if ($query2->rowCount() >= 1)
			$erreur_civilite = 2;
		// ON INSERE DANS LA BASE DE DONNEES 
		else {
			$sql1 = "INSERT INTO annuaire_php_param_civilite
					VALUES('', '".$_POST['libelle1']."', '1', '".$_SESSION['ANNUAIRE_ADMIN_aph']."', '', '".date("Y-m-d H:i:s")."', '' )";
			$query1 = $connectBdd->prepare($sql1);
			$query1->execute();
			$result1 = ($query1->rowCount() === 0) ? 0 : $query1->fetchAll();

			$erreur_civilite = 1;
		}
	} else
		$erreur_civilite = 3;
	
	// MESSAGE D'ERREUR
	if ($erreur_civilite == 1)
		echo "<font color=\"red\">La civilité a bien été ajoutée.</font><br><br>";
	if ($erreur_civilite == 2)
		echo "<font color=\"red\">La civilité existe déjà.</font><br><br>";
	if ($erreur_civilite == 3)
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font><br><br>";

	echo "<a href=\"../admin_accueil.php\">Retour</a>";
?>

</body>

</html>