<!DOCTYPE html>

<head>
	<title>Annuaire - Hôpital Necker-Enfants Malades</title>
	<meta charset="utf-8"> <!-- Encoding / Encode UTF-8 without BOM -->
	
	<!-- DECLARATION BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">
	
    <style type="text/css">
		body {
			padding-top : 100px;
		}
		
		section {
			padding-top : 100px;
		}
		label {
			font-size : 20px;
		}
	</style>
</head>

<body>

<!-- CONTAINER -->
<div class="container">

	<!-- HEADER -->
	<header>
		<h1><center>Connexion</center></h1>
	</header>
	
	<!-- SECTION -->
	<section>
		<div class="row">
			<div class="col-lg-offset-4 col-lg-8">
			
				<!-- FORMULAIRE DE CONNEXION -->
				<form class="form-horizontal" name="cxPhoto" method="post" action="modif_identification.php">
					<div class="form-group">
						<div class="row">
							<label class="col-lg-3">APH</label>
							<input type="text" name="user" class="col-lg-3">
						</div>
						
						<br><br><br>
						
						<div class="row">
							<label class="col-lg-3">Mot de passe</label>
							<input type="password" name="motdepasse" class="col-lg-3">
						</div>
						
						<br><br>
						
						<div class="row">
							<button type="submit" class="btn btn-primary col-lg-offset-4">Connexion</button>
						</div>
					</div>
					
					<!-- AFFICHAGE DU MESSAGE D'ERREUR -->
					<?php
						if($_SESSION['ANNUAIRE_MODIF_identification'] == 2)
						{
					?>
						<div class="row">
							<br><br><font color="red"><b>Votre identifiant et/ou votre mot de passe est incorrect.<br>
							Vérifiez que votre clavier n'est pas en mode MAJUSCULE.</b></font>
						</div>
					<?php
						}
						if($_SESSION['ANNUAIRE_MODIF_identification'] == 4)
						{
					?>
						<div class="row">
							<br><br><font color="red"><b>Votre fiche n'existe pas.</b></font><br>
							<a href="#">Créer ma fiche</a>
						</div>
					<?php
						}
						if($_SESSION['ANNUAIRE_MODIF_identification'] == 3)
						{
					?>
						<div class="row">
							<br><br><font color="red"><b>Il y a une erreur dans votre fiche.<br>
							Veuillez contacter le standard : 11.</b></font>
						</div>
					<?php
						}
					?>
				</form>
			
			</div>	<!-- .col-lg-offset-4 col-lg-8 -->
		</div>	<!-- .row -->
	</section>
	
	<!-- DECLARATION JAVASRCRIPT -->
	<script src="../outils/bootstrap/js/jquery.js"></script>
	<script src="../outils/bootstrap/js/bootstrap.js"></script>

</div>	<!-- .container -->

</body>

</html>