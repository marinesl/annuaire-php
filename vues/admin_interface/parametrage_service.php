<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajouterservice" data-toggle="modal" data-backdrop="false"><i class="fa-solid fa-plus"></i>Ajouter</a>
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
									$sqlResp1 = "SELECT * 
												FROM annuaire_php_exploit_abonne,annuaire_php_param_civilite,annuaire_php_param_fonction
												WHERE annuaire_php_exploit_abonne.id_Pcivilite=annuaire_php_param_civilite.id_Pcivilite
												AND annuaire_php_exploit_abonne.id_Pfonction=annuaire_php_param_fonction.id_Pfonction
												AND lib_fonc='Responsable'
												ORDER BY nom_ab";
									$queryResp1 = $connectBdd->prepare($sqlResp1);
									$queryResp1->execute();
									$resultResp1 = ($queryResp1->rowCount() === 0) ? 0 : $queryResp1->fetchAll();

									if ($resultResp1 !== 0) {
										for ($i = 0 ; $i < count($resultResp1) ; $i++) {
											echo "<option value=\"".$resultResp1[$i]['id_Eabonne']."\">".$resultResp1[$i]['lib_civ']."&nbsp;".$resultResp1[$i]['nom_ab']."&nbsp;".$resultResp1[$i]['prenom_personne']."</option>";
										}
									}
								?>
							</select>
						</div>
						
						<div class="row">
							<label class="col-lg-2">Pôle</label>
							<select name="pole1">
								<option></option>
								<?php
									$sqlPole1 = "SELECT * FROM annuaire_php_param_pole ORDER BY lib_pole";
									$queryPole1 = $connectBdd->prepare($sqlPole1);
									$queryPole1->execute();
									$resultPole1 = ($queryPole1->rowCount() === 0) ? 0 : $queryPole1->fetchAll();

									if ($resultPole1 !== 0) {
										for ($i = 0 ; $i < count($resultPole1) ; $i++) {
											echo "<option value=\"".$resultPole1[$i]['id_Ppole']."\">".$resultPole1[$i]['lib_pole']."</option>";
										}
									}
								?>
							</select>
						</div>
						
						<div class="row">
							<label class="col-lg-2">Bâtiment</label>
							<select name="batiment1">
								<option></option>
								<?php
									$sqlBat1 = "SELECT * FROM annuaire_php_param_batiment ORDER BY lib_bat";
									$queryBat1 = $connectBdd->prepare($sqlBat1);
									$queryBat1->execute();
									$resultBat1 = ($queryBat1->rowCount() === 0) ? 0 : $queryBat1->fetchAll();

									if ($resultBat1 !== 0) {
										for ($i = 0 ; $i < count($resultBat1) ; $i++) {
											echo "<option value=\"".$resultBat1[$i]['id_Pbatiment']."\">".$resultBat1[$i]['lib_bat']."</option>";
										}
									}
								?>
							</select>
						</div>
						
						<div class="row">
							<label class="col-lg-2">Etage</label>
							<select name="etage1">
								<option></option>
								<?php
									$sqlEtat1 = "SELECT * FROM annuaire_php_param_etage ORDER BY lib_eta";
									$queryEta1 = $connectBdd->prepare($sqlEtat1);
									$queryEta1->execute();
									$resultEta1 = ($queryEta1->rowCount() === 0) ? 0 : $queryEta1->fetchAll();

									if ($resultEta1 !== 0) {
										for ($i = 0 ; $i < count($resultEta1) ; $i++) {
											echo "<option value=\"".$resultEta1[$i]['id_Petage']."\">".$resultEta1[$i]['lib_eta']."</option>";
										}
									}
								?>
							</select>
						</div>
						
						<div class="row">
							<label class="col-lg-2">Porte</label>
							<select name="porte1">
								<option></option>
								<?php
									$sqlPorte1 = "SELECT * FROM annuaire_php_param_porte ORDER BY lib_porte";
									$queryPorte1 = $connectBdd->prepare($sqlPorte1);
									$queryPorte1->execute();
									$resultPorte1 = ($queryPorte1->rowCount() === 0) ? 0 : $queryPorte1->fetchAll();

									if ($resultPorte1 !== 0) {
										for ($i = 0 ; $i < count($resultPorte1) ; $i++) {
											echo "<option value=\"".$resultPorte1[$i]['id_Pporte']."\">".$resultPorte1[$i]['lib_porte']."</option>";
										}
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
			$sqlSer = "SELECT * FROM annuaire_php_param_service";
			$querySer = $connectBdd->prepare($sqlSer);
			$querySer->execute();
			$resultSer = ($querySer->rowCount() === 0) ? 0 : $querySer->fetchAll();

			if ($resultSer !== 0) {
				for ($i = 0 ; $i < count($resultSer) ; $i++) {
					echo "<tr>\n";
					// echo "<td>\n";
					// echo $resultSer[$i]['id_Pservice'];
					// echo "</td>\n";
					echo "<td>\n";
					echo $resultSer[$i]['num_ser'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultSer[$i]['lib_ser'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultSer[$i]['responsable_ser'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultSer[$i]['id_Plocalisation'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultSer[$i]['id_Ppole'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultSer[$i]['synonyme_ser'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultSer[$i]['actif_ser'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultSer[$i]['createur_ser'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultSer[$i]['modificateur_ser'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultSer[$i]['date_crea_ser'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultSer[$i]['date_modif_ser'];
					echo "</td>\n";
					echo "<td>\n";
					echo "<center><a href=\"#service".$resultSer[$i]['id_Pservice']."\" data-toggle=\"modal\" data-backdrop=\"false\"><i class=\"fa-solid fa-pen\"></i></a></center>";
					echo "</td>\n";
					echo "</tr>\n";
			?>
				<!-- FENETRE MODALE MODIFIER -->
				<div class="modal" id="<?php echo "service".$resultSer[$i]['id_Pservice']; ?>">
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
											<input type="hidden" name="id" value="<?php echo $resultSer[$i]['id_Pservice']; ?>">
											<?php echo $resultSer[$i]['id_Pservice']; ?>
										</div>
										
										<div class="row">
											<label class="col-lg-2">Numéro</label>
											<input type="text" name="numero2" value="<?php echo $resultSer[$i]['num_ser']; ?>">
										</div>
									
										<div class="row">
											<label class="col-lg-2">Libellé</label>
											<input class="col-lg-6" type="text" name="libelle2" value="<?php echo $resultSer[$i]['lib_ser']; ?>">
										</div>
										
										<div class="row">
											<label class="col-lg-2">Synonymes</label>&nbsp;
											<textarea name="synonyme2" rows="3" cols="20"><?php echo $resultSer[$i]['synonyme_ser']; ?></textarea>
										</div>
										
										<div class="row">
											<label class="col-lg-3">Responsable</label>
											<input type="hidden" name="responsable2" value="<?php echo $resultSer[$i]['responsable_ser']; ?>">
											<?php echo $resultSer[$i]['responsable_ser']; ?>&nbsp;
										</div>
										
										<div class="row">
											<div class="col-lg-offset-3">
												<select name="responsable3">
													<option></option>
													<?php
														$sqlResp2 = "SELECT * 
																	FROM annuaire_php_exploit_abonne,annuaire_php_param_civilite,annuaire_php_param_fonction
																	WHERE annuaire_php_exploit_abonne.id_Pcivilite=annuaire_php_param_civilite.id_Pcivilite
																	AND annuaire_php_exploit_abonne.id_Pfonction=annuaire_php_param_fonction.id_Pfonction
																	AND lib_fonc='Responsable'
																	ORDER BY nom_ab";
														$queryResp2 = $connectBdd->prepare($sqlResp2);
														$queryResp2->execute();
														$resultResp2 = ($queryResp2->rowCount() === 0) ? 0 : $queryResp2->fetchAll();

														if ($resultResp2 !== 0) {
															for ($j = 0 ; $j < count($resultResp2) ; $j++) {
																echo "<option>".$resultResp2[$j]['id_Eabonne']."</option>";
																echo "<option value=\"".$resultResp2[$j]['id_Eabonne']."\">".$resultResp2[$j]['lib_civ']."&nbsp;".$resultResp2[$j]['nom_ab']."&nbsp;".$resultResp2[$j]['prenom_personne']."</option>";
															}
														}
													?>
												</select>
											</div>
										</div>
										
										<br>
										
										<div class="row">
											<label class="col-lg-2">Pôle</label>
											<?php
												$sqlPole3 = "SELECT * 
															FROM annuaire_php_param_pole
															WHERE annuaire_php_param_pole.id_Ppole='".$resultSer[$i]['id_Ppole']."'";
												$queryPole3 = $connectBdd->prepare($sqlPole3);
												$queryPole3->execute();
												$resultPole3 = ($queryPole3->rowCount() === 0) ? 0 : $queryPole3->fetchAll();
											?>
											<input type="hidden" name="pole2" value="<?php echo $resultPole3[0]['id_Ppole']; ?>">
											<?php echo $resultPole3[0]['lib_pole']; ?>
											<select name="pole3">
												<option></option>
												<?php
													$sqlPole2 = "SELECT * FROM annuaire_php_param_pole ORDER BY lib_pole";
													$queryPole2 = $connectBdd->prepare($sqlPole2);
													$queryPole2->execute();
													$resultPole2 = ($queryPole2->rowCount() === 0) ? 0 : $queryPole2->fetchAll();

													if ($resultPole2 !== 0) {
														for ($j = 0 ; $j < count($resultPole2) ; $j++) {
															echo "<option value=\"".$resultPole2[$j]['id_Ppole']."\">".$resultPole2[$j]['lib_pole']."</option>";
														}
													}
												?>
											</select>
										</div>
										
										<br>
										
										<input type="hidden" name="id_loca" value="<?php echo $resultSer[$i]['id_Plocalisation'] ?>">
										
										<div class="row">
											<label class="col-lg-2">Bâtiment</label>
											<?php
												$sqlBat3 =  "SELECT * 
															FROM annuaire_php_param_batiment,annuaire_php_param_localisation
															WHERE annuaire_php_param_localisation.id_Pbatiment=annuaire_php_param_batiment.id_Pbatiment
															AND annuaire_php_param_localisation.id_Plocalisation='".$resultSer[$i]['id_Plocalisation']."'";
												$queryBat3 = $connectBdd->prepare($sqlBat3);
												$queryBat3->execute();
												$resultBat3 = ($queryBat3->rowCount() === 0) ? 0 : $queryBat3->fetchAll();
											?>
											<input type="hidden" name="batiment2" value="<?php echo $resultBat3[0]['id_Pbatiment']; ?>">
											<?php echo $resultBat3[0]['lib_bat']; ?>
											<select name="batiment3">
												<option></option>
												<?php
													$sqlBat2 = "SELECT * FROM annuaire_php_param_batiment ORDER BY lib_bat";
													$queryBat2 = $connectBdd->prepare($sqlBat2);
													$queryBat2->execute();
													$resultBat2 = ($queryBat2->rowCount() === 0) ? 0 : $queryBat2->fetchAll();

													if ($resultBat2 !== 0) {
														for ($j = 0 ; $j < count($resultBat2) ; $j++) {
															echo "<option value=\"".$resultBat2[$j]['id_Pbatiment']."\">".$resultBat2[$j]['lib_bat']."</option>";
														}
													}
												?>
											</select>
										</div>
										
										<div class="row">
											<label class="col-lg-2">Etage</label>
											<?php
												$sqlEta3 = "SELECT * 
															FROM annuaire_php_param_etage,annuaire_php_param_localisation
															WHERE annuaire_php_param_localisation.id_Petage=annuaire_php_param_etage.id_Petage
															AND annuaire_php_param_localisation.id_Plocalisation='".$resultSer[$i]['id_Plocalisation']."'";
												$queryEta3 = $connectBdd->prepare($sqlEta3);
												$queryEta3->execute();
												$resultEta3 = ($queryEta3->rowCount() === 0) ? 0 : $queryEta3->fetchAll();
											?>
											<input type="hidden" name="etage2" value="<?php echo $resultEta3[0]['id_Petage']; ?>">
											<?php echo $resultEta3[0]['lib_eta']; ?>
											<select name="etage3">
												<option></option>
												<?php
													$sqlEta2 = "SELECT * FROM annuaire_php_param_etage ORDER BY lib_eta";
													$queryEta2 = $connectBdd->prepare($sqlEta2);
													$queryEta2->execute();
													$resultEta2 = ($queryEta2->rowCount() === 0) ? 0 : $queryEta2->fetchAll();

													if ($resultEta2 !== 0) {
														for ($j = 0 ; $j < count($resultEta2) ; $j++) {
															echo "<option value=\"".$resultEta2[$j]['id_Petage']."\">".$resultEta2[$j]['lib_eta']."</option>";
														}
													}
												?>
											</select>
										</div>
										
										<div class="row">
											<label class="col-lg-2">Porte</label>
											<?php
												$sqlPorte3 = "SELECT * 
																FROM annuaire_php_param_porte,annuaire_php_param_localisation
																WHERE annuaire_php_param_localisation.id_Pporte=annuaire_php_param_porte.id_Pporte
																AND annuaire_php_param_localisation.id_Plocalisation='".$resultSer[$i]['id_Plocalisation']."'";
												$queryPorte3 = $connectBdd->prepare($sqlPorte3);
												$queryPorte3->execute();
												$resultPorte3 = ($queryPorte3->rowCount() === 0) ? 0 : $queryPorte3->fetchAll();
											?>
											<input type="hidden" name="porte2" value="<?php echo $resultPorte3[0]['id_Pporte']; ?>">
											<?php echo $resultPorte3[0]['lib_porte']; ?>
											<select name="porte3">
												<option></option>
												<?php
													$sqlPorte2 = "SELECT * FROM annuaire_php_param_porte ORDER BY lib_porte";
													$queryPorte2 = $connectBdd->prepare($sqlPorte2);
													$queryPorte2->execute();
													$resultPorte2 = ($queryPorte2->rowCount() === 0) ? 0 : $queryPorte2->fetchAll();

													if ($resultPorte2 !== 0) {
														for ($j = 0 ; $j < count($resultPorte2) ; $j++) {
															echo "<option value=\"".$resultPorte2[$j]['id_Pporte']."\">".$resultPorte2[$j]['lib_porte']."</option>";
														}
													}
												?>
											</select>
										</div>
										
										<div class="row">
											<label class="col-lg-2">Actif</label>
											<input type="text" name="actif" value="<?php echo $resultSer[$i]['actif_ser']; ?>">&nbsp;&nbsp;
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
			} }
		?>
	</tbody>
</table>