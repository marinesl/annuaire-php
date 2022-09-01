<?php 
	// CONNEXION A LA BASE DE DONNEES
	include('../../connexion/connexionBdd.php');
?>

<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajouterservice" data-toggle="modal" data-backdrop="false"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
</div>

<!-- FENETRE MODALE AJOUTER -->
<div class="modal" id="ajouterservice">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter un service</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formSer1" method="post" action="admin_interface/parametrage_service_ajouter.php">								
					<div class="form-group">
						<div class="row">
							<label class="col-lg-2">Numéro</label>
							<input type="text" name="numero1">&nbsp;&nbsp;
						</div>
						
						<div class="row">
							<label class="col-lg-2">Libellé</label>
							<input type="text" name="libelle1">&nbsp;&nbsp;
							(<u>ex</u> : <font color="red">D</font>irection <font color="red">I</font>nformatique)
						</div>
						
						<div class="row">
							<label class="col-lg-2">Synonymes</label>&nbsp;&nbsp;
							<textarea name="synonyme1" rows="3" cols="20"></textarea>
						</div>
						
						<div class="row">
							<label class="col-lg-3">Responsable</label>
							<select name="responsable1">
								<option></option>
								<?php
									$queryResp1 = mysqli_query($connectBdd, "SELECT * 
																				FROM annuaire_exploit_abonne,annuaire_param_civilite,annuaire_param_fonction
																				WHERE annuaire_exploit_abonne.id_Pcivilite=annuaire_param_civilite.id_Pcivilite
																				AND annuaire_exploit_abonne.id_Pfonction=annuaire_param_fonction.id_Pfonction
																				AND lib_fonc='Responsable'
																				ORDER BY nom_ab
																				");
									while($resultResp1 = mysqli_fetch_assoc($queryResp1))
									{
										echo "<option value=\"".$resultResp1['id_Eabonne']."\">".$resultResp1['lib_civ']."&nbsp;".$resultResp1['nom_ab']."&nbsp;".$resultResp1['prenom_personne']."</option>";
									}
								?>
							</select>
						</div>
						
						<div class="row">
							<label class="col-lg-2">Pôle</label>
							<select name="pole1">
								<option></option>
								<?php
									$queryPole1 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_pole ORDER BY lib_pole");
									while($resultPole1 = mysqli_fetch_assoc($queryPole1))
									{
										echo "<option value=\"".$resultPole1['id_Ppole']."\">".$resultPole1['lib_pole']."</option>";
									}
								?>
							</select>
						</div>
						
						<div class="row">
							<label class="col-lg-2">Bâtiment</label>
							<select name="batiment1">
								<option></option>
								<?php
									$queryBat1 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_batiment ORDER BY lib_bat");
									while($resultBat1 = mysqli_fetch_assoc($queryBat1))
									{
										echo "<option value=\"".$resultBat1['id_Pbatiment']."\">".$resultBat1['lib_bat']."</option>";
									}
								?>
							</select>
						</div>
						
						<div class="row">
							<label class="col-lg-2">Etage</label>
							<select name="etage1">
								<option></option>
								<?php
									$queryEta1 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_etage ORDER BY lib_eta");
									while($resultEta1 = mysqli_fetch_assoc($queryEta1))
									{
										echo "<option value=\"".$resultEta1['id_Petage']."\">".$resultEta1['lib_eta']."</option>";
									}
								?>
							</select>
						</div>
						
						<div class="row">
							<label class="col-lg-2">Porte</label>
							<select name="porte1">
								<option></option>
								<?php
									$queryPorte1 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_porte ORDER BY lib_porte");
									while($resultPorte1 = mysqli_fetch_assoc($queryPorte1))
									{
										echo "<option value=\"".$resultPorte1['id_Pporte']."\">".$resultPorte1['lib_porte']."</option>";
									}
								?>
							</select>
						</div>
						
						<div class="pull-right">
							<button class="btn btn-primary" type="submit">Ajouter</button>&nbsp;
							<button class="btn btn-primary" data-dismiss="modal">Fermer</button>&nbsp;
						</div>
					</div>
				</form>
			</div>
		</div>	<!-- .modal-content -->
	</div>	<!-- .modal-dialog -->
</div>	<!-- .modal -->

<!-- TABLEAU CONTENU TABLE SERVICE -->
<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<!--<th>Id</th>-->
			<th>Num.</th>
			<th>Libellé</th>
			<th>Responsable</th>
			<th>Loc.</th>
			<th>Pôle</th>
			<th>Synonymes</th>
			<th>Actif</th>
			<th>Créateur</th>
			<th>Modif.</th>
			<th>Date de création</th>
			<th>Date de modification</th>
			<th>Modifier</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$querySer = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_service");
			while($resultSer = mysqli_fetch_assoc($querySer))
			{
				echo "<tr>\n";
				// echo "<td>\n";
				// echo $resultSer['id_Pservice'];
				// echo "</td>\n";
				echo "<td>\n";
				echo $resultSer['num_ser'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultSer['lib_ser'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultSer['responsable_ser'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultSer['id_Plocalisation'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultSer['id_Ppole'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultSer['synonyme_ser'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultSer['actif_ser'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultSer['createur_ser'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultSer['modificateur_ser'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultSer['date_crea_ser'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultSer['date_modif_ser'];
				echo "</td>\n";
				echo "<td>\n";
				echo "<center><a href=\"#service".$resultSer['id_Pservice']."\" data-toggle=\"modal\" data-backdrop=\"false\"><span class=\"glyphicon glyphicon-pencil\"></span></a></center>";
				echo "</td>\n";
				echo "</tr>\n";
		?>
			<!-- FENETRE MODALE MODIFIER -->
			<div class="modal" id="<?php echo "service".$resultSer['id_Pservice']; ?>">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Modifier un service</h5>
						</div>
						<div class="modal-body">
							<form class="form-horizontal col-lg-offset-1" name="formSer2" method="post" action="admin_interface/parametrage_service_modifier.php">								
								<div class="form-group">
									<div class="row">
										<label class="col-lg-2">ID</label>
										<input type="hidden" name="id" value="<?php echo $resultSer['id_Pservice']; ?>">
										<?php echo $resultSer['id_Pservice']; ?>
									</div>
									
									<div class="row">
										<label class="col-lg-2">Numéro</label>
										<input type="text" name="numero2" value="<?php echo $resultSer['num_ser']; ?>">
									</div>
								
									<div class="row">
										<label class="col-lg-2">Libellé</label>
										<input class="col-lg-6" type="text" name="libelle2" value="<?php echo $resultSer['lib_ser']; ?>">
									</div>
									
									<div class="row">
										<label class="col-lg-2">Synonymes</label>&nbsp;
										<textarea name="synonyme2" rows="3" cols="20"><?php echo $resultSer['synonyme_ser']; ?></textarea>
									</div>
									
									<div class="row">
										<label class="col-lg-3">Responsable</label>
										<input type="hidden" name="responsable2" value="<?php echo $resultSer['responsable_ser']; ?>">
										<?php echo $resultSer['responsable_ser']; ?>&nbsp;
									</div>
									
									<div class="row">
										<div class="col-lg-offset-3">
											<select name="responsable3">
												<option></option>
												<?php
													$queryResp2 = mysqli_query($connectBdd, "SELECT * 
																								FROM annuaire_exploit_abonne,annuaire_param_civilite,annuaire_param_fonction
																								WHERE annuaire_exploit_abonne.id_Pcivilite=annuaire_param_civilite.id_Pcivilite
																								AND annuaire_exploit_abonne.id_Pfonction=annuaire_param_fonction.id_Pfonction
																								AND lib_fonc='Responsable'
																								ORDER BY nom_ab
																								");
													while($resultResp2 = mysqli_fetch_assoc($queryResp2))
													{
														echo "<option>".$resultResp2['id_Eabonne']."</option>";
														echo "<option value=\"".$resultResp2['id_Eabonne']."\">".$resultResp2['lib_civ']."&nbsp;".$resultResp2['nom_ab']."&nbsp;".$resultResp2['prenom_personne']."</option>";
													}
												?>
											</select>
										</div>
									</div>
									
									<br>
									
									<div class="row">
										<label class="col-lg-2">Pôle</label>
										<?php
											$queryPole3 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_pole
																								WHERE annuaire_param_pole.id_Ppole='".$resultSer['id_Ppole']."'
																								");
											$resultPole3 = mysqli_fetch_assoc($queryPole3);
										?>
										<input type="hidden" name="pole2" value="<?php echo $resultPole3['id_Ppole']; ?>">
										<?php echo $resultPole3['lib_pole']; ?>
										<select name="pole3">
											<option></option>
											<?php
												$queryPole2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_pole ORDER BY lib_pole");
												while($resultPole2 = mysqli_fetch_assoc($queryPole2))
												{
													echo "<option value=\"".$resultPole2['id_Ppole']."\">".$resultPole2['lib_pole']."</option>";
												}
											?>
										</select>
									</div>
									
									<br>
									
									<input type="hidden" name="id_loca" value="<?php echo $resultSer['id_Plocalisation'] ?>">
									
									<div class="row">
										<label class="col-lg-2">Bâtiment</label>
										<?php
											$queryBat3 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_batiment,annuaire_param_localisation
																								WHERE annuaire_param_localisation.id_Pbatiment=annuaire_param_batiment.id_Pbatiment
																								AND annuaire_param_localisation.id_Plocalisation='".$resultSer['id_Plocalisation']."'
																								");
											$resultBat3 = mysqli_fetch_assoc($queryBat3);
										?>
										<input type="hidden" name="batiment2" value="<?php echo $resultBat3['id_Pbatiment']; ?>">
										<?php echo $resultBat3['lib_bat']; ?>
										<select name="batiment3">
											<option></option>
											<?php
												$queryBat2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_batiment ORDER BY lib_bat");
												while($resultBat2 = mysqli_fetch_assoc($queryBat2))
												{
													echo "<option value=\"".$resultBat2['id_Pbatiment']."\">".$resultBat2['lib_bat']."</option>";
												}
											?>
										</select>
									</div>
									
									<div class="row">
										<label class="col-lg-2">Etage</label>
										<?php
											$queryEta3 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_etage,annuaire_param_localisation
																								WHERE annuaire_param_localisation.id_Petage=annuaire_param_etage.id_Petage
																								AND annuaire_param_localisation.id_Plocalisation='".$resultSer['id_Plocalisation']."'
																								");
											$resultEta3 = mysqli_fetch_assoc($queryEta3);
										?>
										<input type="hidden" name="etage2" value="<?php echo $resultEta3['id_Petage']; ?>">
										<?php echo $resultEta3['lib_eta']; ?>
										<select name="etage3">
											<option></option>
											<?php
												$queryEta2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_etage ORDER BY lib_eta");
												while($resultEta2 = mysqli_fetch_assoc($queryEta2))
												{
													echo "<option value=\"".$resultEta2['id_Petage']."\">".$resultEta2['lib_eta']."</option>";
												}
											?>
										</select>
									</div>
									
									<div class="row">
										<label class="col-lg-2">Porte</label>
										<?php
											$queryPorte3 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_porte,annuaire_param_localisation
																								WHERE annuaire_param_localisation.id_Pporte=annuaire_param_porte.id_Pporte
																								AND annuaire_param_localisation.id_Plocalisation='".$resultSer['id_Plocalisation']."'
																								");
											$resultPorte3 = mysqli_fetch_assoc($queryPorte3);
										?>
										<input type="hidden" name="porte2" value="<?php echo $resultPorte3['id_Pporte']; ?>">
										<?php echo $resultPorte3['lib_porte']; ?>
										<select name="porte3">
											<option></option>
											<?php
												$queryPorte2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_porte ORDER BY lib_porte");
												while($resultPorte2 = mysqli_fetch_assoc($queryPorte2))
												{
													echo "<option value=\"".$resultPorte2['id_Pporte']."\">".$resultPorte2['lib_porte']."</option>";
												}
											?>
										</select>
									</div>
									
									<div class="row">
										<label class="col-lg-2">Actif</label>
										<input type="text" name="actif" value="<?php echo $resultSer['actif_ser']; ?>">&nbsp;&nbsp;
										Activé = 1&nbsp;&nbsp;&nbsp;Désactivé = 0
									</div>
									
									<div class="pull-right">
										<button class="btn btn-primary" type="submit">Modifier</button>&nbsp;
										<button class="btn btn-primary" data-dismiss="modal">Fermer</button>&nbsp;
									</div>
								</div>
							</form>
							<br>
						</div>
					</div>	<!-- .modal-content -->
				</div>	<!-- .modal-dialog -->
			</div>	<!-- .modal -->
		<?php
			}
		?>
	</tbody>
</table>