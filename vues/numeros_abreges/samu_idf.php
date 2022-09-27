<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Annuaire - Samu d'Ile-de-France</title>

	<!-- BOOTSTRAP -->
	<link href="../../outils/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link href="../../outils/fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="../../outils/fontawesome/css/brands.css" rel="stylesheet">
	<link href="../../outils/fontawesome/css/solid.css" rel="stylesheet">
</head>

<body>

	<!-- CONTENEUR -->
	<div class="container">

		<!-- HEADER -->
		<header>
			<!-- BARRE DE NAVIGATION -->
			<nav class="navbar navbar-inverse">
				<div class="navbar-header">
					<a class="navbar-brand" href="../../index.php" id="haut">Annuaire</a>
				</div>
				<ul class="nav navbar-nav navbar-justified">
					<li><a href="../../index.php">Accueil<i class="fa-solid fa-house"></i></a></li>
					<li><a href="../notice_telephone.php">Notice téléphone</a></li>
					<li class="active"><a href="../numeros_abreges.php">Numéros abrégés</a></li>
					<li><a href="../numeros_urgence.php"><strong>Numéros d'urgence</strong></a></li>
					<!-- <li><a href="../../doc_img/aide_utilisation_annumen.pdf"><i class="fa-solid fa-circle-question"></i>Aide</a></li> -->
				</ul>
			</nav>
		</header>

		<!-- SECTION -->
		<section>

		<div class="row">
			<div class="col-lg-offset-1 col-lg-10">
			
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h1 class="panel-title">SAMU d'Ile-de-France</h1>
					</div>
					<div class="panel-body">
						<!-- TABLEAU NUMEROS -->
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Localisation</th>
									<th>Numéros abrégés</th>
									<th>Numéros</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Samu 75 Paris</td>
									<td>0000</td>
									<>00 00 00 00 00>
								</tr>
								<tr>
									<td>Samu 77 Melun</td>
									<td>0000</td>
									<td>00 00 00 00 00</td>
								</tr>
								<tr>
									<td>Samu 78 Versailles</td>
									<td>0000</td>
									<td>00 00 00 00 00</td>
								</tr>
								<tr>
									<td>Samu 91 Corbeil</td>
									<td>0000</td> 
									<td>00 00 00 00 00</td>
								</tr>
								<tr>
									<td>Samu 92 Garches</td> 
									<td>0000</td> 
									<td>00 00 00 00 00</td>
								</tr>
								<tr>
									<td>Samu 93 Bobigny</td> 
									<td>0000</td> 
									<td>00 00 00 00 00</td>
								</tr>
								<tr>
									<td>Samu 94 Créteil</td> 
									<td>0000</td> 
									<td>00 00 00 00 00</td>
								</tr>
								<tr>
									<td>Samu 95 Pontoise</td> 
									<td>0000</td> 
									<td>00 00 00 00 00</td>
								</tr>
							</tbody>
						</table>
						
						<a href="../numeros_abreges.php" class="pull-right">Retour&nbsp;&nbsp;</a>
						
					</div>	<!-- .panel-body -->
				</div>	<!-- .panel panel-primary -->
				
			</div>	<!-- .col-lg-offset-1 col-lg-10 -->
		</div>	<!-- .row -->

		</section>

		<!-- FOOTER -->
		<footer>
			<!-- RETOUR HAUT DE PAGE -->
			<a href="#haut"><center><i class="fa-solid fa-arrow-up"></i></center></a>
		</footer>

	</div> <!-- .container -->

	<!-- DECLARATION JAVASRCRIPT -->
	<script src="../../outils/bootstrap/js/jquery.js"></script>
	<script src="../../outils/bootstrap/js/bootstrap.js"></script>

</body>

</html>