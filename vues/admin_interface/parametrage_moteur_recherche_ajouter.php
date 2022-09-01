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
	$moteur_erreur = -1;
	
	// ON SUPPRIME '_' DE LA SAISIE
	$abonne1 = explode("_",$_POST['abonne1']);
	
	// SI LE FORMULAIRE EST REMPLI
	if((!empty($_POST['abonne1'])) AND (!empty($_POST['info1'])))
	{	
		// ON CHERCHE LA SAISIE DANS LA BASE DE DONNEES
		$query2 = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_moteur_recherche,annuaire_exploit_abonne 
														WHERE annuaire_param_moteur_recherche.id_Eabonne=annuaire_exploit_abonne.id_Eabonne
														AND nom_ab='".$abonne1[0]."'
														AND prenom_personne='".$abonne1[1]."'
														");

		// SI LE CHAMP 'ABONNE1' EXISTE 
		if(mysqli_num_rows($query2) >= 1)
		{
			$moteur_erreur = 2;
		}
		// SINON ON INSERE DANS LA BASE DE DONNEES 
		else 
		{
			$query3 = mysqli_query($connectBdd, "SELECT * FROM annuaire_exploit_abonne
															WHERE nom_ab='".$abonne1[0]."'
															AND prenom_personne='".$abonne1[1]."'
															");
			$result3 = mysqli_fetch_assoc($query3);
			
			$query1 = mysqli_query($connectBdd, "INSERT INTO annuaire_param_moteur_recherche
															VALUES('',
																	'".$result3['id_Eabonne']."',
																	'".$_POST['info1']."'
																	)");
			$moteur_erreur = 1;
		}
	}
	else
	{
		$moteur_erreur = 3;
	}
	
	// ON AFFICHE LE MESSAGE D'ERREUR
	if($moteur_erreur == 1)
	{
		echo "<font color=\"red\">Les informations ont bien été ajoutées.</font>";
	}
	if($moteur_erreur == 2)
	{
		echo "<font color=\"red\">Les informations de cet abonné existent déjà.</font>";
	}
	if($moteur_erreur == 3)
	{
		echo "<font color=\"red\">Veuillez remplir le formulaire.</font>";
	}
	
	echo "<br><br><a href=\"../admin_accueil.php\">Retour</a>";	
?>

</body>

</html>