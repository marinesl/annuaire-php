<?php
	session_start();
	// CONNEXION A LA BASE DE DONNEES
	include('../../connexion/connexionBdd.php');
	
	// INITIALISATION DES VARIABLES DU FORMULAIRE
	$aph = $_POST['aph'];
	$civilite = $_POST['civilite'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$fonction = $_POST['fonction'];
	$service = $_POST['service'];
	$communication = $_POST['communication'];
	$numero = $_POST['numero'];
	$batiment = $_POST['batiment'];
	$etage = $_POST['etage'];
	$porte = $_POST['porte'];
	
	$photo_blob = "";

	// INITIALISATION DES BOUTONS DU FORMULAIRE FORMAULAIRE
	$boutonajouter = $_POST['boutonajouter'];
	$boutoncreer = $_POST['creer'];
	$boutonsupprimerservice = $_POST['boutonsupprimerS'];
	$boutonsupprimernumero = $_POST['boutonsupprimerN'];
	
	$localisation = "";
	
	// SI LES CHAMPS 'NOM' ET 'PRENOM' SONT VIDES
	// ON AFFICHE UN MESSAGE D'ERREUR SUR LE FORMULAIRE
	if ($nom == "" AND $prenom == "") {
		$_SESSION['PERSONNE_panel'] = "open";
		$_SESSION['PERSONNE_erreur_ko'] = "Veuillez remplir les champs avec un astérisque.";
		header('location:../admin_accueil.php');
	} else {
		// SI LES CHAMPS BATIMENT, ETAGE ET PORTE SONT REMPLIS
		// ON CHERCHE SI LA LOCALISATION CORRESPONDANTE EXISTE
		if ((!empty($batiment)) AND (!empty($etage)) AND (!empty($porte))) {
			// REQUETE SQL LOCALISATION
			$sqllocalisation1 = "SELECT * 
								FROM annuaire_php_param_localisation,annuaire_php_param_batiment,annuaire_php_param_etage,annuaire_php_param_porte
								WHERE annuaire_php_param_localisation.id_Pbatiment=annuaire_php_param_batiment.id_Pbatiment
								AND annuaire_php_param_localisation.id_Pporte=annuaire_php_param_porte.id_Pporte
								AND annuaire_php_param_localisation.id_Petage=annuaire_php_param_etage.id_Petage
								AND id_Pbatiment='".$batiment."'
								AND id_Pporte='".$porte."'
								AND id_Petage='".$etage."'
								AND actif_loca=1";
			$querylocalisation1 = $connectBdd->prepare($sqllocalisation1);
			$querylocalisation1->execute();
			$resultlocalisation1 = ($querylocalisation1->rowCount() === 0) ? 0 : $querylocalisation1->fetchAll();
																		
			$nb_localisation1 = $querylocalisation1->rowCount();
			
			// SI LA LOCALISATION EXISTE DEJA
			// ON MET A JOUR LA VARIABLE $localisation
			if ($nb_localisation1 == 1)
				$localisation = $resultlocalisation1['id_Plocalisation'];
			// SINON ON CREE LA LOCALISATION DANS LA BASE DE DONNEES
			// ET ON MET A JOUR LA VARIABLE $localisation
			else {
				$sqllocalistion2 = "INSERT INTO annuaire_php_param_localisation
									VALUES('', '".$batiment."', '".$etage."', '".$porte."', '1', '".$_SESSION['ANNUAIRE_ADMIN_aph']."', '', '".date("Y-m-d H:i:s")."', '' )";
				$querylocalisation2 = $connectBdd->prepare($sqllocalistion2);
				$querylocalisation2->execute();
				$localisation = ($querylocalisation2->rowCount() === 0) ? 0 : $querylocalisation2->fetchAll();
			}
		}
		
		/*
		// TELECHARGEMENT DE LA PHOTO
		if(isset($_FILES['photo']))
		{
			$upload = false;
			$photo_taille = 0;
			$photo_type = "";
			$photo_nom = "";
			$taille_max = 65536;
			
			$upload = is_uploaded_file($_FILES['photo']['tmp_name']);
			echo "upload=".$upload."<br>";
			
			if(!$upload)
			{
				$_SESSION['PERSONNE_erreur_photo'] = "Problème de transfert.";
				echo "Problème de transfert<br>";
			}
			else
			{
				echo "Pas de problème de transfert<br>";
				// LE FICHIER A BIEN ETE RECU
				$photo_taille = $_FILES['photo']['size'];
				echo "photo_taille=".$photo_taille."<br>";
				echo "taille_max=".$taille_max."<br>";
				if($photo_taille > $taille_max)
				{
					$_SESSION['PERSONNE_erreur_photo'] = "Votre fichier est trop gros.";
					echo "Votre fichier est trop gros.<br>";
				}
				
				$photo_type = $_FILES['photo']['type'];
				$photo_nom = $_FILES['photo']['name'];
				$photo_blob = file_get_contents($_FILES['photo']['tmp_name']);
				$sql = "INSERT INTO annuaire_photo
						VALUES('', '".addslashes($photo_blob)."' )";
				$query = $connectBdd->prepare($sql);
				$query->execute();

				$sql2 = "SELECT * FROM annuaire_photo WHERE id_photo='5'";
				$query2 = $connectBdd->prepare($sql2);
				$query2->execute();
				$result2 = ($query2->rowCount() === 0) ? 0 : $query2->fetchAll();

				if ($result2 !== 0) {
    				for ($i = 0 ; $i < count($result2) ; $i++) {
						header("Content-type: ".$photo_type);
						echo $result2['blob'];
					}
				}
			}
		}
		*/
		
		// MISE A JOUR DE L'ID
		$_SESSION['PERSONNE_id'] = $_POST['personne_id'];
		
		// SI L'ID N'EXISTE PAS
		// ON CREE LA PERSONNE
		// ET ON MET A JOUR L'ID
		if ($_POST['personne_id'] == "") {
			// REQUETE D'AJOUT D'UN ABONNE
			$sqlajouter = "INSERT INTO annuaire_php_exploit_abonne 
							VALUES('', 'Personne', '".$civilite."', '".$nom."', '".$prenom."', '".$aph."', '".$fonction."', '".$localisation."', '', '999999999', '1', '".$_SESSION['ANNUAIRE_ADMIN_aph']."', '', '".date("Y-m-d H:i:s")."', '' )";
			$queryajouter = $connectBdd->prepare($sqlajouter);
			$queryajouter->execute();
			$_SESSION['PERSONNE_id'] = ($queryajouter->rowCount() === 0) ? 0 : $queryajouter->fetchAll();

			$_SESSION['PERSONNE_erreur_ok'] = "La personne a été ajoutée.";

		// SINON ON MODIFIE LA PERSONNE
		} else {
			$sqlmodifier = "UPDATE annuaire_php_exploit_abonne
							SET id_Pcivilite='".$civilite."',
							aph_personne='".$aph."',
							id_Pfonction='".$fonction."',
							id_Plocalisation='".$localisation."',
							photo_personne='".$photo_blob."',
							modificateur_ab='".$_SESSION['ANNUAIRE_ADMIN_aph']."',
							date_modif_ab='".date("Y-m-d H:i:s")."'
							WHERE id_Eabonne='".$_POST['personne_id']."'";
			$querymodifier = $connectBdd->prepare($sqlmodifier);
			$querymodifier->execute();

			$_SESSION['PERSONNE_erreur_ok'] = "La personne a été modifiée.";
		}
		
		// SI LE BOUTON AJOUTER UN SERVICE EXISTE
		// ON AJOUTE UN SERVICE
		if ($boutonajouter == "service") {
			// REQUETE AJOUT D'UN SERVICE
			$sqlservice1 = "INSERT INTO annuaire_php_exploit_service
							VALUES('', '".$_SESSION['PERSONNE_id']."', '".$service."', '1', '".$_SESSION['ANNUAIRE_ADMIN_aph']."', '', '".date("Y-m-d H:i:s")."', '' )";
			$queryservice1 = $connectBdd->prepare($sqlservice1);
			$queryservice1->execute();
		}
		
		// SI LE BOUTON AJOUTER UN NUMERO EXISTE
		// ON AJOUTE UN NUMERO
		if ($boutonajouter == "numero") {
			// REQUETE AJOUT D'UN NUMERO
			$sqlnumero1 = "INSERT INTO annuaire_php_exploit_numero
							VALUES('', '', '".$communication."', '".$_SESSION['PERSONNE_id']."', '', '".$numero."', '1', '".$_SESSION['ANNUAIRE_ADMIN_aph']."', '', '".date("Y-m-d H:i:s")."', '' )";
			$querynumero1 = $connectBdd->prepare($sqlnumero1);
			$querynumero1->execute();
		}
		
		// SI LE BOUTON SUPPRIMER UN SERVICE EXISTE
		// ON MET L'ACTIF A 0
		if (!empty($boutonsupprimerservice)) {
			$sqlservice2 = "UPDATE annuaire_php_exploit_service
							SET actif_Eser='0',
							modificateur_Eser='".$_SESSION['ANNUAIRE_ADMIN_aph']."',
							date_modif_Eser='".date("Y-m-d H:i:s")."'
							WHERE id_Eabonne='".$_SESSION['PERSONNE_id']."'
							AND id_Eservice='".$boutonsupprimerservice."'";
			$queryservice2 = $connectBdd->prepare($sqlservice2);
			$queryservice2->execute();
			$boutonsupprimerservice = "";
		}
		
		// SI LE BOUTON SUPPRIMER UN NUMERO EXISTE
		// ON MET L'ACTIF A 0
		if (!empty($boutonsupprimernumero)) {
			$sqlnumero2 = "UPDATE annuaire_php_exploit_numero
							SET actif_num='0',
							modificateur_num='".$_SESSION['ANNUAIRE_ADMIN_aph']."',
							date_modif_num='".date("Y-m-d H:i:s")."'
							WHERE id_Enumero='".$boutonsupprimernumero."'
							AND id_Eabonne='".$_SESSION['PERSONNE_id']."' ";
			$querynumero2 = $connectBdd->prepare($sqlnumero2);
			$querynumero2->execute();
			$boutonsupprimernumero = "";				
		}
		
		$_SESSION['PERSONNE_panel'] = "open";
		header('location:../admin_accueil.php');
	}
?>