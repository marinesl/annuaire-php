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
	<title>Annuaire - Ajouter un moteur de recherche</title>

	<!-- BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link href="../outils/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/brands.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/solid.css" rel="stylesheet">
</head>

<body>

<?php
	$moteur_erreur = -1;
	
	// ON SUPPRIME '_' DE LA SAISIE
	$abonne1 = explode("_",$_POST['abonne1']);
	
	// SI LE FORMULAIRE EST REMPLI
	if ((!empty($_POST['abonne1'])) AND (!empty($_POST['info1']))) {	
		// ON CHERCHE LA SAISIE DANS LA BASE DE DONNEES
		$sql2 = "SELECT * 
				FROM annuaire_php_param_moteur_recherche,annuaire_php_exploit_abonne 
				WHERE annuaire_php_param_moteur_recherche.id_Eabonne=annuaire_php_exploit_abonne.id_Eabonne
				AND nom_ab='".$abonne1[0]."'
				AND prenom_personne='".$abonne1[1]."'";
		$query2 = $connectBdd->prepare($sql2);
		$query2->execute();
		$reslt2 = ($query2->rowCount() === 0) ? 0 : $query2->fetchAll();

		// SI LE CHAMP 'ABONNE1' EXISTE 
		if ($query2->rowCount() >= 1)
			$moteur_erreur = 2;

		// SINON ON INSERE DANS LA BASE DE DONNEES 
		else {
			$sql3 = "SELECT * 
					FROM annuaire_php_exploit_abonne
					WHERE nom_ab='".$abonne1[0]."'
					AND prenom_personne='".$abonne1[1]."'";
			$query3 = $connectBdd->prepare($sql3);
			$query3->execute();
			$result3 = ($query3->rowCount() === 0) ? 0 : $query3->fetchAll();

			$sql1 = "INSERT INTO annuaire_php_param_moteur_recherche
					VALUES('', '".$result3[0]['id_Eabonne']."', '".$_POST['info1']."' )";
			$query1 = $connectBdd->prepare($sql1);
			$query1->execute();

			$moteur_erreur = 1;
		}
	} else
		$moteur_erreur = 3;
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if ($moteur_erreur == 1)
		echo "<font color=\"red\">Les informations ont bien été ajoutées.</font>";
	if ($moteur_erreur == 2)
		echo "<font color=\"red\">Les informations de cet abonné existent déjà.</font>";
	if ($moteur_erreur == 3)
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font>";
	
	echo "<br><br><a href=\"../admin_accueil.php\">Retour</a>";	
?>

</body>

</html>