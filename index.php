<?php  
	session_start();
	// CONNEXION A LA BASE DE DONNEES
	include("connexion/connexionBdd.php");
?>

<!DOCTYPE html>

<head>
	<title>Annuaire - Hôpital Necker-Enfants Malades</title>
	<meta charset="utf-8"> 
	
	<!-- DECLARATION BOOTSTRAP -->
	<link href="outils/bootstrap/css/bootstrap.css" rel="stylesheet">
</head>

<body>

<!-- CONTENEUR -->
<div class="container">


<!-- HEADER -->
	<header>
	<!-- BARRE DE NAVIGATION -->
	<nav class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="">Annuaire</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
		<ul class="nav navbar-nav">
			<li class="active"><a href="index.php">Accueil&nbsp;<span class="glyphicon glyphicon-home"></span></a></li>
			<li><a href="vues/notice_telephone.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Notice téléphone</a></li>
			<li><a href="vues/numeros_abreges.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numéros abrégés</a></li>
			<li><a href="vues/numeros_urgence.php"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numéros d'urgence&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></a></li>
			<li><a href="doc_img/aide_utilisation_annumen.pdf"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Aide</a></li>
		</ul>
	</nav>
	</header>

	<!-- SECTION -->
	<section>
	
	<h1 id="haut"><center>Bienvenue dans l'annuaire interne <br> de l'Hôpital Necker-Enfants Malades</center></h1>
	
	<div class="row"> 	
		<div class="col-lg-offset-2">	
		
			<div class="panel-group col-lg-10" id="monaccordeon">	
					
					<!-- RECHERCHE LARGE -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2><a class="accordion-toggle" href="#large" data-toggle="collapse" data-parent="#monaccordeon">
							<span class="glyphicon glyphicon-play"></span>&nbsp;Recherche rapide</a></h2>
						</div>
						<div id="large" class="panel-collapse collapse <?php if(($_SESSION['type_rch']=="large") OR (empty($_SESSION['type_rch']))){$_SESSION['type_rch']="";echo "in";}?>">
							<div class="panel-body col-lg-offset-2">
								<?php 
									// AFFICHAGE DU MESSAGE D'ERREUR
									echo "<font color=\"red\">".$_SESSION['rch_large_erreur']."</font><br>";
									$_SESSION['rch_large_erreur'] = "";
								?>
								<!-- FORMULAIRE DE RECHERCHE -->
								<form class="form-inline" name="formRchLarge" method="post" action="vues/resultat_recherche_large.php">
									<input type="text" name="rchLarge">&nbsp;&nbsp;&nbsp;
									<button class="btn btn-primary" type="submit">Rechercher</button>
								</form> 
							</div>	
						</div>
					</div>
					
					<!-- RECHERCHE SERVICE -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2><a class="accordion-toggle" href="#service" data-toggle="collapse" data-parent="#monaccordeon">
							<span class="glyphicon glyphicon-play"></span>&nbsp;Recherche service</a></h2>
						</div>
						<div id="service" class="panel-collapse collapse <?php if($_SESSION['type_rch']=="service"){$_SESSION['type_rch']="";echo "in";}?>">
							<div class="panel-body col-lg-offset-2">
								<?php 
									// AFFICHAGE DU MESSAGE D'ERREUR
									echo "<font color=\"red\">".$_SESSION['rch_service_erreur']."</font><br>"; 
									$_SESSION['rch_service_erreur'] = "";
								?>
								<!-- FORMULAIRE DE RECHERCHE -->
								<form class="form-inline" name="formRchService" method="post" action="vues/resultat_recherche_service.php">
									<input type="text" name="rchService">&nbsp;&nbsp;&nbsp;
									<button class="btn btn-primary" type="submit">Rechercher</button>
								</form> 
							</div>	
						</div>
					</div>
					
					<!-- RECHERCHE AVANCEE -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2><a class="accordion-toggle" href="#avancee" data-toggle="collapse" data-parent="#monaccordeon">
							<span class="glyphicon glyphicon-play"></span>&nbsp;Recherche avancée</a></h2>
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
													$queryCiv = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_civilite WHERE id_Pcivilite > 0");
													while ($resultCiv = mysqli_fetch_assoc($queryCiv))
													{
														echo("<option value=\"".$resultCiv['id_Pcivilite']."\">".$resultCiv['lib_civ']."</option>\n");
													}
												?>										
											</select>
										</div>
										
										<div class="row">
											<label class="col-lg-2">Nom/Salle</label>
											<input type="text" name="nom" class="col-lg-3">&nbsp;&nbsp;
											<input type="radio" name="radionom" value="radionom1">&nbsp;commence par&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="radionom" value="radionom2">&nbsp;contient
										</div>
										
										<div class="row">
											<label class="col-lg-2">Prénom</label>
											<input type="text" name="prenom" class="col-lg-3">&nbsp;&nbsp;
											<input type="radio" name="radioprenom" value="radioprenom1">&nbsp;commence par&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="radioprenom" value="radioprenom2">&nbsp;contient
										</div>
										
										<div class="row">
											<label class="col-lg-2">Service</label>
											<select name="service">
												<option></option>
												<?php
													// REQUETE SQL + AFFICHAGE DES SERVICES
													$querySer = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_service WHERE actif_ser=1 ORDER BY lib_ser");
													while ($resultSer = mysqli_fetch_assoc($querySer))
													{
														echo("<option value=\"".$resultSer['id_Pservice']."\">".$resultSer['lib_ser']." (".$resultSer['num_ser'].")</option>\n");
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
													$queryFonc = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_fonction WHERE id_Pfonction > 0 AND actif_fonc=1");
													while ($resultFonc = mysqli_fetch_assoc($queryFonc))
													{
														echo("<option value=\"".$resultFonc['id_Pfonction']."\">".$resultFonc['lib_fonc']."</option>\n");
													}
												?>
											</select>
										</div>
										
										<div class="row">
											<label class="col-lg-4">Numéro (DECT, fixe, email...)</label>
											<input type="text" name="numero" class="col-lg-4">&nbsp;&nbsp;
											<input type="radio" name="radionumero" value="radionumero1">&nbsp;commence par&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="radionumero" value="radionumero2">&nbsp;contient
										</div>
										
										<br>
										
										<div class="pull-right">
											<button type="submit" class="btn btn-primary">Rechercher</button>&nbsp;
											<button type="reset" class="btn btn-primary">Effacer</button>&nbsp;
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
			<a href="vues/admin_connexion.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Connexion admin.</a>
		</div>
		<!-- RETOUR HAUT DE PAGE -->
		<a href="#haut"><center><span class="glyphicon glyphicon-arrow-up" style="font-size:25px;"></span></center></a>
	</footer>
	
<?php
	// DECONNEXION BASE DE DONNEES
	include('connexion/deconnexionBdd.php');
?>

</div> <!-- .container -->

<!-- DECLARATION JAVASCRIPT -->
<script src="outils/bootstrap/js/jquery.js"></script>
<script src="outils/bootstrap/js/bootstrap.js"></script>

</body>

</html>