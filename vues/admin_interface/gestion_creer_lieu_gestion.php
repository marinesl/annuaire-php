<?php
	session_start();
	// CONNEXION A LA BASE DE DONNEES
	include('../../connexion/connexionBdd.php');
	
	// INITIALISATION DES VARIABLES DU FORMULAIRE
	$nom = $_POST['nom'];
	$service = $_POST['service'];
	$communication = $_POST['communication'];
	$numero = $_POST['numero'];
	$batiment = $_POST['batiment'];
	$etage = $_POST['etage'];
	$porte = $_POST['porte'];
	
	// INITIALISATION DES BOUTONS DU FORMULAIRE
	$boutonajouter = $_POST['boutonajouter'];
	$boutoncreer = $_POST['creer'];
	$boutonsupprimerservice = $_POST['boutonsupprimerS'];
	$boutonsupprimernumero = $_POST['boutonsupprimerN'];
	
	$localisation = "";
	
	// SI LE CHAMP 'NOM' EST VIDE
	// ON AFFICHE UN MESSAGE D'ERREUR SUR LE FORMAULAIRE
	if($nom == "")
	{
		$_SESSION['LIEU_panel'] = "open";
		$_SESSION['LIEU_erreur_ko'] = "Veuillez remplir le champ avec un astérisque.";
		header('location:../admin_accueil.php');
	}
	else
	{
		// SI LES CHAMPS BATIMENT, ETAGE ET PORTE SONT REMPLIS
		// ON CHERCHE SI LA LOCALISATION CORRESPONDANTE EXISTE
		if((!empty($batiment)) AND (!empty($etage)) AND (!empty($porte)))
		{
			// REQUETE SQL LOCALISATION
			$querylocalisation1 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_localisation,annuaire_param_batiment,annuaire_param_etage,annuaire_param_porte
																		WHERE annuaire_param_localisation.id_Pbatiment=annuaire_param_batiment.id_Pbatiment
																		AND annuaire_param_localisation.id_Pporte=annuaire_param_porte.id_Pporte
																		AND annuaire_param_localisation.id_Petage=annuaire_param_etage.id_Petage
																		AND id_Pbatiment='".$batiment."'
																		AND id_Pporte='".$porte."'
																		AND id_Petage='".$etage."'
																		AND actif_loca=1
																		");
																		
			$resultlocalisation1 = mysqli_fetch_assoc($querylocalisation1);		
			$nb_localisation1 = mysqli_num_rows($querylocalisation1);
			
			// SI LA LOCALISATION EXISTE DEJA
			// ON MET A JOUR LA VARIABLE $localisation
			if($nb_localisation1 == 1)
			{
				$localisation = $resultlocalisation1['id_Plocalisation'];
			}
			// SINON ON CREE LA LOCALISATION DANS LA BASE DE DONNEES
			// ET ON MET A JOUR LA VARIABLE $localisation
			else
			{
				$querylocalisation2 = mysqli_query($connectBdd, "INSERT INTO annuaire_param_localisation
																			VALUES('',
																					'".$batiment."',
																					'".$etage."',
																					'".$porte."',
																					'1',
																					'".$_SESSION['ANNUAIRE_ADMIN_aph']."',
																					'',
																					'".date("Y-m-d H:i:s")."',
																					''
																					)");
				$localisation = mysqli_insert_id($connectBdd);
			}
		}
		
		// MISE A JOUR DE L'ID
		$_SESSION['LIEU_id'] = $_POST['lieu_id'];
		
		// SI L'ID N'EXISTE PAS
		// ON CREE LE LIEU
		// ET ON MET A JOUR L'ID
		if($_POST['lieu_id'] == "")
		{
			// REQUETE D'AJOUT D'UN ABONNE
			$queryajouter = mysqli_query($connectBdd, "INSERT INTO annuaire_exploit_abonne 
																VALUES('',
																		'Lieu',
																		'0',
																		'".$nom."',
																		'',
																		'0',
																		'0',
																		'".$localisation."',
																		'',
																		'999999999',
																		'1',
																		'".$_SESSION['ANNUAIRE_ADMIN_aph']."',
																		'',
																		'".date("Y-m-d H:i:s")."',
																		''
																		)");
			$_SESSION['LIEU_id'] = mysqli_insert_id($connectBdd);
			$_SESSION['LIEU_erreur_ok'] = "Le lieu a été ajouté.";
		}
		// SION ON MODIFIE LE LIEU
		else
		{
			$querymodifier = mysqli_query($connectBdd,"UPDATE annuaire_exploit_abonne
															SET id_Plocalisation='".$localisation."',
															modificateur_ab='".$_SESSION['ANNUAIRE_ADMIN_aph']."',
															date_modif_ab='".date("Y-m-d H:i:s")."'
															WHERE id_Eabonne='".$_POST['lieu_id']."'
															");
			$_SESSION['LIEU_erreur_ok'] = "Le lieu a été modifié.";
		}
		
		// SI LE BOUTON AJOUTER SERVICE EXISTE
		// ON AJOUTE UN SERVICE
		if($boutonajouter == "service")
		{
			// REQUETE AJOUT D'UN SERVICE
			$queryservice1 = mysqli_query($connectBdd, "INSERT INTO annuaire_exploit_service
															VALUES('',
																	'".$_SESSION['LIEU_id']."',
																	'".$service."',
																	'1',
																	'".$_SESSION['ANNUAIRE_ADMIN_aph']."',
																	'',
																	'".date("Y-m-d H:i:s")."',
																	''
																	)");
		}
		
		// SI LE BOUTON AJOUTER NUMERO EXISTE
		// ON AJOUTE UN NUMERO
		if($boutonajouter == "numero")
		{
			// REQUETE AJOUT D'UN NUMERO
			$querynumero1 = mysqli_query($connectBdd, "INSERT INTO annuaire_exploit_numero
															VALUES('',
																	'',
																	'".$communication."',
																	'".$_SESSION['LIEU_id']."',
																	'',
																	'".$numero."',
																	'1',
																	'".$_SESSION['ANNUAIRE_ADMIN_aph']."',
																	'',
																	'".date("Y-m-d H:i:s")."',
																	''
																	)");
		}
		
		// SI LE BOUTON QUPPRIMER UN SERVICE EXISTE
		// ON MET L'ACTIF A 0
		if(!empty($boutonsupprimerservice))
		{
			$queryservice2 = mysqli_query($connectBdd, "UPDATE annuaire_exploit_service
																SET actif_Eser='0',
																modificateur_Eser='".$_SESSION['ANNUAIRE_ADMIN_aph']."',
																date_modif_Eser='".date("Y-m-d H:i:s")."'
																WHERE id_Eabonne='".$_SESSION['LIEU_id']."'
																AND id_Eservice='".$boutonsupprimerservice."'
																");
			$boutonsupprimerservice = "";
		}
		
		// SI LE BOUTON SUPPRIMER UN NUMERO EXISTE
		// ON MET L'ACTIF A 0
		if(!empty($boutonsupprimernumero))
		{
			$querynumero2 = mysqli_query($connectBdd, "UPDATE annuaire_exploit_numero
															SET actif_num='0',
															modificateur_num='".$_SESSION['ANNUAIRE_ADMIN_aph']."',
															date_modif_num='".date("Y-m-d H:i:s")."'
															WHERE id_Enumero='".$boutonsupprimernumero."'
															AND id_Eabonne='".$_SESSION['LIEU_id']."'
															");
			$boutonsupprimernumero = "";				
		}
		
		$_SESSION['LIEU_panel'] = "open";
		header('location:../admin_accueil.php');
	}
?>