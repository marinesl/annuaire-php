<?php 
	// CONNEXION ADMINISTRATEUR
	
	// CE SCRIPT RENVOIE UNE VARIABLE $_SESSION['ANNUAIRE_ADMIN_identification'] EGALE A 1 
	// QUI VALIDE L'IDENTIFICATION DE L'UTILISATEUR AINSI QUE SON GROUPE DANS UN ACTIVE DIRECTORY (AD)
	// IL FAUT AFFICHER LE CONTENU DE LA PAGE SI ET SEULEMENT SI $_SESSION['ANNUAIRE_ADMIN_identification'] == 1
	
	session_start();

	// INITIALISATION DES VARIABLES
	$_SESSION['ANNUAIRE_ADMIN_user'];
	$_SESSION['ANNUAIRE_ADMIN_pass'];
	$_SESSION['ANNUAIRE_ADMIN_identification'] = -1 ;
	$_SESSION['ANNUAIRE_ADMIN_admin'] = "KO" ;

	// POUR LA MISE A JOUR DES DONNEES DE LA TABLE ANNUAIRE_ADMIN_USER
	$_SESSION['ANNUAIRE_ADMIN_nom'] = "" ;
	$_SESSION['ANNUAIRE_ADMIN_prenom'] = "" ;
	$_SESSION['ANNUAIRE_ADMIN_aph'] = "" ;
	$_SESSION['ANNUAIRE_ADMIN_mail'] = "" ;

	// SI LE FORMULAIRE EST REMPLI
	if (isset($_POST['user']) && isset($_POST['motdepasse']) && $_POST['user'] != '' && $_POST['motdepasse'] != '')
	{  
		$_SESSION['ANNUAIRE_ADMIN_user'] = $_POST['user'];
		$_SESSION['ANNUAIRE_ADMIN_pass'] = $_POST['motdepasse'];

		// CONNEXION A L'AD
		include('../connexion/connexionAD.php');
		
		// SI LA CONNEXION EST ETABLIE
		if($connectAD)
		{ 
			$bind = @ldap_bind($connectAD,$user,$password);
			
			// VERIFICATION DU GROUPE
			// SI LE LOGIN ET LE PW SONT CORRECTS, 
			// ON SE DECONNECTE ET ON SE CONNECTE AVEC UN COMPTE ADMIN AYANT LES DROITS 
			// ON VA CHERCHER LA LISTE DES GROUPES AUXQUELS L'UTILISATEUR APPARTIENT
			if($bind == TRUE)
			{ 
				// DECONNEXION DE L'AD
				include('../connexion/deconnexionAD.php');
				include('../connexion/connexionAD.php');
					
				// CONNEXION AVEC UN COMPTE ADMIN
				ldap_bind($connectAD,$admin,$password_admin) or exit ("L'application n'arrive pas à s'identifier au serveur AD.".ldap_error($connectAD));
			
				$recherche = ldap_search($connectAD,$base_dn,$filter) or exit ("La recherche ne marche pas.");
				$liste = ldap_get_entries($connectAD,$recherche);
				
				// RECHERCHE DU GROUPE
				// 'MEMBEROF' = GROUPE DANS AD
				$tableau_groupes = $liste[0]["memberof"];
				foreach($tableau_groupes as $valeur1)
				{	
					if((preg_match("!".$groupe."!",$valeur1)))
					{
						$_SESSION['ANNUAIRE_ADMIN_admin'] = "OK";
					}
				}
				
				// SI LE LOGIN ET LE PW SONT CORRECTS
				// MAIS L'UTILISATEUR N'EST PAS DANS LE GROUPE
				// AFFICHER MESSAGE D'ERREUR : 'VOUS N'APPARTENEZ PAS AU GROUPE, FAIRE LA DEMANDE AU CADRE SUP'
				if($_SESSION['ANNUAIRE_ADMIN_admin'] == "OK") 
				{
					$_SESSION['ANNUAIRE_ADMIN_identification'] = 1;
				}
				else
				{
					$_SESSION['ANNUAIRE_ADMIN_identification'] = 2;
				}
				
				// INSERTION OU MISE A JOUR DES DONNEES DANS LA TABLE ANNUAIRE_ADMIN_USER
				if($_SESSION['ANNUAIRE_ADMIN_identification'] == 1)
				{
					include('../connexion/connexionBdd.php');
				
					// 'SN' = NOM DANS AD
					$tableau_nom = $liste[0]['sn'];
					foreach($tableau_nom as $valeur2)
					{
						$_SESSION['ANNUAIRE_ADMIN_nom'] = $valeur2." ";
					}
					
					// 'GIVENAME' = PRENOM DANS AD
					$tableau_prenom = $liste[0]['givenname'];
					foreach($tableau_prenom as $valeur3)
					{
						$_SESSION['ANNUAIRE_ADMIN_prenom'] = $valeur3." ";
					}
					
					// 'MAIL' = MAIL DANS AD
					$tableau_mail = $liste[0]['mail'];
					foreach($tableau_mail as $valeur4)
					{
						$_SESSION['ANNUAIRE_ADMIN_mail'] = $valeur4;
					}
					
					// ON TESTE SI LA PERSONNE EXISTE DANS LA BASE DE DONNEES
					$query1 = "SELECT * FROM annuaire_admin_user WHERE aph_user='".$_POST['user']."'" ;
					$result1 = mysqli_query($connectBdd,$query1);
					
					// SI LA PERSONNE EXISTE 
					// ON FAIT UN UPDATE 
					if(mysqli_num_rows($result1) == 1)
					{
						$ligne1 = mysqli_fetch_assoc($result1);
						$query2 = "UPDATE annuaire_admin_user SET nom_user='".htmlentities(utf8_decode(trim(addslashes($_SESSION['ANNUAIRE_ADMIN_nom']))))."',
																	prenom_user='".htmlentities(utf8_decode(addslashes(trim($_SESSION['ANNUAIRE_ADMIN_prenom']))))."',
																	mail_user='".htmlentities(utf8_decode(trim(addslashes($_SESSION['ANNUAIRE_ADMIN_mail']))))."',
																	date_modif_user='".date('Y-m-d H:i:s')."',
																	modificateur_user='".$_POST['user']."'
																WHERE id_Auser='".$ligne1['id_Auser']."'" ; 
					}
					// SINON ON FAIT UN INSERT
					else
					{ 
						$query2 = "INSERT INTO annuaire_admin_user 
											VALUES('',
													'".htmlentities(utf8_decode(trim(addslashes($_SESSION['ANNUAIRE_ADMIN_nom']))))."',
													'".htmlentities(utf8_decode(trim(addslashes($_SESSION['ANNUAIRE_ADMIN_prenom']))))."',
													'".trim($_POST['user'])."',
													'".htmlentities(utf8_decode(trim(addcslashes($_SESSION['ANNUAIRE_ADMIN_mail']))))."',
													'1',
													'".trim($_POST['user'])."',
													'',
													'".date('Y-m-d H:i:s')."',
													'')";
					}
					$result2 = mysqli_query($connectBdd,$query2) ;
					
					include('../connexion/deconnexionBdd.php');
				
				}	// .if($_SESSION['ANNUAIRE_ADMIN_identification'] == 1)
			}	// .if($bind == TRUE)
			// SI LE LOGIN OU LE PW EST INCORRECT
			// ON SE DECONNECTE ET ON AFFICHE LE FORMULAIRE AVEC UN MESSAGE D'ERREUR
			else
			{
				include('../connexion/deconnexionAD.php');
				$_SESSION['ANNUAIRE_ADMIN_identification'] = 3;
			}
		}	// .if($connectAD)
		else
		{
			echo("Impossible de contacter le serveur LDAP");
		}
	} 	// .if (isset($_POST['user']) && isset($_POST['motdepasse']) && $_POST['user'] != '' && $_POST['motdepasse'] != '')

	// SI LA CONNEXION A FONCTIONNE
	if($_SESSION['ANNUAIRE_ADMIN_identification'] == 1)
	{
		include('../connexion/connexionBdd.php');
		
		// INSERTION DES INFORMATIONS DANS LA TABLE ANNUAIRE_ADMIN_LOGCX
		$query3 = "INSERT INTO annuaire_admin_logCx
							VALUES('',
									'OK',
									'Connexion utilisateur : ".$_POST['user']."',
									'".date("Y-m-d H:i:s")."'
									)";
									
		$result3 = mysqli_query($connectBdd,$query3);
		
		// AFFICHER LE CONTENU DE LA PAGE CI-DESSOUS AINSI QUE L'ENSEMBLE DU SITE
		// SI ET SEULEMENT SI $_SESSION['ANNUAIRE_ADMIN_identification'] == 1
		$_SESSION['ANNUAIRE_ADMIN_aph'] = $_POST['user'];
		
		include('../connexion/deconnexionBdd.php');
		
		header('location:'.$accueil_admin.'');
	}
	else
	{
		// S'IL Y A EU DES ERREURS
		if(($_SESSION['ANNUAIRE_ADMIN_identification'] == 3) || ($_SESSION['ANNUAIRE_ADMIN_identification'] == 2))
		{
			include('../connexion/connexionBdd.php');
			
			// INSERTION DES INFORMATIONS DANS LA TABLE ANNUAIRE_ADMIN_LOGCX
			$query3 = "INSERT INTO annuaire_admin_logCx
								VALUES('',
										'KO',
										'Echec connexion utilisateur : ".$_POST['user']."',
										'".date("Y-m-d H:i:s")."'
										)";
										
			$result3 = mysqli_query($connectBdd,$query3);
			
			include('../connexion/deconnexionBdd.php');
		}
		include('admin_connexion.php');
	}
?>