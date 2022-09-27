<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Annuaire - Connexion administrateur</title>

	<!-- BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link href="../outils/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/brands.css" rel="stylesheet">
	<link href="../outils/fontawesome/css/solid.css" rel="stylesheet">

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
			<h1><center>Connexion administrateur</center></h1>
		</header>
		
		<!-- SECTION -->
		<section>
			<div class="row">
				<div class="col-lg-offset-4 col-lg-8">
				
					<!-- FORMULAIRE DE CONNEXION -->
					<form class="form-horizontal" name="cxAdmin" method="post" action="admin_identification.php">
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
							
							<!-- AFFICHAGE DU MESSAGE D'ERREUR -->
							<div>
								<?php
									if (isset($_SESSION['ANNUAIRE_ADMIN_identification']) && $_SESSION['ANNUAIRE_ADMIN_identification'] == 2) {
								?>		
										<div class="row">
											<br><br><font color="red"><b>Votre identifiant et/ou votre mot de passe est incorrect.<br>
											Vérifiez que votre clavier n'est pas en mode MAJUSCULE.</b></font>
										</div>
									
								<?php		
									}
								?>
							</div>
						</div>	<!-- .form-group -->
					</form>
					
				</div>
			</div>	
			
			<br><br>
			
			<div class="row">
				<div class="col-lg-offset-5" style="font-size:20px;">
					<a href="../index.php">Accueil</a>
				</div>
			</div>
			
		</section>
		
		<!-- DECLARATION JAVASRCRIPT -->
		<script src="../outils/bootstrap/js/jquery.js"></script>
		<script src="../outils/bootstrap/js/bootstrap.js"></script>

	</div>	<!-- .container -->

</body>

</html>