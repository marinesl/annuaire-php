<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Annuaire PHP - Numéros abrégés</title>

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
					<li><a href="../index.php" >Accueil<i class="fa-solid fa-house"></i></a></li>
					<li><a href="notice_telephone.php">Notice téléphone</a></li>
					<li class="active"><a href="numeros_abreges.php">Numéros abrégés</a></li>
					<li><a href="numeros_urgence.php"><strong>Numéros d'urgence</strong></a></li>
					<!-- <li><a href="../doc_img/aide_utilisation_annumen.pdf"><i class="fa-solid fa-circle-question"></i>Aide</a></li> -->
				</ul>
			</nav>
		</header>

		<!-- SECTION -->
		<section>
		
		<div class="row">
			<div class="col-lg-offset-1 col-lg-10">
			
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h1 class="panel-title"><a href="numeros_abreges/liste_num_abreges.php"><b><center>Liste des numéros abrégés</center></b></a></h1>
					</div>
					<center><div class="panel-body">
						<ul class="list-unstyled">		
							<li><a href="numeros_abreges/urgences_medicales.php">Urgences médicales</a></li>
							<li><a href="numeros_abreges/samu_idf.php">SAMU d'Ile-de-France</a></li>
							<li><a href="numeros_abreges/hopitaux_aphp.php">Hôpitaux de l'AP-HP</a></li>
							<li><a href="numeros_abreges/etablissements_hors_aphp.php">Etablissements hospitaliers parisiens hors APHP</a></li>
							<li><a href="numeros_abreges/administrations_services_aphp.php">Administrations et services de l'AP-HP</a></li>
							<li><a href="numeros_abreges/documentation_archives.php">Documentation - Archives</a></li>
							<li><a href="numeros_abreges/formations.php">Formations</a></li>
							<li><a href="numeros_abreges/services_divers_numeros_utiles.php">Services divers et numéros utiles</a></li>
						</ul>
					</div></center>
					
					<div class="panel-heading">
						<h5 class="panel-title"><a href="numeros_abreges/hopitaux_region_parisienne.php"><center>Hôpitaux de la région parisienne</center></a></h5>
					</div>
					<div class="panel-body">
						<center><ul class="list-unstyled">
							<li><a href="numeros_abreges/60_oise.php">60 - Oise</a></li>
							<li><a href="numeros_abreges/77_seine_et_marne.php">77 - Seine-et-Marne</a></li>
							<li><a href="numeros_abreges/78_yvelines.php">78 - Yvelines</a></li>
							<li><a href="numeros_abreges/91_essone.php">91 - Essone</a></li>
							<li><a href="numeros_abreges/92_hauts_de_seine.php">92 - Hauts-de-Seine</a></li>
							<li><a href="numeros_abreges/93_seine_saint_denis.php">93 - Seine-Saint-Denis</a></li>
							<li><a href="numeros_abreges/94_val_de_marne.php">94 - Val-de-Marne</a></li>
							<li><a href="numeros_abreges/95_val_d_oise.php">95 - Val d'Oise</a></li>
						</ul></center>
					</div>
					
					<div class="panel-heading">
						<h5 class="panel-title"><a href="numeros_abreges/hopitaux_regionaux_universitaires.php"><center>Hôpitaux régionaux et universitaires</center></a></h5>
					</div>
					<div class="panel-body"></div>
				</div>	<!-- .panel panel-primary -->
			
			</div>	<!-- col-lg-offset-1 col-lg-10 -->
		</div>	<!-- .row -->
		
		</section>

		<!-- FOOTER -->
		<footer>
			<!-- RETOUR HAUT DE PAGE #haut? -->
			<a href="#haut"><center><i class="fa-solid fa-arrow-up"></i></center></a>
		</footer>

		<!-- DECLARATION JAVASRCRIPT -->
		<script src="../outils/bootstrap/js/jquery.js"></script>
		<script src="../outils/bootstrap/js/bootstrap.js"></script>

	</div> <!-- .container -->

</body>

</html>