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
	<title>Annuaire - Ajouter un bâtiment</title>

	<!-- BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link href="../outils/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/brands.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/solid.css" rel="stylesheet">
</head>

<body>

<?php
	$batiment_erreur = -1;
	
	// SI LE FORMULAIRE EST REMPLI
	if (!empty($_POST['libelle1'])) {	
		// ON CHERCHE LA SAISIE DANS LA BASE DE DONNEES
		$sql2 = "SELECT * FROM annuaire_php_param_batiment WHERE lib_bat='".$_POST['libelle1']."'";
		$query2 = $connectBdd->prepare($sql2);
		$query2->execute();
		$result2 = ($query2->rowCount() === 0) ? 0 : $query2->fetchAll();

		// SI LE CHAMP 'LIBELLE1' EXISTE 
		if($query2->rowCount() >= 1)
			$batiment_erreur = 2;
		// SINON ON INSERE DANS LA BASE DE DONNEES 
		else {
			$sql1 = "INSERT INTO annuaire_php_param_batiment
					VALUES('', '".$_POST['libelle1']."', '1', '".$_SESSION['ANNUAIRE_ADMIN_aph']."', '', '".date("Y-m-d H:i:s")."', '' )";
			$query1 = $connectBdd->prepare($sql1);
			$query1->execute();

			$batiment_erreur = 1;
		}
	}
	else
		$batiment_erreur = 3;
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if ($batiment_erreur == 1)
		echo "<font color=\"red\">Le bâtiment a bien été ajouté.</font>";
	if($batiment_erreur == 2)
		echo "<font color=\"red\">Le bâtiment existe déjà.</font>";
	if($batiment_erreur == 3)
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font>";

	echo "<br><br><a href=\"../admin_accueil.php\">Retour</a>";	
?>

</body>

</html>