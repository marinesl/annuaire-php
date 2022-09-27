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
	<title>Annuaire - Ajouter un pôle</title>

	<!-- BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link href="../outils/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/brands.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/solid.css" rel="stylesheet">
</head>

<body>

<?php
	$pole_erreur = -1;
	
	// SI LE FORMULAIRE EST REMPLI
	if ((!empty($_POST['libelle1'])) AND (!empty($_POST['numero1']))) {	
		// ON CHERCHE LES SAISIES DANS LA BASE DE DONNEES
		$sql2 = "SELECT * 
				FROM annuaire_php_param_pole 
				WHERE lib_pole='".$_POST['libelle1']."'
				AND num_pole='".$_POST['numero1']."'";
		$query2 = $connectBdd->prepare($sql2);
		$query2->execute();

		// SI LES CHAMPS EXISTENT 
		if ($query2->rowCount() >= 1)
			$pole_erreur = 2;

		// SINON ON INSERE DANS LA BASE DE DONNEES 
		else {
			$sql1 = "INSERT INTO annuaire_php_param_pole
					VALUES('', '".$_POST['numero1']."', '".$_POST['libelle1']."', '1', '".$_SESSION['ANNUAIRE_ADMIN_aph']."', '', '".date("Y-m-d H:i:s")."', '' )";
			$query1 = $connectBdd->prepare($sql1);
			$query1->execute();

			$pole_erreur = 1;
		}
	} else
		$pole_erreur = 3;
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if ($pole_erreur == 1)
		echo "<font color=\"red\">Le pôle a bien été ajouté.</font>";
	if ($pole_erreur == 2)
		echo "<font color=\"red\">Le pôle existe déjà.</font>";
	if ($pole_erreur == 3)
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font>";

	echo "<br><br><a href=\"../admin_accueil.php\">Retour</a>";	
?>

</body>

</html>