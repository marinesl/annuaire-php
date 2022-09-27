<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajouterlocalisation" data-toggle="modal" data-backdrop="false"><i class="fa-solid fa-plus"></i>Ajouter</a>
</div>

<!-- FENETRE MODALE AJOUTER -->
<div class="modal" id="ajouterlocalisation">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter une localisation</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formLoc1" method="post" action="admin_interface/parametrage_localisation_ajouter.php">								
					<div class="form-group">
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
											echo "<option>".$resultBat1[$i]['lib_bat']."</option>\n";
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
									$sqlEta1 = "SELECT * FROM annuaire_php_param_etage ORDER BY lib_eta";
									$queryEta1 = $connectBdd->prepare($sqlEta1);
									$queryEta1->execute();
									$resultEta1 = ($queryEta1->rowCount() === 0) ? 0 : $queryEta1->fetchAll();

									if ($resultEta1 !== 0) {
										for ($i = 0 ; $i < count($resultEta1) ; $i++) {
											echo "<option>".$resultEta1[$i]['lib_eta']."</option>\n";
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
									$queryPor1 = $connectBdd->prepare($sqlPorte1);
									$queryPor1->execute();
									$resultPor1 = ($queryPor1->rowCount() === 0) ? 0 : $queryPor1->fetchAll();

									if ($resultPor1 !== 0) {
										for ($i = 0 ; $i < count($resultPor1) ; $i++) {
											echo "<option>".$resultPor1[$i]['lib_porte']."</option>\n";
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

<!-- TABLEAU CONTENU TABLE LOCALISATION -->
<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<!--<th>Id</th>-->
			<th>Bâtiment</th>
			<th>Etage</th>
			<th>Porte</th>
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
			$sqlLoc = "SELECT * 
						FROM annuaire_php_param_localisation,annuaire_php_param_batiment,annuaire_php_param_etage,annuaire_php_param_porte
						WHERE annuaire_php_param_localisation.id_Pbatiment=annuaire_php_param_batiment.id_Pbatiment
						AND annuaire_php_param_localisation.id_Petage=annuaire_php_param_etage.id_Petage
						AND annuaire_php_param_localisation.id_Pporte=annuaire_php_param_porte.id_Pporte";
			$queryLoc = $connectBdd->prepare($sqlLoc);
			$queryLoc->execute();
			$resultLoc = ($queryLoc->rowCount() === 0) ? 0 : $queryLoc->fetchAll();

			if ($resultLoc !== 0) {
				for ($i = 0 ; $i < count($resultLoc) ; $i++) {
					echo "<tr>\n";
					// echo "<td>\n";
					// echo $resultLoc[$i]['id_Plocalisation'];
					// echo "</td>\n";
					echo "<td>\n";
					echo $resultLoc[$i]['lib_bat'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultLoc[$i]['lib_eta'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultLoc[$i]['lib_porte'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultLoc[$i]['actif_loca'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultLoc[$i]['createur_loca'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultLoc[$i]['modificateur_loca'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultLoc[$i]['date_crea_loca'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultLoc[$i]['date_modif_loca'];
					echo "</td>\n";
					echo "<td>\n";
					echo "<center><a href=\"#localisation".$resultLoc[$i]['id_Plocalisation']."\" data-toggle=\"modal\" data-backdrop=\"false\"><i class=\"fa-solid fa-pen\"></i></a></center>";
					echo "</td>\n";
					echo "</tr>\n";
			?>
			<!-- FENETRE MODALE MODIFIER -->
				<div class="modal" id="<?php echo "localisation".$resultLoc[$i]['id_Plocalisation']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Modifier une localisation</h5>
							</div>
							<div class="modal-body">
								<form class="form-horizontal col-lg-offset-1" name="formLoc2" method="post" action="admin_interface/parametrage_localisation_modifier.php">								
									<div class="form-group">
										<div class="row">
											<label class="col-lg-2">ID</label>
											<input type="hidden" name="id" value="<?php echo $resultLoc[$i]['id_Plocalisation']; ?>">
											<?php echo $resultLoc[$i]['id_Plocalisation']; ?>
										</div>
									
										<div class="row">
											<label class="col-lg-2">Bâtiment</label>
											<input type="hidden" name="batiment2" value="<?php echo $resultLoc[$i]['lib_bat']; ?>">
											<?php echo $resultLoc[$i]['lib_bat']; ?>
											<select name="batiment3">
												<option></option>
												<?php
													$sqlBat2 = "SELECT * FROM annuaire_php_param_batiment ORDER BY lib_bat";
													$queryBat2 = $connectBdd->prepare($sqlBat2);
													$queryBat2->execute();
													$resultBat2 = ($queryBat2->rowCount() === 0) ? 0 : $queryBat2->fetchAll();

													if ($resultBat2 !== 0) {
														for ($j = 0 ; $j < count($resultBat2) ; $j++) {
															echo "<option>".$resultBat2[$j]['lib_bat']."</option>";
														}
													}
												?>
											</select>
										</div>
										
										<div class="row">
											<label class="col-lg-2">Etage</label>
											<input type="hidden" name="etage2" value="<?php echo $resultLoc[$i]['lib_eta']; ?>">
											<?php echo $resultLoc[$i]['lib_eta']; ?>
											<select name="etage3">
												<option></option>
												<?php
													$sqlEta2 = "SELECT * FROM annuaire_php_param_etage ORDER BY lib_eta";
													$queryEta2 = $connectBdd->prepare($sqlEta2);
													$queryEta2->execute();
													$resultEta2 = ($queryEta2->rowCount() === 0) ? 0 : $queryEta2->fetchAll();

													if ($resultEta2 !== 0) {
														for ($j = 0 ; $j < count($resultEta2) ; $j++) {
															echo "<option>".$resultEta2[$j]['lib_eta']."</option>";
														}
													}
												?>
											</select>
										</div>
										
										<div class="row">
											<label class="col-lg-2">Porte</label>
											<input type="hidden" name="porte2" value="<?php echo $resultLoc[$i]['lib_porte']; ?>">
											<?php echo $resultLoc[$i]['lib_porte']; ?>
											<select name="porte3">
												<option></option>
												<?php
													$sqlPor2 = "SELECT * FROM annuaire_php_param_porte";
													$queryPor2 = $connectBdd->prepare($sqlPor2);
													$queryPor2->execute();
													$resultPor2 = ($queryPor2->rowCount() === 0) ? 0 : $queryPor2->fetchAll();

													if ($resultPor2 !== 0) {
														for ($j = 0 ; $j < count($resultPor2) ; $j++) {
															echo "<option>".$resultPor2[$j]['lib_porte']."</option>";
														}
													}
												?>
											</select>
										</div>
										
										<div class="row">
											<label class="col-lg-2">Actif</label>
											<input type="text" name="actif" value="<?php echo $resultLoc[$i]['actif_loca']; ?>">&nbsp;&nbsp;
											Activé = 1&nbsp;&nbsp;&nbsp;Désactivé = 0
										</div>
										
										<br>
										
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