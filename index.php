<?php  
	session_start();
	// CONNEXION A LA BASE DE DONNEES
	include("connexion/connexionBdd.php");
?>

<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Annuaire PHP</title>

	<!-- BOOTSTRAP -->
	<link href="outils/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link href="outils/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="outils/fontawesome/css/brands.css" rel="stylesheet">
	<link href="outils/fontawesome/css/solid.css" rel="stylesheet">
</head>

<body>

	<!-- CONTENEUR -->
	<div class="container">


	<!-- HEADER -->
		<header>
			<!-- BARRE DE NAVIGATION -->
			<nav class="navbar navbar-inverse">
				<div class="navbar-header">
					<a class="navbar-brand" href="">Annuaire</a>
				</div>
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php">Accueil<i class="fa-solid fa-house"></i></a></li>
					<li><a href="vues/notice_telephone.php">Notice téléphone</a></li>
					<li><a href="vues/numeros_abreges.php">Numéros abrégés</a></li>
					<li><a href="vues/numeros_urgence.php"><strong>Numéros d'urgence</strong></a></li>
					<!-- <li><a href="doc_img/aide_utilisation_annumen.pdf"><i class="fa-solid fa-circle-question"></i>Aide</a></li> -->
				</ul>
			</nav>
		</header>

		<!-- SECTION -->
		<section>
		
		<h1 id="haut"><center>Bienvenue dans l'annuaire de l'Hôpital</center></h1>
		
		<div class="row"> 	
			<div class="col-lg-offset-2">	
			
				<div class="panel-group col-lg-10" id="monaccordeon">	
						
						<!-- RECHERCHE LARGE -->
						<!--<div class="panel panel-default">
							<div class="panel-heading">
								<h2><a class="accordion-toggle" href="#large" data-toggle="collapse" data-parent="#monaccordeon">
								<i class="fa-solid fa-play"></i>Recherche rapide</a></h2>
							</div>
							<div id="large" class="panel-collapse collapse <?php //if(($_SESSION['type_rch']=="large") OR (empty($_SESSION['type_rch']))){$_SESSION['type_rch']="";echo "in";}?>">
								<div class="panel-body col-lg-offset-2">
									<?php 
										// AFFICHAGE DU MESSAGE D'ERREUR
										// echo "<font color=\"red\">".$_SESSION['rch_large_erreur']."</font><br>";
										// $_SESSION['rch_large_erreur'] = "";
									?>
									<!-- FORMULAIRE DE RECHERCHE -->
									<!--<form class="form-inline" name="formRchLarge" method="post" action="vues/resultat_recherche_large.php">
										<input type="text" name="rchLarge">
										<button class="btn btn-primary" type="submit">Rechercher</button>
									</form> 
								</div>	
							</div>
						</div>-->
						
						<!-- RECHERCHE SERVICE -->
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2><a class="accordion-toggle" href="#service" data-toggle="collapse" data-parent="#monaccordeon">
								<i class="fa-solid fa-play"></i>Recherche service</a></h2>
							</div>
							<div id="service" class="panel-collapse collapse <?php if($_SESSION['type_rch']=="service" OR (empty($_SESSION['type_rch']))){$_SESSION['type_rch']="";echo "in";}?>">
								<div class="panel-body col-lg-offset-2">
									<?php 
										// AFFICHAGE DU MESSAGE D'ERREUR
										echo "<font color=\"red\">".$_SESSION['rch_service_erreur']."</font><br>"; 
										$_SESSION['rch_service_erreur'] = "";
									?>
									<!-- FORMULAIRE DE RECHERCHE -->
									<form class="form-inline" name="formRchService" method="post" action="vues/resultat_recherche_service.php">
										<input type="text" name="rchService">
										<button class="btn btn-primary" type="submit">Rechercher</button>
									</form> 
								</div>	
							</div>
						</div>
						
						<!-- RECHERCHE AVANCEE -->
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2><a class="accordion-toggle" href="#avancee" data-toggle="collapse" data-parent="#monaccordeon">
								<i class="fa-solid fa-play"></i>Recherche avancée</a></h2>
							</div>
							<div id="avancee" class="panel-collapse collapse <?php if($_SESSION['type_rch']=="avancee"){$_SESSION['type_rch']="";echo "in";}?>">
								<div class="panel-body">
									<!-- FORMULAIRE DE RECHERCHE -->
									<form class="form-horizontal col-lg-offset-1" name="formRchAvancee" method="post" action="vues/resultat_recherche_avancee.php">								
										<div class="form-group">
											<?php 
												// AFFICHAGE DE MESSAGE D'ERREUR
												echo "<font color=\"red\"><center>".$_SESSION['rch_avancee_erreur']."</center></font><br>"; 
												$_SESSION['rch_avancee_erreur'] = "";
											?>
											<div class="row">
												<label class="col-lg-2">Civilité</label>
												<select name="civilite">
													<option value=""></option> 
													<?php
														// REQUETE SQL + AFFICHAGE DES CIVILITES
														$sql = "SELECT * FROM annuaire_php_param_civilite WHERE id_Pcivilite > 0";
														$queryCiv = $connectBdd->prepare($sql);
														$queryCiv->execute();
														$resultCiv = ($queryCiv->rowCount() === 0) ? 0 : $queryCiv->fetchAll();

														if ($resultCiv !== 0) {
															for ($i = 0 ; $i < count($resultCiv) ; $i++) {
																echo("<option value=\"".$resultCiv[$i]['id_Pcivilite']."\">".$resultCiv[$i]['lib_civ']."</option>\n");
															}
														}
													?>										
												</select>
											</div>
											
											<div class="row">
												<label class="col-lg-2">Nom/Salle</label>
												<input type="text" name="nom" class="col-lg-3">
												<input type="radio" name="radionom" value="radionom1">commence par<input type="radio" name="radionom" value="radionom2">contient
											</div>
											
											<div class="row">
												<label class="col-lg-2">Prénom</label>
												<input type="text" name="prenom" class="col-lg-3">
												<input type="radio" name="radioprenom" value="radioprenom1">commence par<input type="radio" name="radioprenom" value="radioprenom2">contient
											</div>
											
											<div class="row">
												<label class="col-lg-2">Service</label>
												<select name="service">
													<option></option>
													<?php
														// REQUETE SQL + AFFICHAGE DES SERVICES
														$sql = "SELECT * FROM annuaire_php_param_service WHERE actif_ser=1 ORDER BY lib_ser";
														$querySer = $connectBdd->prepare($sql);
														$querySer->execute();
														$resultSer = ($querySer->rowCount() === 0) ? 0 : $querySer->fetchAll();

														if ($resultSer !== 0) {
															for ($i = 0 ; $i < count($resultSer) ; $i++) {
																echo("<option value=\"".$resultSer[$i]['id_Pservice']."\">".$resultSer[$i]['lib_ser']." (".$resultSer[$i]['num_ser'].")</option>\n");
															}
														}
													?>
												</select>
											</div>
											
											<div class="row">
												<label class="col-lg-2">Fonction</label>
												<select name="fonction">
													<option></option>
													<?php
														// REQUETE SQL + AFFICHAGE DES FONCTIONS
														$sql = "SELECT * FROM annuaire_php_param_fonction WHERE id_Pfonction > 0 AND actif_fonc=1";
														$queryFonc = $connectBdd->prepare($sql);
														$queryFonc->execute();
														$resultFonc = ($queryFonc->rowCount() === 0) ? 0 : $queryFonc->fetchAll();

														if ($resultFonc !== 0) {
															for ($i = 0 ; $i < count($resultFonc) ; $i++) {
																echo("<option value=\"".$resultFonc[$i]['id_Pfonction']."\">".$resultFonc[$i]['lib_fonc']."</option>\n");
															}
														}
													?>
												</select>
											</div>
											
											<div class="row">
												<label class="col-lg-4">Numéro (DECT, fixe, email...)</label>
												<input type="text" name="numero" class="col-lg-4">
												<input type="radio" name="radionumero" value="radionumero1">commence par<input type="radio" name="radionumero" value="radionumero2">contient
											</div>
											
											<br>
											
											<div class="pull-right">
												<button type="submit" class="btn btn-primary">Rechercher</button>
												<button type="reset" class="btn btn-danger">Effacer</button>
											</div>
											
										</div>	<!-- .form-group -->
									</form>
								</div>	<!-- .panel-body -->
							</div>	<!-- .panel-collapse -->
						</div>	<!-- .panel panel-default -->
					
				</div>	<!-- .panel-group -->
						
			</div>	<!-- .col-lg-offset-2 -->
		</div>	<!-- .row -->
			
		</section> 
		
		<!-- FOOTER -->
		<footer>
			<div>
				<!-- CONNEXION ADMINISTRATEUR -->
				<a href="vues/admin_connexion.php"><i class="fa-solid fa-user"></i>Connexion admin.</a>
			</div>
			<!-- RETOUR HAUT DE PAGE -->
			<a href="#haut"><center><i class="fa-solid fa-arrow-up"></i></center></a>
		</footer>
		
	<?php
		// DECONNEXION BASE DE DONNEES
		include('connexion/deconnexionBdd.php');
	?>

	</div> <!-- .container -->

	<!-- JQUERY ET BOOTSTRAP -->
	<script src="outils/bootstrap/js/jquery.js"></script>
	<script src="outils/bootstrap/js/bootstrap.js"></script>

</body>

</html>