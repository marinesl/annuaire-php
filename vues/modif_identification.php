<?php

	// CONNEXION MODIFICATION
	
	// CE SCRIPT RENVOIE UNE VARIABLE $_SESSION['ANNUAIRE_MODIF_identification'] EGALE A 1
	// QUI VALIDE L'IDENTIFICATION AINSI QUE SON GROUPE DANS UN ACTIVE DIRECTORY (AD)
	// IL FAUT AFFICHER SI ET SEULEMENT SI $_SESSION['ANNUAIRE_MODIF_identification'] == 1
	
	session_start();
	
	// INITIALISATION DES VARIABLES
	$_SESSION['ANNUAIRE_MODIF_user'];
	$_SESSION['ANNUAIRE_MODIF_pass'];
	$_SESSION['ANNUAIRE_MODIF_identification'] = -1 ;

	// POUR LA MISE A JOUR DES DONNEES DE LA TABLE ANNUAIRE_ADMIN_USER
	$_SESSION['ANNUAIRE_MODIF_nom'] = "" ;
	$_SESSION['ANNUAIRE_MODIF_prenom'] = "" ;
	$_SESSION['ANNUAIRE_MODIF_aph'] = "" ;
	$_SESSION['ANNUAIRE_MODIF_mail'] = "" ;
	
	// SI LA FORMULAIRE EST REMPLI
	if(isset($_POST['user']) && isset($_POST['motdepasse']) && $_POST['user'] != '' && $_POST['motdepasse'] != '')
	{
		$_SESSION['ANNUAIRE_MODIF_user'] = $_POST['user'];
		$_SESSION['ANNUAIRE_MODIF_pass'] = $_POST['motdepasse'];
				
		// CONNEXION A L'AD
		include('../connexion/connexionAD.php');
		
		// CONNEXION ETABLIE
		if($connectAD)
		{
			$bind = @ldap_bind($connectAD,$user,$password);
			
			// SI LE LOGIN ET LE MOT DE PASSE SONT CORRECTS
			// ON SE DECONNECTE ET ON SE CONNECTE AVEC UN COMPTE ADMIN AYANT LES DROITS
			if($bind == TRUE)
			{
				include('../connexion/deconnexionAD.php');
				include('../connexion/connexionAD.php');
				
				ldap_bind($connectAD,$admin,$password_admin) or exit("L'application n'arrive pas à se connecter au serveur AD.".ldap_error($connectAD));
				
				$recherche = ldap_search($connectAD,$base_dn,$filter) or exit ("La recherche ne marche pas.");
				$liste = ldap_get_entries($connectAD,$recherche);

				// ON RECUPERE LES INFORMATIONS DE L'AD
				include('../connexion/connexionBdd.php');
				
				// 'SN' = NOM DANS L'AD
				$tableau_nom = $liste[0]['sn'];
				foreach($tableau_nom as $valeur1)
				{
					$_SESSION['ANNUAIRE_MODIF_nom'] = strtoupper($valeur1);
				}
				
				// 'GIVENNAME' = PRENOM DANS L'AD
				$tableau_prenom = $liste[0]['givenname'];
				foreach($tableau_prenom as $valeur2)
				{
					$_SESSION['ANNUAIRE_MODIF_prenom'] = strtolower($valeur2);
				}
 
				// 'MAIL' = MAIL DANS L'AD
				$tableau_mail = $liste[0]['mail'];
				foreach($tableau_mail as $valeur3)
				{
					$_SESSION['ANNUAIRE_MODIF_mail'] = $valeur3;
				}

				include('../connexion/deconnexionBdd.php');

				// ON TESTE SI LA PERSONNE A UNE FICHE DANS L'ANNUAIRE
				include('../connexion/connexionBdd.php');
				$query1 = "SELECT * FROM annuaire_exploit_abonne WHERE aph_personne='".$_POST['user']."'";
				$result1 = mysqli_query($connectBdd,$query1);
				
				// SI L'APH EXISTE 
				// ON MET A JOUR LA TABLE ANNUAIRE_ADMIN_USER
				// ET $_SESSION['ANNUAIRE_MODIF_identification'] = 1
				if(mysqli_num_rows($result1) == 1)
				{
					$_SESSION['ANNUAIRE_MODIF_identification'] = 1;
					
					$query2 = "SELECT * FROM annuaire_admin_user WHERE aph_user='".$_POST['user']."'";
					$result2 = mysqli_query($connectBdd,$query2);
					
					// SI LA PERSONNE EXISTE DANS LA TABLE ANNUAIRE_ADMIN_USER
					// ON FAIT UN UPDATE
					if(mysqli_num_rows($result2) == 1)
					{
						$ligne1 = mysqli_fetch_assoc($result2);
						$query3 = "UPDATE annuaire_admin_user
										SET nom_user='".htmlentities(utf8_decode(trim(addslashes($_SESSION['ANNUAIRE_MODIF_nom']))))."',
											prenom_user='".htmlentities(utf8_decode(trim(addslashes($_SESSION['ANNUAIRE_MODIF_prenom']))))."',
											aph_user='".$_POST['user']."',
											mail_user='".htmlentities(utf8_decode(trim(addslashes($_SESSION['ANNUAIRE_MODIF_mail']))))."',
											modificateur_user='".$_POST['user']."',
											date_modif_user='".date("Y-m-d H:i:s")."'
										WHERE id_Auser='".$ligne1['id_Auser']."'
											";
					}
					// SINON ON FAIT UN INSERT
					else
					{
						$query3 = "INSERT INTO annuaire_admin_user
											VALUES('',
													'".htmlentities(utf8_decode(trim(addslashes($_SESSION['ANNUAIRE_MODIF_nom']))))."',
													'".htmlentities(utf8_decode(trim(addslashes($_SESSION['ANNUAIRE_MODIF_prenom']))))."',
													'".$_POST['user']."',
													'".htmlentities(utf8_decode(trim(addslashes($_SESSION['ANNUAIRE_MODIF_mail']))))."',
													'1',
													'".$_POST['user']."',
													'',
													'".date("Y-m-d H:i:s")."',
													''
													)";
					}
					$result3 = mysqli_query($connectBdd,$query3);
				}
				// SINON $_SESSION['ANNUAIRE_MODIF_identification'] = 4
				else
				{
					$_SESSION['ANNUAIRE_MODIF_identification'] = 4;
					
					$query4 = "SELECT * FROM annuaire_exploit_abonne WHERE nom_ab='".$_SESSION['ANNUAIRE_MODIF_nom']."'
																		AND prenom_personne='".$_SESSION['ANNUAIRE_MODIF_prenom']."'";
					$result4 = mysqli_query($connectBdd,$query4);
					
					// SI LE NOM ET LE PRENOM EXISTENT
					// $_SESSION['ANNUAIRE_MODIF_identification'] = 3
					if(mysqli_num_rows($result4) == 1)
					{
						$_SESSION['ANNUAIRE_MODIF_identification'] = 3;
					}
				}
				include('../connexion/deconnexionBdd.php');
			}	// .if($bind == TRUE)
			else
			{
				$_SESSION['ANNUAIRE_MODIF_identification'] = 2;
			}
		}	// .if($connectAD)
		else
		{
			echo "Impossible de connecter le serveur LDAP.";
		}
	}	// .if(isset($_POST['user']) && isset($_POST['motdepasse']) && $_POST['user'] != '' && $_POST['motdepasse'] != '')

	if($_SESSION['ANNUAIRE_MODIF_identification'] == 1)
	{
		include('../connexion/connexionBdd.php');
		
		//ON INSERE LES INFORMATIONS DANS LA TABLE ANNUAIRE_ADMIN_LOGCX
		$query5 = "INSERT INTO annuaire_admin_logCx
							VALUES('',
									'OK',
									'Connexion utilisateur : ".$_POST['user']."',
									'".date("Y-m-d H:i:s")."'
									)";

		$result5 = mysqli_query($connectBdd,$query5);
		
		// AFFICHER LE CONTENU DE LA PAGE CI-DESSOUS AINSI QUE L'ENSEMBLE DU SITE
		// SI ET SEULEMENT SI $_SESSION['ANNUAIRE_MODIF_identification'] = 1
		$_SESSION['ANNUAIRE_MODIF_identification'] = $_POST['user'];
		
		include('../connexion/deconnexionBdd.php');
		
		header('location:'.$accueil_modif);
	}
	else
	{
		if(($_SESSION['ANNUAIRE_MODIF_identification'] == 2) || ($_SESSION['ANNUAIRE_MODIF_identification'] == 4) || ($_SESSION['ANNUAIRE_MODIF_identification'] == 3))
		{
			include('../connexion/connexionBdd.php');
			
			// ON INSERE LES INFORMATIONS DANS LA TABLE ANNUAIRE_ADMIN_LOGCX
			$query5 = "INSERT INTO annuaire_admin_logCx
								VALUES('',
										'KO',
										'Echec connexion utilisateur : ".$_POST['user']."',
										'".date("Y-m-d H:i:s")."'
										)";
										
			$result5 = mysqli_query($connectBdd,$query5);
			
			include('../connexion/deconnexionBdd.php');
		}
		include('modif_connexion.php');
	}
?>