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
	<title>Annuaire - Ajouter une fonction</title>

	<!-- BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link href="../outils/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/brands.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/solid.css" rel="stylesheet">
</head>

<body>

<?php
	$fonction_erreur = -1;
	
	// SI LE FORMULAIRE EST REMPLI
	if ((!empty($_POST['libelle1'])) AND (!empty($_POST['ordre1']))) {	
		// ON CHERCHE LES SAISIES DANS LA BASE DE DONNEES
		$sql2 = "SELECT * FROM annuaire_php_param_fonction 
				WHERE lib_fonc='".$_POST['libelle1']."'
				AND ordre_fonc='".$_POST['ordre1']."'";
		$query2 = $connectBdd->prepare($sql2);
		$query2->execute();

		// SI LES CHAMPS EXISTENT 
		if ($query2->rowCount() >= 1)
			$fonction_erreur = 2;

		// ON INSERE DANS LA BASE DE DONNEES
		else {
			$sql1 = "INSERT INTO annuaire_php_param_fonction
					VALUES('', '".$_POST['libelle1']."', '".$_POST['ordre1']."', '1', '".$_SESSION['ANNUAIRE_ADMIN_aph']."', '', '".date("Y-m-d H:i:s")."', '' )";
			$query1 = $connectBdd->prepare($sql1);
			$query1->execute();

			$fonction_erreur = 1;
		}
	} else
		$fonction_erreur = 3;
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if ($fonction_erreur == 1)
		echo "<font color=\"red\">La fonction a bien été ajoutée.</font>";
	if ($fonction_erreur == 2)
		echo "<font color=\"red\">La fonction existe déjà.</font>";
	if ($fonction_erreur == 3)
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font>";

	echo "<br><br><a href=\"../admin_accueil.php\">Retour</a>";	
?>

</body>

</html>