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
		$query = mysqli_query($connectBdd, "SELECT * FROM annuaire_exploit_abonne
														WHERE id_Eabonne='".$_SESSION['LIEU_id']."'
														");
		$result = mysqli_fetch_assoc($query);
	?>
		<div class="row">
			<label class="col-lg-3">Nom<font color="red">*</font></label>
			<input type="text" name="nom" class="col-lg-3" value="<?php echo $result['nom_ab']; ?>">&nbsp;&nbsp;(<u>ex</u> : <font color="red">SALLE A MANGER</font>)
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
								$querySer1 = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_service WHERE actif_ser=1 ORDER BY lib_ser");
								while ($resultSer1 = mysqli_fetch_assoc($querySer1))
								{
									echo("<option value=\"".$resultSer1['id_Pservice']."\">".$resultSer1["lib_ser"]." (".$resultSer1["num_ser"].")</option>\n");
								}
							?>
						</select>
						&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary" name="boutonajouter" value="service">Ajouter</button>
						
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
									$querySer2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_exploit_service,annuaire_param_service,annuaire_exploit_abonne
																						WHERE annuaire_exploit_service.id_Eabonne=annuaire_exploit_abonne.id_Eabonne
																						AND annuaire_exploit_abonne.id_Eabonne='".$result['id_Eabonne']."'
																						AND annuaire_exploit_service.id_Pservice=annuaire_param_service.id_Pservice
																						AND actif_Eser=1
																						");
									while($resultSer2 = mysqli_fetch_assoc($querySer2))
									{
										
										echo "<tr>\n";
										echo "<td>\n";
										echo $resultSer2['lib_ser'];
										echo "</td>\n";
										echo "<td>\n";
										echo "<center><button class=\"btn btn-default\" type=\"submit\" name=\"boutonsupprimerS\" value=\"".$resultSer2['id_Eservice']."\"><span class=\"glyphicon glyphicon-remove\"></span></button></center>";
										echo "</td>\n";
										echo "</tr>\n";
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
								$queryCom1 = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_communication WHERE actif_com=1 ORDER BY lib_com");
								while ($resultCom1 = mysqli_fetch_assoc($queryCom1))
								{
									echo("<option value=\"".$resultCom1['id_Pcommunication']."\">".$resultCom1["lib_com"]."</option>\n");
								}
							?>
						</select>
						&nbsp;&nbsp;<input name="numero" type="text">
						&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary" name="boutonajouter" value="numero">Ajouter</button>
						
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
									$queryCom2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_exploit_abonne,annuaire_exploit_numero,annuaire_param_communication
																						WHERE annuaire_exploit_abonne.id_Eabonne='".$result['id_Eabonne']."'
																						AND annuaire_exploit_numero.id_Eabonne=annuaire_exploit_abonne.id_Eabonne
																						AND annuaire_exploit_numero.id_Pcommunication=annuaire_param_communication.id_Pcommunication
																						AND actif_num=1
																						");
									while($resultCom2 = mysqli_fetch_assoc($queryCom2))
									{
										echo "<tr>\n";
										echo "<td>\n";
										echo $resultCom2['lib_com'];
										echo "</td>\n";
										echo "<td>\n";
										echo $resultCom2['lib_num'];
										echo "</td>\n";
										echo "<td>\n";
										echo "<center><button class=\"btn btn-default\" type=\"submit\" name=\"boutonsupprimerN\" value=\"".$resultCom2['id_Enumero']."\"><span class=\"glyphicon glyphicon-remove\"></span></button></center>";
										echo "</td>\n";
										echo "</tr>\n";
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
					$queryBat2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_batiment,annuaire_param_localisation,annuaire_exploit_abonne
																		WHERE annuaire_exploit_abonne.id_Eabonne='".$result['id_Eabonne']."'
																		AND annuaire_exploit_abonne.id_Plocalisation=annuaire_param_localisation.id_Plocalisation
																		AND annuaire_param_localisation.id_Pbatiment=annuaire_param_batiment.id_Pbatiment
																		");
					$resultBat2 = mysqli_fetch_assoc($queryBat2);
					echo "<option>".$resultBat2['lib_bat']."</option>"; 
				?>
				<option></option>
				<?php
					// REQUETE SQL + AFFICHAGE DES BATIMENTS
					$queryBat1 = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_batiment WHERE actif_bat=1 ORDER BY lib_bat");
					while ($resultBat1 = mysqli_fetch_assoc($queryBat1))
					{
						echo("<option value=\"".$resultBat1['id_Pbatiment']."\">".$resultBat1["lib_bat"]."</option>\n");
					}
				?>
			</select>
		</div>
		
		<div class="row">
			<label class="col-lg-3">Etage</label>
			<select name="etage">
				<?php 
					// REQUETE SQL AFFICHAGE DE L'ETAGE AJOUTE
					$queryEta2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_localisation,annuaire_param_etage,annuaire_exploit_abonne
																		WHERE annuaire_exploit_abonne.id_Eabonne='".$result['id_Eabonne']."'
																		AND annuaire_exploit_abonne.id_Plocalisation=annuaire_param_localisation.id_Plocalisation
																		AND annuaire_param_localisation.id_Petage=annuaire_param_etage.id_Petage
																		");
					$resultEta2 = mysqli_fetch_assoc($queryEta2);
					echo "<option>".$resultEta2['lib_eta']."</option>"; 
				?>
				<option></option>
				<?php
					// REQUETE SQL + AFFICHAGE DES ETAGES
					$queryEta1 = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_etage WHERE actif_eta=1 ORDER BY lib_eta");
					while ($resultEta1 = mysqli_fetch_assoc($queryEta1))
					{
						echo("<option value=\"".$resultEta1['id_Petage']."\">".$resultEta1["lib_eta"]."</option>\n");
					}
				?>
			</select>
		</div>
		
		<div class="row">
			<label class="col-lg-3">Porte</label>
			<select name="porte">
				<?php 
					// REQUETE SQL AFFICHAGE DE LA PORTE AJOUTEE
					$queryPorte2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_localisation,annuaire_param_porte,annuaire_exploit_abonne
																		WHERE annuaire_exploit_abonne.id_Eabonne='".$result['id_Eabonne']."'
																		AND annuaire_exploit_abonne.id_Plocalisation=annuaire_param_localisation.id_Plocalisation
																		AND annuaire_param_localisation.id_Pporte=annuaire_param_porte.id_Pporte
																		");
					$resultPorte2 = mysqli_fetch_assoc($queryPorte2);
					echo "<option>".$resultPorte2['lib_porte']."</option>"; 
				?>
				<option></option>
				<?php
					// REQUETE SQL + AFFICHAGE DES PORTES
					$queryPorte1 = mysqli_query($connectBdd,"SELECT * FROM annuaire_param_porte WHERE actif_porte=1 ORDER BY lib_porte");
					while ($resultPorte1 = mysqli_fetch_assoc($queryPorte1))
					{
						echo("<option value=\"".$resultPorte1['id_Pporte']."\">".$resultPorte1["lib_porte"]."</option>\n");
					}
				?>
			</select>
		</div>
		
		<div class="pull-right">
			<button type="submit" class="btn btn-primary" name="creer" value="creer"><?php if(empty($_SESSION['LIEU_erreur_ok'])) { echo "Créer";} else { echo "Modifier"; } ?></button>&nbsp;
			<button type="reset" class="btn btn-primary">Effacer</button>&nbsp;
		</div>
	
	</div>	<!-- .form-group -->
</form>

<?php 
	// SUPPRESSION CONTENU VARIABLES ID ET MESSAGE D'ERREUR
	$_SESSION['LIEU_id'] = "";
	$_SESSION['LIEU_erreur_ok'] = "";
	$_SESSION['LIEU_erreur_ko'] = "";
?>