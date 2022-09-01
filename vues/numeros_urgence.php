<!DOCTYPE html>

<head>
	<title>Annuaire - Hôpital Necker-Enfants Malades</title>
	<meta charset="utf-8">
	
	<!-- DECLARATION BOOTSTRAP -->
	<link href="../outils/bootstrap/css/bootstrap.css" rel="stylesheet">
	
	<style type="text/css">
		#urgence:link, #urgence:visited {
			color : red;
		}
	</style>
</head>

<body>

<!-- CONTENEUR -->
<div class="container">

	<!-- HEADER -->
	<header>
	<!-- BARRE DE NAVIGATION -->
	<nav class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="../index.php" id="haut">Annuaire</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
		<ul class="nav navbar-nav navbar-justified">
			<li><a href="../index.php">Accueil&nbsp;<span class="glyphicon glyphicon-home"></span></a></li>
			<li><a href="notice_telephone.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Notice téléphone</a></li>
			<li><a href="numeros_abreges.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numéros abrégés</a></li>
			<li class="active"><a href="numeros_urgence.php"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numéros d'urgence&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></a></li>
			<li><a href="../doc_img/aide_utilisation_.pdf"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Aide</a></li>
		</ul>
	</nav>
	</header>

	<!-- SECTION -->
	<section>
	
	<div class="row">
		<div class="col-lg-offset-1 col-lg-10">
		
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h1 class="panel-title"><center><b>Les numéros d'urgence</b></center></h1>
				</div>	
				<div class="panel-body">
					<center><h1><font color="red"><u>Sécurité générale anti-malveillance : 8787 </br>
					Sécurité incendie: 3333 </br> 
					<a href="numeros_abreges/urgences_medicales.php" id="urgence">Urgences médicales</a> </br>
					<a href="numeros_abreges/samu_idf.php" id="urgence">SAMU de Paris</a></u></font></h1></center>
				</div>
				
				<div class="panel-heading">
					<h5 class="panel-title"><center>Sécurité générale anti-malveillance</center></h5>
				</div>
				<div class="panel-body">
					Au sein de l'établissement, un service de sécurité générale anti-malveillance veille sur votre sécurité 24H/24 et 7J/7. N'hésitez pas à le solliciter ! 
					<br><br>Avisez ce service de tout vol, toute indélicatesse, toute situation de violence ou d'insécurité, toute présence qui vous paraît suspecte, tout objet abandonné ou inquiétant, ... 
					<br><br>Le service de sécurité anti-malveillance a également en charge la gestion des problèmes de circulation, d'accès et d'autorisation d'entrées. 
					<br><br>En outre, ces personnels sont à votre disposition pour tout renseignement en lmatière de sécurité, de démarches (victimes de vol, d'agressions ou autres) ou de circulation.  
				</div>
				
				<div class="panel-heading">
					<h5 class="panel-title"><center>Sécurité incendie</center></h5>
				</div>
				<div class="panel-body">
					<center>Prévention - Intervention - Assistance - Conseil</center>
					<br><font color="red">N'OUBLIEZ PAS. EN CAS D'INCENDIE DONNER L'ALARME. APPELER LE 3333. </font> 
					<br><br>Avisez nous de tout évènement, incendie, fumée ou odeur suspecte... nous interviendrons. 
					<br><br>Savez-vous que le risque incendie existe aussi à l'hôpital ? 
					<br><br>Savez-vous que 95% des incendies sont évitables ?  
					<br><br>Il est fondamental de rappeler à tous que l'hôpital, de par son activité, génère de nombreux risques. S'il est évident pour tous que nous devons au public des soins de qualité, soyons tous conscients que nous leur devons aussi un environnement sûr.  
					<br><br>Vous pouvez réduire considérablement le risque. Comment ? 
					<br><br>D'abord, en vous informant. Sachez reconnaître le danger et y remédier. Protéger la vie du malade et la vôtre : 
					<ul>
						<li>avant le sinistre, par la prévention et le respect des consignes. </li>
						<li>à l'apparition du sinistre, par action efficace et sans hésitation. </li>
					</ul>
					De plus, demandez à participer à la formation incendie chaque année. C'est un droit, c'est passionnant, c'est aussi un devoir. 
					<br><br>L'organisation de l'initiation à la formation incendie s'effectue pour tout le personnel en deux modules: 
					<ul>
						<li>Module 1 : dans les bâtiments. Formation théorique, prévention générale et prévention personnalisée à votre service (visite du service), bonne méthode pour donner l'alarme, mise en sécurité des patients et des visiteurs, rôle et missions des équipiers de première intervention.</li> 
						<li>Module 2 : sur zone d'évolution à l'extérieur des bâtiments, formation pratique d'extinction sur feux réels. </li>
					</ul>
					Formations sur demande des services. L'intégralité du personnel travaillant sur le site suivra une fois par an ces deux modules, concourant ainsi individuellement et collectivement au fonctionnement de la sécurité de l'hôpital.  
				</div>
			</div>	<!-- .panel panel-primary -->
	
		</div>	<!-- .col-lg-offset-1 col-lg-10 -->
	</div>	<!-- .row -->
	
	</section>

	<!-- FOOTER -->
	<footer>
		<!-- RETOUR HAUT DE PAGE #haut? -->
		<a href="#haut"><center><span class="glyphicon glyphicon-arrow-up" style="font-size:25px;"></span></center></a>
	</footer>

	<!-- DECLARATION JAVASRCRIPT -->
	<script src="../outils/bootstrap/js/jquery.js"></script>
	<script src="../outils/bootstrap/js/bootstrap.js"></script>

</div> <!-- .container -->

</body>

</html>