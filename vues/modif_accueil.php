<?php
	session_start();
	// CONNEXION A LA BASE DE DONNEES
	include('../connexion/connexionBdd.php');
?>

<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Annuaire - Espace de modification</title>

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

		<h1>Espace de modification</h1>
		
		<div class="row">
		
			<!-- PANNEAU ANCIENNES INFORMATIONS -->
			<div class="col-lg-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Vos informations</h3>
					</div>
					<div class="panel-body">
						<form class="form-horizontal col-lg-offset-1" name="form1" method="post" action="#">
							
						</form>
					</div>	<!-- .panel-body -->
				</div>	<!-- .panel panel-primary -->
			</div>	<!-- .col-lg-6 -->
			
			<!-- PANNEAU NOUVELLES INFORMATIONS -->
			<div class="col-lg-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Vos nouvelles informations</h3>
					</div>
					<div class="panel-body">
						<form class="form-horizontal col-lg-offset-1" name="form2" method="post" action="#">
						</form>
					</div>	<!-- .panel-body -->
				</div>	<!-- .panel panel-primary -->
			</div>	<!-- .col-lg-6 -->
			
		</div>	<!-- .row -->

		<!-- DECLARATION JAVASRCRIPT -->
		<script src="../outils/bootstrap/js/jquery.js"></script>
		<script src="../outils/bootstrap/js/bootstrap.js"></script>

	</div> <!-- .container -->

</body>

</html>