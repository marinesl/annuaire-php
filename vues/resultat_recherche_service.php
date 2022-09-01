<?php 
	session_start();
	include("../connexion/connexionBdd.php");
	// VARIABLE D'OUVERTURE DU PANNEAU
	$_SESSION['type_rch'] = "service";
?>

<!DOCTYPE html>

<head>
	<title>Annuaire - Hôpital Necker-Enfants Malades</title>
	<meta charset="utf-8"> <!-- Encoding / Encode UTF-8 without BOM -->
	
	<!-- DECLARATION BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">
	
	<link rel="stylesheet" href="../outils/jquery.mCustomScrollbar.css" />

	<!-- SCRIPT FONCTIONS JAVASCRIPT COCHER TOUT ET DECOCHER TOUT -->
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
</head>

<body>

<!-- CONTENEUR -->
<div class="container">

	<!-- HEADER -->
	<header>
	<!-- BARRE DE NAVIGATION -->
	<nav class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="../index.php" id="haut">Annuaire</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
		<ul class="nav navbar-nav navbar-justified">
			<li class="active"><a href="../index.php">Accueil&nbsp;<span class="glyphicon glyphicon-home"></span></a></li>
			<li><a href="notice_telephone.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Notice téléphone</a></li>
			<li><a href="numeros_abreges.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numéros abrégés</a></li>
			<li><a href="numeros_urgence.php"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numéros d'urgence&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></a></li>
			<li><a href="../doc_img/aide_utilisation_annumen.pdf"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Aide</a></li>
		</ul>
	</nav>
	</header>

	<!-- SECTION -->
	<section>
	
	<?php
		// INITIALISATION VARIABLE FORMULAIRE
		$service = $_POST['rchService'];
		
		// INITIALISATION VARIABLES / REQUETES PRINCIPALES
		$criteres1 = "";
		$criteres2 = "";
		$sqltable = "";

		// MISE A JOUR CRITERES 2
		// SI LE CHAMP CACHE CONTIENT CRITERES 1
		// ON MET A JOUR CRITERES 1 ET ON CREE CRITERES 2
		if((!empty($_POST['inputcritere'])) OR (isset($_POST['inputcritere'])))
		{
			$sqltable = $_POST['inputtable'];
			$criteres1 = $_POST['inputcritere'];
			
			// SI LES CHECKBOX 'TYPES' SONT COCHEES
			if(!empty($_POST['checkboxtype']))
			{
				$criteres2 .= " AND (";
				foreach($_POST['checkboxtype'] as $valeur)
				{
					$vartype .= " OR type_ab='".$valeur."'"; 
				}
				$vartype = substr($vartype, 4);
				$criteres2 .= $vartype.")";
			}
			
			// SI LES CHECKBOX 'CIVILITES' SONT COCHEES
			if(!empty($_POST['checkboxciv']))
			{
				$criteres2 .= " AND (";
				foreach($_POST['checkboxciv'] as $valeur)
				{
					$varcivilite .= " OR annuaire_exploit_abonne.id_Pcivilite='".$valeur."'"; 
				}
				$varcivilite = substr($varcivilite,4);
				$criteres2 .= $varcivilite.")";
			}
			
			// SI LES CHECKBOX 'SERVICES' SONT COCHEES
			if(!empty($_POST['checkboxser']))
			{
				$criteres2 .= " AND (";
				foreach($_POST['checkboxser'] as $valeur)
				{
					$varservice .= " OR annuaire_param_service.id_Pservice='".$valeur."'"; 
				}
				$varservice = substr($varservice,4);
				$criteres2 .= $varservice.")";
			}
			
			// SI LES CHECKBOX 'FONCTIONS' SONT COCHEES
			if(!empty($_POST['checkboxfonc']))
			{
				$criteres2 .= " AND (";
				foreach($_POST['checkboxfonc'] as $valeur)
				{
					$varfonction .= " OR annuaire_param_fonction.id_Pfonction='".$valeur."'"; 
				}
				$varfonction = substr($varfonction,4);
				$criteres2 .= $varfonction.")";
			}
			
			// SI LES CHECKBOX 'BATIMENTS' SONT COCHEES
			if(!empty($_POST['checkboxbat']))
			{
				$criteres2 .= " AND (";
				foreach($_POST['checkboxbat'] as $valeur)
				{
					$varbatiment .= " OR annuaire_param_batiment.id_Pbatiment='".$valeur."'";
				}
				$varbatiment = substr($varbatiment, 4);
				$criteres2 .= $varbatiment.")";
			}
		}
		else
		{
			// CRITERES 1
			$criteres1.= " AND annuaire_exploit_service.id_Eabonne=annuaire_exploit_abonne.id_Eabonne 
							AND annuaire_exploit_service.id_Pservice=annuaire_param_service.id_Pservice
							AND lib_ser='".$service."'";
			$sqltable .= ",annuaire_param_service,annuaire_exploit_service";
		}
		
		// REQUETE CRITERES 1 
		$sqlcriteres1 = "SELECT * FROM annuaire_exploit_abonne,annuaire_param_service,annuaire_exploit_service
								WHERE actif_ab=1
								";
		$sqlcriteres1 .= $criteres1;
		
		// REQUETE SQL RESULTAT
		$sqlresultat = "SELECT * FROM annuaire_exploit_abonne,annuaire_param_civilite,annuaire_param_fonction,annuaire_param_localisation,annuaire_param_batiment,annuaire_param_etage,annuaire_param_porte".$sqltable."
									WHERE actif_ab=1
									AND annuaire_exploit_service.id_Eabonne=annuaire_exploit_abonne.id_Eabonne
									AND annuaire_exploit_abonne.id_Pcivilite=annuaire_param_civilite.id_Pcivilite
									AND annuaire_exploit_abonne.id_Pfonction=annuaire_param_fonction.id_Pfonction
									AND annuaire_exploit_abonne.id_Plocalisation=annuaire_param_localisation.id_Plocalisation
									AND annuaire_param_localisation.id_Pbatiment=annuaire_param_batiment.id_Pbatiment
									AND annuaire_param_localisation.id_Petage=annuaire_param_etage.id_Petage
									AND annuaire_param_localisation.id_Pporte=annuaire_param_porte.id_Pporte
									";
		$sqlresultat .= $criteres1;
		$sqlresultat .= $criteres2;
		$sqlresultat .= " ORDER BY ordre_ab ASC";
		$queryresultat = mysqli_query($connectBdd,$sqlresultat);
		
		$nb_resultresultat = mysqli_num_rows($queryresultat);
		
		// SI TOUS LES CHAMPS SONT VIDES
		if ($service == "" AND !isset($_POST['boutonrch']))							
		{
			// ALORS ON AFFICHE UN MESSAGE D'ERREUR SUR LE FORMULAIRE
			$_SESSION['rch_service_erreur'] = "Veuillez remplir le formulaire.";
			header('location:../index.php');
		}
		// SINON ON AFFICHE LES RESULTATS
		else
		{
			// REQUETE CRITERES 1
			$requeteCriteres1 = mysqli_query($connectBdd,$sqlcriteres1);	
	
			// NOMBRE DE RESULTATS 
			$nb_resultcritere = mysqli_num_rows($requeteCriteres1);
	
			// AFFICHAGE RESULTATS
			if ($nb_resultcritere == 0)
			{	
				// AUCUN RESULTAT
				echo "<h1><center>Il n'y a aucun résultat correspondant à votre demande.</center></h1>\n";
				echo "<h4><center><a href=\"../index.php\">Nouvelle recherche</a></center></h4>";
			}
			else
			{ 
				// UN OU PLUSIEURS RESULTATS
				
				// FONCTION AFFICHAGE DU 'S' PLURIEL
				function pluriel($nb)
				{
					if($nb > 1)
					{
						return "s";
					}
				}
				
				echo "<h2><center>Il y a ".$nb_resultcritere." résultat".pluriel($nb_resultcritere)." correspondant".pluriel($nb_resultcritere)." à votre recherche.</center></h2>";
				
				// SI LES CRITERES SONT COCHES
				if(!empty($criteres2))
				{
					echo "<h3><center>Il y a ".$nb_resultresultat." résultat".pluriel($nb_resultresultat)." correspondant".pluriel($nb_resultresultat)." à votre seconde recherche.</center></h3>";
				}
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
					<!-- BOUTON COCHER TOUT ET DECOCHER TOUT -->
					<button class="btn btn-primary" onclick="selectAll()">Tout cocher</button>
					<button class="btn btn-primary" onclick="deselectAll()">Tout décocher</button><br><br>
					<!-- FORMULAIRE ENVOI DES CRITERES -->
					<form name="formCritère" method="post" action="">
						<div class="form-group">
							<button type="submit" class="btn btn-primary" name="boutonrch">Rechercher</button>
							<!-- CHAMPS CACHES CONTENANT CRITERES 1  ET SQLTABLE -->
							<input type="hidden" name="inputcritere" value="<?php echo $criteres1; ?>">
							<input type="hidden" name="inputtable" value="<?php echo $sqltable; ?>">
							
							<?php 
								// REQUETE SQL TYPES 
								$sqltype = "SELECT distinct(type_ab) FROM annuaire_exploit_abonne".$sqltable."
														WHERE 1
														";
								$sqltype .= $criteres1;
								$querytype = mysqli_query($connectBdd,$sqltype);
								
								// VARIABLES POUR LES FONCTIONS JAVA
								$nb_caracteristique = mysqli_num_rows($querytype);
								$fincaracteristique = $nb_caracteristique;
							?>
							<h4><u>Caractéristiques</u>&nbsp;&nbsp;<span class="glyphicon glyphicon-ok" onclick="selectAllItem(1,<?php echo $fincaracteristique; ?>)"></span>&nbsp;&nbsp;<span class="glyphicon glyphicon-remove" onclick="deselectAllItem(1,<?php echo $fincaracteristique; ?>)"></span></h4>
							<ul class="list-unstyled">
								<?php
									// AFFICHAGE DES TYPES	
									while($resulttype = mysqli_fetch_assoc($querytype))
									{
										echo "<li><input type=\"checkbox\" name=\"checkboxtype[]\" value=\"".$resulttype['type_ab']."\" >&nbsp;".$resulttype['type_ab']."</li>";
									}
								?>									
							</ul>
						
							<?php
								// REQUETE SQL CIVILITES						
								$sqlcivilite = "SELECT distinct(lib_civ),annuaire_param_civilite.id_Pcivilite
													FROM annuaire_exploit_abonne,annuaire_param_civilite".$sqltable."
													WHERE annuaire_exploit_abonne.id_Pcivilite=annuaire_param_civilite.id_Pcivilite
													AND actif_civ=1
													AND annuaire_param_civilite.id_Pcivilite>0
													";
								$sqlcivilite .= $criteres1;
								$sqlcivilite .= " ORDER BY lib_civ ASC";
								$querycivilite = mysqli_query($connectBdd,$sqlcivilite);
								
								// VARIABLES POUR LES FONCTIONS JAVA
								$nb_civilite = mysqli_num_rows($querycivilite);
								$debutcivilite = $fincaracteristique + 1;
								$fincivilite = $fincaracteristique + $nb_civilite;
							?>
							<h4><u>Civilités</u>&nbsp;&nbsp;<span class="glyphicon glyphicon-ok" onclick="selectAllItem(<?php echo $debutcivilite; ?>,<?php echo $fincivilite; ?>)"></span>&nbsp;&nbsp;<span class="glyphicon glyphicon-remove" onclick="deselectAllItem(<?php echo $debutcivilite; ?>,<?php echo $fincivilite; ?>)"></span></h4>
							<ul class="list-unstyled">
								<?php
									//  AFFICHAGE DES CIVILITES
									while ($resultcivilite = mysqli_fetch_assoc($querycivilite))
									{
										echo "<li><input type=\"checkbox\" name=\"checkboxciv[]\" value=\"".$resultcivilite['id_Pcivilite']."\">&nbsp;".$resultcivilite['lib_civ']."</li>\n";
									}
								?>									
							</ul>
					
							<?php
								// REQUETE SQL SERVICES
								$sqlservice = "SELECT distinct(lib_ser),annuaire_param_service.id_Pservice
													FROM annuaire_exploit_abonne".$sqltable."
													WHERE actif_ser=1
													";
								$sqlservice .= $criteres1;
								$sqlservice .= " ORDER BY lib_ser";
								$queryservice = mysqli_query($connectBdd,$sqlservice);
								
								// VARIABLES POUR LES FONCTIONS JAVA
								$nb_service = mysqli_num_rows($queryservice);
								$debutservice = $fincivilite + 1;
								$finservice = $fincivilite + $nb_service;
							?>
							<h4><u>Services</u>&nbsp;&nbsp;<span class="glyphicon glyphicon-ok" onclick="selectAllItem(<?php echo $debutservice; ?>,<?php echo $finservice; ?>)"></span>&nbsp;&nbsp;<span class="glyphicon glyphicon-remove" onclick="deselectAllItem(<?php echo $debutservice; ?>,<?php echo $finservice; ?>)"></span></h4>
							<ul class="list-unstyled">
								<?php
									// AFFICHAGE DES SERVICES
									while($resultservice = mysqli_fetch_assoc($queryservice))
									{
										echo "<li><input type=\"checkbox\" name=\"checkboxser[]\" value=\"".$resultservice['id_Pservice']."\">&nbsp;".$resultservice['lib_ser']."</li>\n";
									}
								?>									
							</ul>
			
							<?php
								// REQUETE SQL FONCTIONS	
								$sqlfonction = "SELECT distinct(lib_fonc),annuaire_param_fonction.id_Pfonction
													FROM annuaire_exploit_abonne,annuaire_param_fonction".$sqltable."
													WHERE annuaire_exploit_abonne.id_Pfonction=annuaire_param_fonction.id_Pfonction
													AND actif_fonc=1
													AND annuaire_param_fonction.id_Pfonction>0
													";
								$sqlfonction .= $criteres1;
								$sqlfonction .= " ORDER BY lib_fonc";
								$queryfonction = mysqli_query($connectBdd,$sqlfonction);
								
								// VARIABLES POUR LES FONCTIONS JAVA
								$nb_fonction = mysqli_num_rows($queryfonction);
								$debutfonction = $finservice + 1;
								$finfonction = $finservice + $nb_fonction;
							?>
							<h4><u>Fonctions</u>&nbsp;&nbsp;<span class="glyphicon glyphicon-ok" onclick="selectAllItem(<?php echo $debutfonction; ?>,<?php echo $finfonction; ?>)"></span>&nbsp;&nbsp;<span class="glyphicon glyphicon-remove" onclick="deselectAllItem(<?php echo $debutfonction; ?>,<?php echo $finfonction; ?>)"></span></h4>
							<ul class="list-unstyled">
								<?php
									// AFFICHAGE DES FONCTIONS
									while($resultfonction = mysqli_fetch_assoc($queryfonction))
									{
										echo "<li><input type=\"checkbox\" name=\"checkboxfonc[]\" value=\"".$resultfonction['id_Pfonction']."\">&nbsp;".$resultfonction['lib_fonc']."</li>\n";
									}
								?>
							</ul>
			
							<?php
								// REQUETE SQL BATIMENTS
								$sqlbatiment = "SELECT distinct(lib_bat),annuaire_param_batiment.id_Pbatiment
													FROM annuaire_exploit_abonne,annuaire_param_localisation,annuaire_param_batiment".$sqltable."
													WHERE annuaire_exploit_abonne.id_Plocalisation=annuaire_param_localisation.id_Plocalisation
													AND annuaire_param_localisation.id_Pbatiment=annuaire_param_batiment.id_Pbatiment
													AND actif_loca=1
													AND actif_bat=1
													";
								$sqlbatiment .= $criteres1;
								$sqlbatiment .= " ORDER BY lib_bat";
								$querybatiment = mysqli_query($connectBdd,$sqlbatiment);
								
								// VARIABLES POUR LES FONCTIONS JAVA
								$nb_batiment = mysqli_num_rows($querybatiment);
								$debutbatiment = $finfonction + 1;
								$finbatiment = $finfonction + $nb_batiment;
							?>
							<h4><u>Bâtiments</u>&nbsp;&nbsp;<span class="glyphicon glyphicon-ok" onclick="selectAllItem(<?php echo $debutbatiment; ?>,<?php echo $finbatiment; ?>)"></span>&nbsp;&nbsp;<span class="glyphicon glyphicon-remove" onclick="deselectAllItem(<?php echo $debutbatiment; ?>,<?php echo $finbatiment; ?>)"></span></h4>
							<ul class="list-unstyled">
								<?php
									// AFFICHAGE DES BATIMENTS
									while($resultbatiment = mysqli_fetch_assoc($querybatiment))
									{
										echo "<li><input type=\"checkbox\" name=\"checkboxbat[]\" value=\"".$resultbatiment['id_Pbatiment']."\">&nbsp;".$resultbatiment['lib_bat']."</li>\n";
									}
								?>
							</ul>
						
						</div>	<!-- .form-group -->
					</form>
				</div>	<!-- .panel-body -->
				
			</div>	<!-- .panel -->				
		</div>	<!-- .col-lg-3 -->
		
		<!-- PRESENTATION DU SERVICE -->
		<div class="col-lg-9">	
		
		<?php
			$sqlpresentation = "SELECT * FROM annuaire_exploit_abonne,annuaire_param_pole,annuaire_param_ug,annuaire_param_localisation,annuaire_param_batiment,annuaire_param_etage,annuaire_param_porte".$sqltable."
											WHERE annuaire_param_pole.id_Ppole=annuaire_param_service.id_Ppole
											AND annuaire_param_ug.id_Pservice=annuaire_param_service.id_Pservice
											AND annuaire_param_localisation.id_Plocalisation=annuaire_param_service.id_Plocalisation
											AND annuaire_param_localisation.id_Pbatiment=annuaire_param_batiment.id_Pbatiment
											AND annuaire_param_localisation.id_Petage=annuaire_param_etage.id_Petage
											AND annuaire_param_localisation.id_Pporte=annuaire_param_porte.id_Pporte
											";
			$sqlpresentation .= $criteres1;
			$querypresentation = mysqli_query($connectBdd,$sqlpresentation);
			$resultpresentation = mysqli_fetch_assoc($querypresentation);
		?>
			<div class="panel panel-primary">	
				<div class="panel-heading">					
					<h4 class="panel-title">
						<?php 
							// AFFICHAGE DU SERVICE 
							echo $resultpresentation['lib_ser']." (".$resultpresentation['num_ser'].")"; 
						?> 
					</h4>
				</div>
				<div class="panel-body">
					<div class="row">
					
						<div class="col-lg-5">
							<ul class="list-unstyled">
								<?php 
									// AFFICHAGE DU RESPONSABLE
									echo "<li>Responsable : <b>".$resultpresentation['responsable_ser']."</b></li>";
									
									// AFFICHAGE DES POLES
									echo "<li>Pôle : ".$resultpresentation['lib_pole']." (".$resultpresentation['num_pole'].")</li>";
									
									// AFFICHAGE DES UG
									echo "<li>UG : ".$resultpresentation['lib_ug']." (".$resultpresentation['num_ug'].")</li>";
								?>								
							</ul>
						</div>
						
						<div class="col-lg-4">							
							<ul class="list-unstyled">							
								<?php
									// REQUETE SQL + AFFICHAGE DES NUMEROS 
									// AFFICHAGE DES NUMEROS ACCUEIL
									$sqlnumero1 = "SELECT * FROM annuaire_exploit_numero,annuaire_param_communication
																WHERE annuaire_exploit_numero.id_Pservice='".$resultpresentation['id_Pservice']."'
																AND annuaire_exploit_numero.id_Pcommunication=annuaire_param_communication.id_Pcommunication
																AND lib_com='Accueil'
																";
									$querynumero1 = mysqli_query($connectBdd,$sqlnumero1);
									while($resultnumero1 = mysqli_fetch_assoc($querynumero1))
									{
										echo("<li>Accueil : ".$resultnumero1['lib_num']."</li>\n");	
									}
									
									// AFFICHAGE DES NUMEROS POSTES DE SOINS
									$sqlnumero2 = "SELECT * FROM annuaire_exploit_numero,annuaire_param_communication
																WHERE annuaire_exploit_numero.id_Pservice='".$resultpresentation['id_Pservice']."'
																AND annuaire_exploit_numero.id_Pcommunication=annuaire_param_communication.id_Pcommunication
																AND lib_com='Poste de soins'
																";
									$querynumero2 = mysqli_query($connectBdd,$sqlnumero2);
									while($resultnumero2 = mysqli_fetch_assoc($querynumero2))
									{
										echo("<li>Poste de soins : ".$resultnumero2['lib_num']."</li>\n");	
									}
								?>
							</ul>							
						</div>
						
						<div class="col-lg-3">
							<ul class="list-unstyled">
								<?php 
									// AFFICHAGE DE LA LOCALISATION
									echo "<li>Batiment : ".$resultpresentation['lib_bat']."</li>";
									echo "<li>Porte : ".$resultpresentation['lib_porte']."</li>";
									echo "<li>Etage : ".$resultpresentation['lib_eta']."</li>";
							?>
							</ul>
						</div>	
						
					</div>	<!-- .row -->
				</div>	<!-- .panel-body -->
			</div>	<!-- .panel -->
			
		</div>	<!-- .col-lg-9 -->
	
		<!-- RESULTATS -->
		<div class="col-lg-9">	
		
		<?php
			while($resultresulat = mysqli_fetch_assoc($queryresultat))
			{
		?>		
			<div class="panel panel-primary">	
				<div class="panel-heading">					
					<h4 class="panel-title">
					<?php 
						// AFFICHAGE DE LA CIVILITE + NOM + PRENOM (PERSONNE + LIEU)	
						echo $resultresulat['lib_civ']."&nbsp;".$resultresulat['nom_ab']."&nbsp;".$resultresulat['prenom_personne'];
					?> </h4>
				</div>
				<div class="panel-body">
					<div class="row">
					
						<div class="col-lg-4">
							<ul class="list-unstyled">
								<?php 
									// REQUETE SQL + AFFICHAGE DU SERVICE 
									$sqlservice2 = "SELECT distinct(lib_ser),num_ser
														FROM annuaire_exploit_abonne,annuaire_exploit_service,annuaire_param_service
														WHERE annuaire_exploit_abonne.id_Eabonne='".$resultresulat['id_Eabonne']."'
														AND annuaire_exploit_service.id_Eabonne='".$resultresulat['id_Eabonne']."'
														AND annuaire_exploit_service.id_Pservice=annuaire_param_service.id_Pservice
														ORDER BY lib_ser
														";
									$queryservice2 = mysqli_query($connectBdd,$sqlservice2);
									while($resultservice2 = mysqli_fetch_assoc($queryservice2))
									{
										echo "<li>".$resultservice2['lib_ser']."&nbsp;(".$resultservice2['num_ser'].")</li>";
									}
									
									// AFFICHAGE DE LA FONCTION 
									echo "<li>".$resultresulat['lib_fonc']."</li>";
									
									// AFFICHAGE DE LA LOCALISATION 
									echo "<li>Bâtiment : ".$resultresulat['lib_bat']."</li>";
									echo "<li>Etage : ".$resultresulat['lib_eta']."</li>";
									echo "<li>Porte : ".$resultresulat['lib_porte']."</li>";
								?>								
							</ul>
						</div>
						
						<div class="col-lg-4">							
							<ul class="list-unstyled">							
								<?php
									// REQUETE SQL + AFFICHAGE DES NUMEROS 
									$sqlnumero = "SELECT * FROM annuaire_exploit_abonne,annuaire_exploit_numero
															WHERE annuaire_exploit_abonne.id_Eabonne='".$resultresulat['id_Eabonne']."'
															AND annuaire_exploit_numero.id_Eabonne='".$resultresulat['id_Eabonne']."'
															ORDER BY ordre_num
															";
									$querynumero = mysqli_query($connectBdd,$sqlnumero);
									while($resultnumero = mysqli_fetch_assoc($querynumero))
									{
										echo "<li>".$resultnumero['lib_num']."</li>";
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
									//echo $resultresulat['photo_personne'];
									// if(!empty($resultresulat['photo_personne']))
									// {
										// echo $resultresulat['photo_personne'];
									// }
									// else
									// {
								?>
								<img src="../doc_img/image.jpeg" alt="photo"></center></div></li>
								<?php //} ?>
								<!-- LIEN MODIFICATION -->
								<li><div><a href="modif_connexion.php"><center><span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifier les coordonnées&nbsp;</center></a></div></li>
							</ul>
						</div>
						
					</div>	<!-- .row -->
				</div>	<!-- .panel-body -->
			</div>	<!-- .panel -->
			<?php } ?>
			
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
		<a href="#haut"><center><span class="glyphicon glyphicon-arrow-up" style="font-size:25px;"></span></center></a>
	</footer>

	<?php
		// DECONNEXION A LA BASE DE DONNEES
		include('../connexion/deconnexionBdd.php');
	?>	
	
</div>	<!-- .container -->

<!-- DECLARATION JAVASCRIPT -->
<script src="../outils/bootstrap/js/jquery.js"></script>
<script src="../outils/bootstrap/js/bootstrap.js"></script>
	
</body>

</html>