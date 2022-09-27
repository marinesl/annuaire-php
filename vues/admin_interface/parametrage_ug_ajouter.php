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
	<title>Annuaire - Ajouter un UG</title>

	<!-- BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link href="../outils/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/brands.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/solid.css" rel="stylesheet">
</head>

<body>

<?php
	$ug_erreur = -1;
	
	// SI LE FORMULAIRE EST REMPLI
	if (!empty($_POST['libelle1']) AND !empty($_POST['numero1']) AND !empty($_POST['service1'])) {	
		// ON CHERCHE LES SAISIES DANS LA BASE DE DONNEES
		$sql2 = "SELECT * FROM annuaire_php_param_ug WHERE lib_ug='".$_POST['libelle1']."'";
		$query2 = $connectBdd->prepare($sql2);
		$query2->execute();

		// SI LE CHAMP 'LIBELLE1' EXISTE 
		if ($query2->rowCount() >= 1)
			$ug_erreur = 2;
		
		// SINON ON INSERE DANS LA BASE DE DONNEES 
		else {
			$sql1 = "INSERT INTO annuaire_php_param_ug
					VALUES('', '".$_POST['numero1']."', '".$_POST['libelle1']."', '".$_POST['service1']."', '1', '".$_SESSION['ANNUAIRE_ADMIN_aph']."', '', '".date("Y-m-d H:i:s")."', '' )";
			$query1 = $connectBdd->prepare($sql1);
			$query1->execute();

			$ug_erreur = 1;
		}
	} else
		$ug_erreur = 3;
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if ($ug_erreur == 1)
		echo "<font color=\"red\">L'UG a bien été ajoutée.</font>";
	if ($ug_erreur == 2)
		echo "<font color=\"red\">L'UG existe déjà.</font>";
	if ($ug_erreur == 3)
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font>";

	echo "<br><br><a href=\"../admin_accueil.php\">Retour</a>";	
?>

</body>

</html>