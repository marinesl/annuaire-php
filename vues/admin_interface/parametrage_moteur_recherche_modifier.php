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
	<title>Annuaire - Modifier un moteur de recherche</title>

	<!-- BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link href="../outils/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/brands.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/solid.css" rel="stylesheet">
</head>

<?php 
	// INITIALISATION DE LA VARIABLE D'ERREUR
	$erreur_moteur = -1;
	
	if (empty($_POST['abonne3']))
		$abonne2 = explode("_",$_POST['abonne2']);
	else
		$abonne2 = explode("_",$_POST['abonne3']);

	$sql2 = "SELECT * 
			FROM annuaire_php_param_moteur_recherche,annuaire_php_exploit_abonne
			WHERE annuaire_php_param_moteur_recherche.id_Eabonne=annuaire_php_exploit_abonne.id_Eabonne
			AND id_Pmoteur_rch=".$_POST['id'];
	$query2 = $connectBdd->prepare($sql2);
	$query2->execute();
	$result2 = ($query2->rowCount() === 0) ? 0 : $query2->fetchAll();

	// SI LES CHAMPS DE SAISIE SONT TOUJOURS IDENTIQUES AUX DONNEES
	if ((empty($_POST['abonne3'])) AND ($_POST['info2'] == $result2[0]['info_integrale']))
		$erreur_moteur = 2;

	// SINON ON MODIFIE LES DONNEES 
	else {
		$sql3 = "SELECT * 
				FROM annuaire_php_exploit_abonne
				WHERE nom_ab='".$abonne2[0]."'
				AND prenom_personne='".$abonne2[1]."'";
		$query3 = $connectBdd->prepare($sql3);
		$query3->execute();
		$result3 = ($query3->rowCount() === 0) ? 0 : $query3->fetchAll();
		
		$sql1 = "UPDATE annuaire_php_param_moteur_recherche 
				SET id_Eabonne='".$result3[0]['id_Eabonne']."',
				info_integrale='".$_POST['info2']."'
				WHERE id_Pmoteur_rch=".$_POST['id'];
		$query1 = $connectBdd->prepare($sql1);
		$query1->execute();

		$erreur_moteur = 1;
	}
	
	// ON AFFICHE UN MESSAGE D'ERREUR
	if ($erreur_moteur == 2)
		echo "<font color=\"red\">Aucune modification n'a été apportée</font><br><br>";
	if ($erreur_moteur == 1)
		echo "<font color =\"red\">Modification réussie</font><br><br>";

	echo "<a href=\"../admin_accueil.php\">Retour</a>";
?>

</body>

</html>