<?php
	session_start();
	// CONNEXION A LA BASE DE DONNEES
	include('../connexion/connexionBdd.php');
?>

<!DOCTYPE html>

<head>
	<title>Annuaire - Hôpital Necker-Enfants Malades</title>
	<meta charset="utf-8"> <!-- Encoding / Encode UTF-8 without BOM -->
	
	<!-- DECLARATION BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">
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