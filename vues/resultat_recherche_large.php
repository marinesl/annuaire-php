<?php 
	session_start();
	// CONNEXION A LA BASE DE DONNEES
	include("../connexion/connexionBdd.php");
	// VARIABLE D'OUVERTURE DU PANNEAU
	$_SESSION['type_rch'] = "large";
?>

<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Annuaire PHP - Recherche large</title>

	<!-- BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link href="../outils/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/brands.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/solid.css" rel="stylesheet">
	
</head>

<body>

	<!-- CONTENEUR -->
	<div class="container">

		<!-- HEADER -->
		<header>
			<!-- BARRE DE NAVIGATION -->
			<nav class="navbar navbar-inverse">
				<div class="navbar-header">
						<a class="navbar-brand" href="../../index.php"  id="haut">Annuaire</a>
					</div>
					<ul class="nav navbar-nav navbar-justified">
						<li class="active"><a href="../index.php" >Accueil<i class="fa-solid fa-house"></i></a></li>
						<li><a href="notice_telephone.php">Notice téléphone</a></li>
						<li><a href="numeros_abreges.php">Numéros abrégés</a></li>
						<li><a href="numeros_urgence.php"><strong>Numéros d'urgence</strong></a></li>
						<!-- <li><a href="../doc_img/aide_utilisation_annumen.pdf"><i class="fa-solid fa-circle-question"></i>Aide</a></li> -->
					</ul>
			</nav>
		</header>

		<!-- SECTION -->
		<section>
		
		<?php
			// INITIALISATION VARIABLE FORMULAIRE
			$recherche = $_POST['rchLarge'];
			
			// INITIALISATION VARIABLES / REQUETES PRINCIPALES
			$criteres1 = "";
			$criteres2 = "";
			$sqltable = "";
			
			// MISE A JOUR CRITERES 2
			// SI LE CHAMP CACHE CONTIENT CRITERES 1
			// ON MET A JOUR CRITERES 1 ET ON CREE CRITERES 2
			if ((!empty($_POST['inputcritere'])) OR (isset($_POST['inputcritere']))) {
				$sqltable = $_POST['inputtable'];
				$criteres1 = $_POST['inputcritere'];
				
				// SI LES CHECKBOX 'TYPES' SONT COCHEES
				if (!empty($_POST['checkboxtype'])) {
					$criteres2 .= " AND (";
					foreach($_POST['checkboxtype'] as $valeur)
						$vartype .= " OR type_ab='".$valeur."'"; 
					$vartype = substr($vartype, 4);
					$criteres2 .= $vartype.")";
				}
				
				// SI LES CHECKBOX 'CIVILITES' SONT COCHEES
				if (!empty($_POST['checkboxciv'])) {
					$criteres2 .= " AND (";
					foreach($_POST['checkboxciv'] as $valeur)
						$varcivilite .= " OR annuaire_php_exploit_abonne.id_Pcivilite='".$valeur."'"; 
					$varcivilite = substr($varcivilite,4);
					$criteres2 .= $varcivilite.")";
				}
				
				// SI LES CHECKBOX 'SERVICES' SONT COCHEES
				if (!empty($_POST['checkboxser'])) {
					$criteres2 .= " AND (";
					foreach($_POST['checkboxser'] as $valeur)
						$varservice .= " OR annuaire_php_param_service.id_Pservice='".$valeur."'"; 
					$varservice = substr($varservice,4);
					$criteres2 .= $varservice.")";
				}
				
				// SI LES CHECKBOX 'FONCTIONS' SONT COCHEES
				if (!empty($_POST['checkboxfonc'])) {
					$criteres2 .= " AND (";
					foreach($_POST['checkboxfonc'] as $valeur)
						$varfonction .= " OR annuaire_php_param_fonction.id_Pfonction='".$valeur."'"; 
					$varfonction = substr($varfonction,4);
					$criteres2 .= $varfonction.")";
				}
				
				// SI LES CHECKBOX 'BATIMENTS' SONT COCHEES
				if (!empty($_POST['checkboxbat'])) {
					$criteres2 .= " AND (";
					foreach($_POST['checkboxbat'] as $valeur)
						$varbatiment .= " OR annuaire_php_param_batiment.id_Pbatiment='".$valeur."'";
					$varbatiment = substr($varbatiment, 4);
					$criteres2 .= $varbatiment.")";
				}
			} else {
				// CRITERES 1
				$criteres1 .= " AND info_integrale LIKE '%".$recherche."%' AND annuaire_php_param_moteur_recherche.id_Eabonne=annuaire_php_exploit_abonne.id_Eabonne";
				$sqltable .= "annuaire_php_param_moteur_recherche,annuaire_php_exploit_abonne";
			}
			
			// REQUETE CRITERES 1 
			$sqlcriteres1 = "SELECT info_integrale 
							FROM ".$sqltable."
							WHERE 1 ";
			$sqlcriteres1 .= $criteres1;
			
			// REQUETE SQL RESULTAT
			$sqlresultat = "SELECT * 
							FROM annuaire_php_param_civilite,annuaire_php_param_fonction,annuaire_php_param_localisation,annuaire_php_param_batiment,annuaire_php_param_etage,annuaire_php_param_porte,".$sqltable."
							WHERE actif_ab=1
							AND annuaire_php_exploit_abonne.id_Pcivilite=annuaire_php_param_civilite.id_Pcivilite
							AND annuaire_php_exploit_abonne.id_Pfonction=annuaire_php_param_fonction.id_Pfonction
							AND annuaire_php_exploit_abonne.id_Plocalisation=annuaire_php_param_localisation.id_Plocalisation
							AND annuaire_php_param_localisation.id_Pbatiment=annuaire_php_param_batiment.id_Pbatiment
							AND annuaire_php_param_localisation.id_Petage=annuaire_php_param_etage.id_Petage
							AND annuaire_php_param_localisation.id_Pporte=annuaire_php_param_porte.id_Pporte";
			$sqlresultat .= $criteres1;
			$sqlresultat .= $criteres2;
			$sqlresultat .= " ORDER BY ordre_ab ASC";

			// TODO: la requête dans resultat_recherche_large.php est à revoir car l'utilisation de info_integrale dans la table annuaire_php_param_moteur_recherche n'est pas pratique
			$queryresultat = $connectBdd->prepare($sqlresultat);
			$queryresultat->execute();
			$resultresulat = ($queryresultat->rowCount() === 0) ? 0 : $queryresultat->fetchAll();
			$nb_resultresultat = $queryresultat->rowCount();

			// SI TOUS LES CHAMPS SONT VIDES
			if ($recherche == "" AND !isset($_POST['boutonrch'])) {
				// ALORS ON AFFICHE UN MESSAGE D'ERREUR SUR LE FORMULAIRE
				$_SESSION['rch_large_erreur'] = "Veuillez remplir le formulaire.";
				header('location:../index.php');

			// SINON ON AFFICHE LES RESULTATS
			} else {
				// REQUETE SQL CRITERES 1 
				$requeteCriteres1 = $connectBdd->prepare($sqlcriteres1);
				$requeteCriteres1->execute();

				// NOMBRE DE RESULTATS 
				$nb_resultcritere = $requeteCriteres1->rowCount();
		
				// AFFICHAGE RESULTATS
				if ($nb_resultcritere == 0) {	
					// AUCUN RESULTAT
					echo "<h1><center>Il n'y a aucun résultat correspondant à votre demande.</center></h1>\n";
					echo "<h4><center><a href=\"../index.php\">Nouvelle recherche</a></center></h4>";
				} else { 
					// UN OU PLUSIEURS RESULTATS
					
					// FONCTION AFFICHAGE DU 'S' PLURIEL
					function pluriel($nb) {
						if ($nb > 1) return "s";
					}
					
					echo "<h2><center>Il y a ".$nb_resultcritere." résultat".pluriel($nb_resultcritere)." correspondant".pluriel($nb_resultcritere)." à votre recherche.</center></h2>";
					
					// SI LES CRITERES SONT COCHES
					if (!empty($criteres2))
						echo "<h3><center>Il y a ".$nb_resultresultat." résultat".pluriel($nb_resultresultat)." correspondant".pluriel($nb_resultresultat)." à votre seconde recherche.</center></h3>";
					echo "<h4><center><a href=\"../index.php\">Nouvelle recherche</a></center></h4>"; 
		?>	
		
		<div class="row">	
			
			<!-- CRITERES -->
			<div class="col-lg-3">	
				<div class="panel panel-primary">	
					<div class="panel-heading">
						<h4 class="panel-title">Critères de recherche</h4>
					</div>
					<div class="panel-body">
						<!-- BOUTONS COCHER TOUT ET DECOCHER TOUT -->
						<button class="btn btn-primary" onclick="selectAll()">Tout cocher</button>
						<button class="btn btn-primary" onclick="deselectAll()">Tout décocher</button><br><br>
						<!-- FORMULAIRE ENVOI DES CRITERES -->
						<form name="formCritère" method="post" action="">
							<div class="form-group">
								<button type="submit" class="btn btn-primary" name="boutonrch">Rechercher</button>
								<!-- CHAMPS CACHES CONTENANT CRITERES 1 ET SQLTABLE -->
								<input type="hidden" name="inputcritere" value="<?php echo $criteres1; ?>">
								<input type="hidden" name="inputtable" value="<?php echo $sqltable; ?>">
								
								<?php 
									// REQUETE SQL TYPES
									$sqltype = "SELECT distinct(type_ab) 
												FROM ".$sqltable."
												WHERE 1";
									$sqltype .= $criteres1;

									$querytype = $connectBdd->prepare($sqltype);
									$querytype->execute();
									$resulttype = ($querytype->rowCount() === 0) ? 0 : $querytype->fetchAll();
									
									// VARIABLES POUR LES FONCTIONS JAVA
									$nb_caracteristique = $querytype->rowCount();
									$fincaracteristique = $nb_caracteristique;
								?>
								<h4><u>Caractéristiques</u><i class="fa-solid fa-circle-check" onclick="selectAllItem(1,<?php echo $fincaracteristique; ?>)"></i><i class="fa-solid fa-xmark" onclick="deselectAllItem(1,<?php echo $fincaracteristique; ?>)"></i></h4>
								<ul class="list-unstyled">
									<?php
										// AFFICHAGE DES TYPES	
										if ($resulttype !== 0) {
											for ($i = 0 ; $i < count($resulttype) ; $i++) {
												echo "<li><input type=\"checkbox\" name=\"checkboxtype[]\" value=\"".$resulttype[$i]['type_ab']."\" >".$resulttype[$i]['type_ab']."</li>";
											}
										}
									?>									
								</ul>
							
								<?php
									// REQUETE SQL CIVILITES							
									$sqlcivilite = "SELECT distinct(lib_civ),annuaire_php_param_civilite.id_Pcivilite
													FROM annuaire_php_param_civilite,".$sqltable."
													WHERE annuaire_php_exploit_abonne.id_Pcivilite=annuaire_php_param_civilite.id_Pcivilite
													AND actif_civ=1
													AND annuaire_php_param_civilite.id_Pcivilite>0";
									$sqlcivilite .= $criteres1;
									$sqlcivilite .= " ORDER BY lib_civ ASC";

									$querycivilite = $connectBdd->prepare($sqlcivilite);
									$querycivilite->execute();
									$resultcivilite = ($querycivilite->rowCount() === 0) ? 0 : $querycivilite->fetchAll();
									
									// VARIABLES POUR LES FONCTIONS JAVA
									$nb_civilite = $querycivilite->rowCount();
									$debutcivilite = $fincaracteristique + 1;
									$fincivilite = $fincaracteristique + $nb_civilite;
								?>
								<h4><u>Civilités</u><i class="fa-solid fa-circle-check" onclick="selectAllItem(<?php echo $debutcivilite; ?>,<?php echo $fincivilite; ?>)"></i><i class="fa-solid fa-xmark" onclick="deselectAllItem(<?php echo $debutcivilite; ?>,<?php echo $fincivilite; ?>)"></i></h4>
								<ul class="list-unstyled">
									<?php
										//  AFFICHAGE DES CIVILITES
										if ($resultcivilite !== 0) {
											for ($i = 0 ; $i < count($resultcivilite) ; $i++) {
												echo "<li><input type=\"checkbox\" name=\"checkboxciv[]\" value=\"".$resultcivilite[$i]['id_Pcivilite']."\">".$resultcivilite[$i]['lib_civ']."</li>\n";
											}
										}
									?>									
								</ul>
						
								<?php
									// REQUETE SQL SERVICES
									$sqlservice = "SELECT distinct(lib_ser), annuaire_php_param_service.id_Pservice
													FROM annuaire_php_param_service,annuaire_php_exploit_service,".$sqltable."
													WHERE actif_ser=1
													AND annuaire_php_exploit_abonne.id_Eabonne=annuaire_php_exploit_service.id_Eabonne
													AND annuaire_php_param_service.id_Pservice=annuaire_php_exploit_service.id_Pservice";
									$sqlservice .= $criteres1;
									$sqlservice .= " ORDER BY lib_ser";

									$queryservice = $connectBdd->prepare($sqlservice);
									$queryservice->execute();
									$resultservice = ($queryservice->rowCount() === 0) ? 0 : $queryservice->fetchAll();
									
									// VARIABLES POUR LES FONCTIONS JAVA
									$nb_service = $queryservice->rowCount();
									$debutservice = $fincivilite + 1;
									$finservice = $fincivilite + $nb_service;
								?>
								<h4><u>Services</u><i class="fa-solid fa-circle-check" onclick="selectAllItem(<?php echo $debutservice; ?>,<?php echo $finservice; ?>)"></i><i class="fa-solid fa-xmark" onclick="deselectAllItem(<?php echo $debutservice; ?>,<?php echo $finservice; ?>)"></i></h4>
								<ul class="list-unstyled">
									<?php
										// AFFICHAGE DES SERVICES
										if ($resultservice !== 0) {
											for ($i = 0 ; $i < count($resultservice) ; $i++) {
												echo "<li><input type=\"checkbox\" name=\"checkboxser[]\" value=\"".$resultservice[$i]['id_Pservice']."\">".$resultservice[$i]['lib_ser']."</li>\n";
											}
										}
									?>									
								</ul>
				
								<?php
									// REQUETE SQL FONCTIONS
									$sqlfonction = "SELECT distinct(lib_fonc), annuaire_php_param_fonction.id_Pfonction
													FROM annuaire_php_param_fonction,".$sqltable."
													WHERE annuaire_php_exploit_abonne.id_Pfonction=annuaire_php_param_fonction.id_Pfonction
													AND actif_fonc=1
													AND annuaire_php_param_fonction.id_Pfonction>0";
									$sqlfonction .= $criteres1;
									$sqlfonction .= " ORDER BY lib_fonc";

									$queryfonction = $connectBdd->prepare($sqlfonction);
									$queryfonction->execute();
									$resultfonction = ($queryfonction->rowCount() === 0) ? 0 : $queryfonction->fetchAll();
									
									// VARIABLES POUR LES FONCTIONS JAVA
									$nb_fonction = $queryfonction->rowCount();
									$debutfonction = $finservice + 1;
									$finfonction = $finservice + $nb_fonction;
								?>
								<h4><u>Fonctions</u><i class="fa-solid fa-circle-check" onclick="selectAllItem(<?php echo $debutfonction; ?>,<?php echo $finfonction; ?>)"></i><i class="fa-solid fa-xmark" onclick="deselectAllItem(<?php echo $debutfonction; ?>,<?php echo $finfonction; ?>)"></i></h4>
								<ul class="list-unstyled">
									<?php
										// AFFICHAGE DES FONCTIONS
										if ($resultfonction !== 0) {
											for ($i = 0 ; $i < count($resultfonction) ; $i++) {
												echo "<li><input type=\"checkbox\" name=\"checkboxfonc[]\" value=\"".$resultfonction[$i]['id_Pfonction']."\">".$resultfonction[$i]['lib_fonc']."</li>\n";
											}
										}
									?>
								</ul>
				
								<?php
									// REQUETE SQL BATIMENTS
									$sqlbatiment = "SELECT distinct(lib_bat),annuaire_php_param_batiment.id_Pbatiment
													FROM annuaire_php_param_localisation,annuaire_php_param_batiment,".$sqltable."
													WHERE annuaire_php_exploit_abonne.id_Plocalisation=annuaire_php_param_localisation.id_Plocalisation
													AND annuaire_php_param_localisation.id_Pbatiment=annuaire_php_param_batiment.id_Pbatiment
													AND actif_loca=1
													AND actif_bat=1";
									$sqlbatiment .= $criteres1;
									$sqlbatiment .= " ORDER BY lib_bat";

									$querybatiment = $connectBdd->prepare($sqlbatiment);
									$querybatiment->execute();
									$resultbatiment = ($querybatiment->rowCount() === 0) ? 0 : $querybatiment->fetchAll();
									
									// VARIABLES POUR LES FONCTIONS JAVA
									$nb_batiment = $querybatiment->rowCount();
									$debutbatiment = $finfonction + 1;
									$finbatiment = $finfonction + $nb_batiment;
								?>
								<h4><u>Bâtiments</u><i class="fa-solid fa-circle-check" onclick="selectAllItem(<?php echo $debutbatiment; ?>,<?php echo $finbatiment; ?>)"></i><i class="fa-solid fa-xmark" onclick="deselectAllItem(<?php echo $debutbatiment; ?>,<?php echo $finbatiment; ?>)"></i></h4>
								<ul class="list-unstyled">
									<?php
										// AFFICHAGE DES BATIMENTS
										if ($resultbatiment !== 0) {
											for ($i = 0 ; $i < count($resultbatiment) ; $i++) {
												echo "<li><input type=\"checkbox\" name=\"checkboxbat[]\" value=\"".$resultbatiment[$i]['id_Pbatiment']."\">".$resultbatiment[$i]['lib_bat']."</li>\n";
											}
										}
									?>
								</ul>
							
							</div>	<!-- .form-group -->
						</form>
					</div>	<!-- .panel-body -->
					
				</div>	<!-- .panel -->				
			</div>	<!-- .col-lg-3 -->

			<!-- RESULTATS -->
			<div class="col-lg-9">	
			
			<?php

				if ($resultresulat !== 0) {
					for ($i = 0 ; $i < count($resultresulat) ; $i++) {
			?>		
					<div class="panel panel-primary">	
						<div class="panel-heading">					
							<h4 class="panel-title">
							<?php 
								// AFFICHAGE DE LA CIVILITE + NOM + PRENOM 
								echo $resultresulat[$i]['lib_civ']."".$resultresulat[$i]['nom_ab']."".$resultresulat[$i]['prenom_personne'];
							?> </h4>
						</div>
						<div class="panel-body">
							<div class="row">
							
								<div class="col-lg-4">
									<ul class="list-unstyled">
										<?php 
											// REQUETE SQL + AFFICHAGE DU SERVICE 
											$sqlservice2 = "SELECT distinct(lib_ser),num_ser
															FROM annuaire_php_exploit_abonne,annuaire_php_exploit_service,annuaire_php_param_service
															WHERE annuaire_php_exploit_abonne.id_Eabonne='".$resultresulat[$i]['id_Eabonne']."'
															AND annuaire_php_exploit_service.id_Eabonne='".$resultresulat[$i]['id_Eabonne']."'
															AND annuaire_php_exploit_service.id_Pservice=annuaire_php_param_service.id_Pservice
															ORDER BY lib_ser";
											$queryservice2 = $connectBdd->prepare($sqlservice2);
											$queryservice2->execute();
											$resultservice2 = ($queryservice2->rowCount() === 0) ? 0 : $queryservice2->fetchAll();

											if ($resultservice2 !== 0) {
												for ($j = 0 ; $j < count($resultservice2) ; $j++) {
													echo "<li>".$resultservice2[$j]['lib_ser']."(".$resultservice2[$j]['num_ser'].")</li>";
												}
											}
											
											// AFFICHAGE DE LA FONCTION 
											echo "<li>".$resultresulat[$i]['lib_fonc']."</li>";
											
											// AFFICHAGE DE LA LOCALISATION 
											echo "<li>Bâtiment : ".$resultresulat[$i]['lib_bat']."</li>";
											echo "<li>Etage : ".$resultresulat[$i]['lib_eta']."</li>";
											echo "<li>Porte : ".$resultresulat[$i]['lib_porte']."</li>";
										?>								
									</ul>
								</div>
								
								<div class="col-lg-4">							
									<ul class="list-unstyled">							
										<?php
											// REQUETE SQL + AFFICHAGE DES NUMEROS 
											$sqlnumero = "SELECT * FROM annuaire_php_exploit_abonne,annuaire_php_exploit_numero
															WHERE annuaire_php_exploit_abonne.id_Eabonne='".$resultresulat[$i]['id_Eabonne']."'
															AND annuaire_php_exploit_numero.id_Eabonne='".$resultresulat[$i]['id_Eabonne']."'
															ORDER BY ordre_num";
											$querynumero = $connectBdd->prepare($sqlnumero);
											$querynumero->execute();
											$resultnumero = ($querynumero->rowCount() === 0) ? 0 : $querynumero->fetchAll();

											if ($resultnumero !== 0) {
												for ($j = 0 ; $j < count($resultnumero) ; $j++) {
													echo "<li>".$resultnumero[$j]['lib_num']."</li>";
												}
											}
										?>
									</ul>							
								</div>
								
								<div class="pull-right">
									<ul class="list-unstyled">
										<li><div><center>
										<?php 
											// REQUETE SQL + AFFICHAGE DE LA PHOTO
											//header("Content-type: image/jpg");
											//echo $resultresulat[$i]['photo_personne'];
											// if(!empty($resultresulat[$i]['photo_personne']))
											// {
												// echo $resultresulat[$i]['photo_personne'];
											// }
											// else
											// {
										?>
										<img src="../doc_img/image.jpeg" alt="photo"></center></div></li>
										<?php //} ?>
										
										<!-- LIEN MODIFICATION -->
										<li><div><a href="modif_connexion.php"><center><i class="fa-solid fa-pen"></i>Modifier les coordonnées</center></a></div></li>
									</ul>
								</div>
								
							</div>	<!-- .row -->
						</div>	<!-- .panel-body -->
					</div>	<!-- .panel -->
				<?php } } ?>
			</div>	<!-- .col-lg-9 -->
		
		</div>	<!-- .row -->
		
		<?php 
				// ELSE	2
				}	
			// ELSE 1
			}
		?>	
		
		</section>

		<!-- FOOTER -->
		<footer>
			<!-- RETOUR HAUT DE PAGE -->
			<a href="#haut"><center><i class="fa-solid fa-arrow-up"></i></center></a>
		</footer>

		<?php
			// DECONNEXION A LA BASE DE DONNEES
			include('../connexion/deconnexionBdd.php');
		?>	
		
	</div>	<!-- .container -->

	<!-- DECLARATION JAVASCRIPT -->
	<script src="../outils/bootstrap/js/jquery.js"></script>
	<script src="../outils/bootstrap/js/bootstrap.js"></script>

	<!-- SCRIPT FONCTION JAVASCRIPT COCHER TOUT ET DECOCHER TOUT -->
	<script type="text/javascript">
		// FONCTION TOUT COCHER
		function selectAll() {
			for(i=0;i<document.formCritère.length;i++) {
				if(document.formCritère.elements[i].type=="checkbox")
				document.formCritère.elements[i].checked=true;
			}
		} 
		
		// FONCTION TOUT DECOCHER
		function deselectAll() {
			for(i=0;i<document.formCritère.length;i++) {
				if(document.formCritère.elements[i].type=="checkbox")
				document.formCritère.elements[i].checked=false;
			}
		}

		// FONCTION TOUT COCHER ITEM
		function selectAllItem(debut,fin) {
			if(fin>=debut) {
				for(i=debut+2;i<=fin+2;i++) {
					if(document.formCritère.elements[i].type=="checkbox")
					document.formCritère.elements[i].checked=true;
				}
			}
		} 

		// FONCTION TOUT DECOCHER ITEM
		function deselectAllItem(debut,fin) {
			if(fin>=debut) {
				for(i=debut+2;i<=fin+2;i++) {
					if(document.formCritère.elements[i].type=="checkbox")
					document.formCritère.elements[i].checked=false;
				}
			}
		}
	</script>
	
</body>

</html>