<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Annuaire PHP - Notice téléphone</title>

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
					<li class="active"><a href="notice_telephone.php">Notice téléphone</a></li>
					<li><a href="numeros_abreges.php">Numéros abrégés</a></li>
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
						<h1 class="panel-title"><b><center>Mode d'emploi du téléphone en interne</center></b></h1>
					</div>
					<div class="panel-body">
						<center><b><font color="red">Soyez très économe, en particulier pour les appels vers les portables. Les communications coûtent très cher. Pour les appels et télécopies intérieurs, ne composez que les 5 chiffres du poste concerné.</font></b></center>
						<br><br><b>Ligne extérieure :</b> Composez le 0 puis le numéro de votre correspondant.
						<br><br><b>Postes intérieurs :</b> Tous les postes sont joignables de l'intérieur en composant les 5 derniers chiffres. Par contre, les postes débutant par 00000, 00000, 00000 sont des postes uniquement intérieurs (pour les joindre à partir de l'extérieur, il faut passer par le standard 00 00 00 00 00).
						<br><br><b>Postes joignables de l'extérieur :</b> Seuls les postes débutant par 00000, 00000, 00000 sont obtenus directement de l'extérieur en composant 00 00 00 00 00 devant.
						<br><u>Exemple :</u> 00000 => 00 00 00 00 00.
						<br><br><b>Postes joignables de l'extérieur :</b>
						<ul class="list-unstyled">
							<li>de 00000 à 00000 => 00 00 00 00 00</li>
							<li>de 00000 à 00000 => 00 00 00 00 00</li>
							<li>de 00000 à 00000 => 00 00 00 00 00</li>
							<li>de 00000 à 00000 => 00 00 00 00 00</li>
							<li>de 00000 à 00000 => 00 00 00 00 00</li>
						</ul>
						<b>Postes débutant par un 8 :</b> Devant ces postes, il faut ajouter le préfixe 00 00 00 00 00 si l'on souhaite les joindre depuis l'extérieur.
						<br><br><b>Numéros abrégés :</b> Pour contacter le standard d'un autre hôpital ou service général de l'AP-HP - voire certains autres hôpitaux ou administrations -, composez seulement les 4 chiffres des numéros abrégés.
						<br><u>Exemple :</u> Siège de l'AP-HP => 0000
						<br><br>Reportez vous à la liste de l'ensemble des numéros abrégés en cliquant sur le lien du menu ci-dessus ou directement <a href="numeros_abreges.php">ici</a>.
						<br><br><b>DECT :</b> La particularité des DECT est signalée en rouge avec un astérisque.
						<br><br><b>Fax/télécopie :</b> Composez seulement les 5 chiffres du poste pour faxer à l'intérieur de l'hôpital.
						<br><br><b>Rappel automatique :</b> Sur poste intérieur occupé, composez le 61 (sauf pour les télécopieurs).
						<br><br><b>Renvoi d'appel :</b> Composez le 00 et le numéro du poste destinataire si vous souhaitez que vos appels soient transférés en votre absence.
						<br>Composez le 53 pour annuler.
						<br><br><b>Important : Surtout ne jamais annuler un renvoi de poste si vous utilisez un autre poste que le vôtre. Sachez que toutes les communications sont toujours possibles sans annulation du renvoi.</b>
						<br><br><b>Rendez-vous :</b> Pour vous remémorer un rendez-vous important, il vous suffit de composer le 40 suivi de l'heure de rappel (2 chiffres pour l'heure et 2 chiffres pour les minutes).
						<br>Pour annuler, composer le 00 00.
						<br><u>Exemple :</u> En composant le 00 1245, votre poste sonnera à 12h45.
						<br><br><b>Pour biper le SAMU :</b> Composez le 00 suivi des 3 chiffres du bip puis composez le numéro du poste demandeur (le votre par exemple), attendre une tonalité occupée, puis raccrochez.
						<br><br><b>Transfert d'appel :</b> Pour transférer un appel extérieur sur un autre poste, veuillez composer le R ou le 2 ou double appel (selon le poste téléphonique dont vous disposez) suivi du poste destinataire à 5 chiffres.
						<br>En cas de non réponse, veuillez composer à nouveau R ou 2 ou double appel pour reprendre votre correspondant.
						<br><br><b>Alphapage :</b> Composez l'abrégé 0000 (ce qui correspond au 00 00 00 00 00), veuillez communiquer votre numéro d'alphapage et une opératrice vous guidera.
						<br><br><b>Journal téléphoné "AP-HP Infos" :</b> Composez le numéro abrégé 0000. Si vous disposez d'un poste téléphonique numérique, composez le 00 pour avoir la possibilité de sélectionner des rubriques dans le menu proposé (touches * et chiffres).
					</div>
					<div class="panel-footer">
						<center><b>Pour toute autre prestation concernant le téléphone, veuillez vous informer auprès des services techniques au poste 00000.</b></center>
					</div>
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