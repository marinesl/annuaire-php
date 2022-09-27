<?php 
	// AFFICHAGE DES MESSAGES D'ERREUR
	echo "<font color=\"red\">".$_SESSION['LIEU_erreur_ko']."</font><br>";
	echo "<font color=\"green\">".$_SESSION['LIEU_erreur_ok']."</font><br>";
	echo "<br>";
?>

<!-- FORMULAIRE AJOUT D'UN LIEU -->
<form class="form-horizontal col-lg-offset-1" name="formAbonne" method="post" action="admin_interface/gestion_creer_lieu_gestion.php">								
	<div class="form-group">
	
		<!-- CHAMPS CACHES CONTENANT L'ID ET LA VARIABLE PANNEAU -->
		<input type="hidden" name="lieu_id" value="<?php echo $_SESSION['LIEU_id']; ?>">
		<input type="hidden" name="lieu_panel" id="lieu_panel" value="<?php echo $_SESSION['LIEU_panel']; ?>">
		<?php $_SESSION['LIEU_panel'] = ""; ?>
	
	<?php
		// REQUETE D'AFFICHAGE DES INFOS DU LIEU AJOUTE
		$sql = "SELECT * 
				FROM annuaire_php_exploit_abonne
				WHERE id_Eabonne='".$_SESSION['LIEU_id']."'";
		$query = $connectBdd->prepare($sql);
		$query->execute();
		$result = ($query->rowCount() === 0) ? 0 : $query->fetchAll();

		if ($result !== 0) {
			for ($i = 0 ; $i < count($result) ; $i++) {
	?>
				<div class="row">
					<label class="col-lg-3">Nom<font color="red">*</font></label>
					<input type="text" name="nom" class="col-lg-3" value="<?php echo $result[$i]['nom_ab']; ?>">(<u>ex</u> : <font color="red">SALLE A MANGER</font>)
				</div>

				<br>
				
				<div class="row">
					<div class="col-lg-10">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h5 class="panel-title">Service</h5>
							</div>
							<div class="panel-body">
								<select name="service">
									<option></option>
									<?php
										// REQUETE SQL + AFFICHAGE DES SERVICES
										$sqlSer1 = "SELECT * FROM annuaire_php_param_service WHERE actif_ser=1 ORDER BY lib_ser";
										$querySer1 = $connectBdd->prepare($sqlSer1);
										$querySer1->execute();
										$resultSer1 = ($querySer1->rowCount() === 0) ? 0 : $querySer1->fetchAll();

										if ($resultSer1 !== 0) {
											for ($j = 0 ; $j < count($resultSer1) ; $j++) {
												echo("<option value=\"".$resultSer1[$j]['id_Pservice']."\">".$resultSer1[$j]["lib_ser"]." (".$resultSer1[$j]["num_ser"].")</option>\n");
											}
										}
									?>
								</select>
								<button type="submit" class="btn btn-primary" name="boutonajouter" value="service">Ajouter</button>
								
								<!-- TABLEAU AFFICHAGE DES SERVICES -->
								<table class="table table-striped table-condensed">
									<thead>
										<tr>
											<th>Service</th>
											<th><center>Supprimer</center></th>
										</tr>
									</thead>
									<tbody>
										<?php
											// REQUETE SQL DES SERVICES AJOUTES	
											$sqlSer2 = "SELECT * 
														FROM annuaire_php_exploit_service,annuaire_php_param_service,annuaire_php_exploit_abonne
														WHERE annuaire_php_exploit_service.id_Eabonne=annuaire_php_exploit_abonne.id_Eabonne
														AND annuaire_php_exploit_abonne.id_Eabonne='".$result[$i]['id_Eabonne']."'
														AND annuaire_php_exploit_service.id_Pservice=annuaire_php_param_service.id_Pservice
														AND actif_Eser=1";
											$querySer2 = $connectBdd->prepare($sqlSer2);
											$querySer2->execute();
											$resultSer2 = ($querySer2->rowCount() === 0) ? 0 : $querySer2->fetchAll();

											if ($resultSer2 !== 0) {
												for ($j = 0 ; $j < count($resultSer2) ; $j++) {
													echo "<tr>\n";
													echo "<td>\n";
													echo $resultSer2[$j]['lib_ser'];
													echo "</td>\n";
													echo "<td>\n";
													echo "<center><button class=\"btn btn-default\" type=\"submit\" name=\"boutonsupprimerS\" value=\"".$resultSer2[$j]['id_Eservice']."\"><i class=\"fa-solid fa-trash\"></i></button></center>";
													echo "</td>\n";
													echo "</tr>\n";
												}
											}
										?>
									</tbody>
								</table>
								
							</div>	<!-- .panel-body -->
						</div>	<!-- .panel panel-primary -->
					</div>	<!-- .col-lg-10 -->
				</div>	<!-- .row -->
				
				<br>
				
				<div class="row">
					<div class="col-lg-10">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h5 class="panel-title">Contact</h5>
							</div>
							<div class="panel-body">
								<select name="communication">
									<option></option>
									<?php
										// REQUETE SQL + AFFICHAGES DES COMMUNICATIONS
										$sqlCom1 = "SELECT * FROM annuaire_php_param_communication WHERE actif_com=1 ORDER BY lib_com";
										$queryCom1 = $connectBdd->prepare($sqlCom1);
										$queryCom1->execute();
										$resultCom1 = ($queryCom1->rowCount() === 0) ? 0 : $queryCom1->fetchAll();

										if ($resultCom1 !== 0) {
											for ($j = 0 ; $j < count($resultCom1) ; $j++) {
												echo("<option value=\"".$resultCom1[$j]['id_Pcommunication']."\">".$resultCom1[$j]["lib_com"]."</option>\n");
											}
										}
									?>
								</select>
								<input name="numero" type="text">
								<button type="submit" class="btn btn-primary" name="boutonajouter" value="numero">Ajouter</button>
								
								<!-- TABLEAU AFFICHAGE DES COMMUNICATIONS -->
								<table class="table table-striped table-condensed">
									<thead>
										<tr>
											<th>Type</th>
											<th>Numéro</th>
											<th><center>Supprimer</center></th>
										</tr>
									</thead>
									<tbody>
										<?php
											// REQUETE SQL DES COMMUNICATIONS AJOUTEES
											$sqlCom2 = "SELECT * 
														FROM annuaire_php_exploit_abonne,annuaire_php_exploit_numero,annuaire_php_param_communication
														WHERE annuaire_php_exploit_abonne.id_Eabonne='".$result[$i]['id_Eabonne']."'
														AND annuaire_php_exploit_numero.id_Eabonne=annuaire_php_exploit_abonne.id_Eabonne
														AND annuaire_php_exploit_numero.id_Pcommunication=annuaire_php_param_communication.id_Pcommunication
														AND actif_num=1";
											$queryCom2 = $connectBdd->prepare($sqlCom2);
											$queryCom2->execute();
											$resultCom2 = ($queryCom2->rowCount() === 0) ? 0 : $queryCom2->fetchAll();

											if ($resultCom2 !== 0) {
												for ($j = 0 ; $j < count($resultCom2) ; $j++) {
													echo "<tr>\n";
													echo "<td>\n";
													echo $resultCom2[$j]['lib_com'];
													echo "</td>\n";
													echo "<td>\n";
													echo $resultCom2[$j]['lib_num'];
													echo "</td>\n";
													echo "<td>\n";
													echo "<center><button class=\"btn btn-default\" type=\"submit\" name=\"boutonsupprimerN\" value=\"".$resultCom2[$j]['id_Enumero']."\"><i class=\"fa-solid fa-trash\"></i></button></center>";
													echo "</td>\n";
													echo "</tr>\n";
												}
											}
										?>
									</tbody>
								</table>
								
							</div>	<!-- .panel-body -->
						</div>	<!-- .panel panel-primary -->
					</div>	<!-- .col-lg-10 -->
				</div>	<!-- .row -->
				
				<br>
				
				<div class="row">
					<label class="col-lg-3">Bâtiment</label>
					<select name="batiment">
						<?php 
							// REQUETE SQL AFFICHAGE DU BATIMENT AJOUTE
							$sqlBat2 = "SELECT * 
										FROM annuaire_php_param_batiment,annuaire_php_param_localisation,annuaire_php_exploit_abonne
										WHERE annuaire_php_exploit_abonne.id_Eabonne='".$result[$i]['id_Eabonne']."'
										AND annuaire_php_exploit_abonne.id_Plocalisation=annuaire_php_param_localisation.id_Plocalisation
										AND annuaire_php_param_localisation.id_Pbatiment=annuaire_php_param_batiment.id_Pbatiment";
							$queryBat2 = $connectBdd->prepare($sqlBat2);
							$queryBat2->execute();
							$resultBat2 = ($queryBat2->rowCount() === 0) ? 0 : $queryBat2->fetchAll();

							if ($resultBat2 !== 0) {
								for ($j = 0 ; $j < count($resultBat2) ; $j++) {
									echo "<option>".$resultBat2[$j]['lib_bat']."</option>"; 
								}
							}
						?>
						<option></option>
						<?php
							// REQUETE SQL + AFFICHAGE DES BATIMENTS
							$sqlBat1 = "SELECT * FROM annuaire_php_param_batiment WHERE actif_bat=1 ORDER BY lib_bat";
							$queryBat1 = $connectBdd->prepare($sqlBat1);
							$queryBat1->execute();
							$resultBat1 = ($queryBat1->rowCount() === 0) ? 0 : $queryBat1->fetchAll();

							if ($resultBat1 !== 0) {
								for ($j = 0 ; $j < count($resultBat1) ; $j++) {
									echo("<option value=\"".$resultBat1[$j]['id_Pbatiment']."\">".$resultBat1[$j]["lib_bat"]."</option>\n");
								}
							}
						?>
					</select>
				</div>
				
				<div class="row">
					<label class="col-lg-3">Etage</label>
					<select name="etage">
						<?php 
							// REQUETE SQL AFFICHAGE DE L'ETAGE AJOUTE
							$sqlEta2 = "SELECT * 
										FROM annuaire_php_param_localisation,annuaire_php_param_etage,annuaire_php_exploit_abonne
										WHERE annuaire_php_exploit_abonne.id_Eabonne='".$result[$i]['id_Eabonne']."'
										AND annuaire_php_exploit_abonne.id_Plocalisation=annuaire_php_param_localisation.id_Plocalisation
										AND annuaire_php_param_localisation.id_Petage=annuaire_php_param_etage.id_Petage";

							$queryEta2 = $connectBdd->prepare($sqlEta2);
							$queryEta2->execute();
							$resultEta2 = ($queryEta2->rowCount() === 0) ? 0 : $queryEta2->fetchAll();

							if ($resultEta2 !== 0) {
								for ($j = 0 ; $j < count($resultEta2) ; $j++) {
									echo "<option>".$resultEta2[$j]['lib_eta']."</option>"; 
								}
							}
						?>
						<option></option>
						<?php
							// REQUETE SQL + AFFICHAGE DES ETAGES
							$sqlEta1 = "SELECT * FROM annuaire_php_param_etage WHERE actif_eta=1 ORDER BY lib_eta";
							$queryEta1 = $connectBdd->prepare($sqlEta1);
							$queryEta1->execute();
							$resultEta1 = ($queryEta1->rowCount() === 0) ? 0 : $queryEta1->fetchAll();

							if ($resultEta1 !== 0) {
								for ($j = 0 ; $j < count($resultEta1) ; $j++) {
									echo("<option value=\"".$resultEta1[$j]['id_Petage']."\">".$resultEta1[$j]["lib_eta"]."</option>\n");
								}
							}
						?>
					</select>
				</div>
				
				<div class="row">
					<label class="col-lg-3">Porte</label>
					<select name="porte">
						<?php 
							// REQUETE SQL AFFICHAGE DE LA PORTE AJOUTEE
							$sqlPorte2 = "SELECT * 
											FROM annuaire_php_param_localisation,annuaire_php_param_porte,annuaire_php_exploit_abonne
											WHERE annuaire_php_exploit_abonne.id_Eabonne='".$result[$i]['id_Eabonne']."'
											AND annuaire_php_exploit_abonne.id_Plocalisation=annuaire_php_param_localisation.id_Plocalisation
											AND annuaire_php_param_localisation.id_Pporte=annuaire_php_param_porte.id_Pporte";
							$queryPorte2 = $connectBdd->prepare($sqlPorte2);
							$queryPorte2->execute();
							$resultPorte2 = ($queryPorte2->rowCount() === 0) ? 0 : $queryPorte2->fetchAll();

							if ($resultPorte2 !== 0) {
								for ($j = 0 ; $j < count($resultPorte2) ; $j++) {
									echo "<option>".$resultPorte2[$j]['lib_porte']."</option>"; 
								}
							}
						?>
						<option></option>
						<?php
							// REQUETE SQL + AFFICHAGE DES PORTES
							$sqlPorte1 = "SELECT * FROM annuaire_php_param_porte WHERE actif_porte=1 ORDER BY lib_porte";
							$queryPorte1 = $connectBdd->prepare($sqlPorte1);
							$queryPorte1->execute();
							$resultPorte1 = ($queryPorte1->rowCount() === 0) ? 0 : $queryPorte1->fetchAll();

							if ($resultPorte1 !== 0) {
								for ($j = 0 ; $j < count($resultPorte1) ; $j++) {
									echo("<option value=\"".$resultPorte1[$j]['id_Pporte']."\">".$resultPorte1[$j]["lib_porte"]."</option>\n");
								}
							}
						?>
					</select>
				</div>
			
	<?php
			}
		}
	?>
		
		<div class="pull-right">
			<button type="submit" class="btn btn-primary" name="creer" value="creer"><?php if(empty($_SESSION['LIEU_erreur_ok'])) { echo "Créer";} else { echo "Modifier"; } ?></button>
			<button type="reset" class="btn btn-primary">Effacer</button>
		</div>
	
	</div>	<!-- .form-group -->
</form>

<?php 
	// SUPPRESSION CONTENU VARIABLES ID ET MESSAGE D'ERREUR
	$_SESSION['LIEU_id'] = "";
	$_SESSION['LIEU_erreur_ok'] = "";
	$_SESSION['LIEU_erreur_ko'] = "";
?>