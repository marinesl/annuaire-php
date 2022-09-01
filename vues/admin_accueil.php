<?php 
	session_start();
	// CONNEXION A LA BASE DE DONNEES
	include('../connexion/connexionBdd.php');
?>

<!DOCTYPE html>

<head>
	<title>Annuaire - Espace Administrateur</title>
	<meta charset="utf-8"> 
	
	<!-- DECLARATION BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">
	
	<!-- DECLARATION JAVASCRIPT -->
	<script src="../outils/bootstrap/js/jquery.js"></script>
	<script src="../outils/bootstrap/js/bootstrap.js"></script>
	
	<!-- SCRIPT JQUERY OUVERTURE DES PANNEAUX -->
	<script>
		$(document).ready(function () {
			if($("#personne_panel").val()=="open") {
				$("#test").tab("show");
			}
			
			if($("#lieu_panel").val()=="open") {
				$("#test").tab("show");
				$("#lieu").collapse("show");
				$("#personne").collapse();
			}
		});
	</script>
</head>

<body>

<!-- CONTENEUR -->
<div class="container">

	<!-- HEADER -->
	<header>
		<h1>Espace administrateur</h1>
		<h5><a href="../index.php">Annuaire</a></h5>
	</header>
	
	<!-- SECTION -->
	<section>
		<div class="row">
			<div class="col-lg-2">
			<!-- ONGLETS -->
			<h3><strong>GESTION</strong></h3>
				<ul class="nav nav-pills nav-stacked pull-left">
					<li><a id="test" href="#creerabonne" data-toggle="tab">Créer un abonné</a></li>
					<li><a href="#abonne" data-toggle="tab">Abonné</a></li>
					<h3><strong>PARAMETRAGE</strong></h3>
					<li><a href="#batiment" data-toggle="tab">Bâtiment</a></li>
					<li><a href="#civilite" data-toggle="tab">Civilité</a></li>
					<li><a href="#communication" data-toggle="tab">Communication</a></li>
					<li><a href="#etage" data-toggle="tab">Etage</a></li>
					<li><a href="#fonction" data-toggle="tab">Fonction</a></li>
					<li><a href="#localisation" data-toggle="tab">Localisation</a></li>
					<!--<li><a href="#moteurrecherche" data-toggle="tab">Moteur de recherche</a></li>-->
					<li><a href="#pole" data-toggle="tab">Pôle</a></li>
					<li><a href="#porte" data-toggle="tab">Porte</a></li>
					<li><a href="#service" data-toggle="tab">Service</a></li>
					<li><a href="#ua" data-toggle="tab">UA</a></li>
					<li><a href="#ug" data-toggle="tab">UG</a></li>
					<li><a href="#uh" data-toggle="tab">UH</a></li>
				</ul>
			</div>
			
			<div class="col-lg-10">
				<div class="tab-content">
				
					<!-- CONTENU CREER ABONNE -->
					<div class="tab-pane" id="creerabonne">
						<div class="panel-group" id="monaccordeon">
						
							<!-- FORMULAIRE CREER PERSONNE -->
							<div class="panel panel-primary">
								<div class="panel-heading">
								<h1 class="panel-title">
									<a class="accordion-toggle" data-parent="#monaccordeon" href="#lieu" data-toggle="collapse" style="font-color:white">Lieu</a></li>
								</div>
								</h1>
								<div id="lieu" class="panel-collapse collapse">
									<div class="panel-body">
										<?php include('admin_interface/gestion_creer_lieu.php'); ?>
									</div>
								</div>
							</div>
							
							<!--FORMULAIRE CREER LIEU -->
							<div class="panel panel-primary">
								<div class="panel-heading">
								<h1 class="panel-title">
									<a class="accordion-toggle" data-parent="#monaccordeon" href="#personne" data-toggle="collapse" style="fonct-color:white">Personne</a>
								</h1>
								</div>
								<div id="personne" class="panel-collapse collapse in">
									<div class="panel-body">
										<?php include('admin_interface/gestion_creer_personne.php'); ?>
									</div>
								</div>
							</div>
							
						</div>	<!-- .panel-group -->
					</div>	<!-- .tab-pane -->
					
					<!-- CONTENU ABONNE -->
					<div class="tab-pane" id="abonne">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4>Abonné</h4>
							</div>
							<div class="panel-body">
								<?php include('admin_interface/parametrage_abonne.php'); ?>
							</div>
						</div>
					</div>
					
					<!-- CONTENU BATIMENT -->
					<div class="tab-pane" id="batiment">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4>Bâtiment</h4>
							</div>
							<div class="panel-body">
								<?php include('admin_interface/parametrage_batiment.php'); ?>
							</div>
						</div>
					</div>
					
					<!-- CONTENU CIVILITE -->
					<div class="tab-pane" id="civilite">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4>Civilité</h4>
							</div>
							<div class="panel-body">
								<?php include('admin_interface/parametrage_civilite.php'); ?>
							</div>
						</div>
					</div>
					
					<!-- CONTENU COMMUNICATION -->
					<div class="tab-pane" id="communication">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4>Communication</h4>
							</div>
							<div class="panel-body">
								<?php include('admin_interface/parametrage_communication.php'); ?>
							</div>
						</div>
					</div>
					
					<!-- CONTENU ETAGE -->
					<div class="tab-pane" id="etage">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4>Etage</h4>
							</div>
							<div class="panel-body">
								<?php include('admin_interface/parametrage_etage.php'); ?>
							</div>
						</div>
					</div>
					
					<!-- CONTENU FONCTION -->
					<div class="tab-pane" id="fonction">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4>Fonction</h4>
							</div>
							<div class="panel-body">
								<?php include('admin_interface/parametrage_fonction.php'); ?>
							</div>
						</div>
					</div>
					
					<!-- CONTENU LOCALISATION -->
					<div class="tab-pane" id="localisation">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4>Localisation</h4>
							</div>
							<div class="panel-body">
								<?php include('admin_interface/parametrage_localisation.php'); ?>
							</div>
						</div>
					</div>
					
					<!-- CONTENU MOTEUR DE RECHERCHE -->
					<div class="tab-pane" id="moteurrecherche">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4>Moteur de recherche</h4>
							</div>
							<div class="panel-body">
								<?php include('admin_interface/parametrage_moteur_recherche.php'); ?>
							</div>
						</div>
					</div>
					
					<!-- CONTENU POLE -->
					<div class="tab-pane" id="pole">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4>Pôle</h4>
							</div>
							<div class="panel-body">
								<?php include('admin_interface/parametrage_pole.php'); ?>
							</div>
						</div>
					</div>
					
					<!-- CONTENU PORTE -->
					<div class="tab-pane" id="porte">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4>Porte</h4>
							</div>
							<div class="panel-body">
								<?php include('admin_interface/parametrage_porte.php'); ?>
							</div>
						</div>
					</div>
					
					<!-- CONTENU SERVICE -->
					<div class="tab-pane" id="service">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4>Service</h4>
							</div>
							<div class="panel-body">
								<?php include('admin_interface/parametrage_service.php'); ?>
							</div>
						</div>
					</div>
					
					<!-- CONTENU UA -->
					<div class="tab-pane" id="ua">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4>UA</h4>
							</div>
							<div class="panel-body">
								<?php include('admin_interface/parametrage_ua.php'); ?>
							</div>
						</div>
					</div>
					
					<!-- CONTENU UG -->
					<div class="tab-pane" id="ug">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4>UG</h4>
							</div>
							<div class="panel-body">
								<?php include('admin_interface/parametrage_ug.php'); ?>
							</div>
						</div>
					</div>
					
					<!-- CONTENU UH -->
					<div class="tab-pane" id="uh">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4>UH</h4>
							</div>
							<div class="panel-body">
								<?php include('admin_interface/parametrage_uh.php'); ?>
							</div>
						</div>
					</div>
					
				</div>	<!-- .tab-content -->
			</div>	<!-- .col-lg-9 -->
		</div>	<!-- .row -->
	</section>

</div> <!-- .container -->

</body>

</html>