<div class="pull-right">
	<a href="#ajouterug" data-toggle="modal" data-backdrop="false"><i class="fa-solid fa-plus"></i>Ajouter</a>
</div>

<div class="modal" id="ajouterug">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter une unité de gestion</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formUg1" method="post" action="admin_interface/parametrage_ug_ajouter.php">								
					<div class="form-group">
					<div class="row">
							<label class="col-lg-2">Numéro</label>
							<input type="text" name="numero1">&nbsp;&nbsp;
						</div>
						
						<div class="row">
							<label class="col-lg-2">Libellé</label>
							<input type="text" name="libelle1">&nbsp;&nbsp;
						</div>
						
						<div class="row">
							<label class="col-lg-2">Service</label>
							<select name="service1">
								<option></option>
								<?php
									$sqlService1 = "SELECT * FROM annuaire_php_param_service ORDER BY num_ser";
									$queryService1 = $connectBdd->prepare($sqlService1);
									$queryService1->execute();
									$resultService1 = ($queryService1->rowCount() === 0) ? 0 : $queryService1->fetchAll();

									if ($resultService1 !== 0) {
										for ($i = 0 ; $i < count($resultService1) ; $i++) {
											echo "<option value=\"".$resultService1[$i]['id_Pservice']."\">".$resultService1[$i]['num_ser']." - ".$resultService1[$i]['lib_ser']."</option>";
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

<!-- TABLEAU CONTENU TABLE UG -->
<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<!--<th>Id</th>-->
			<th>Num.</th>
			<th><center>Libellé</center></th>
			<th>Service</th>
			<th>Actif</th>
			<th>Créateur</th>
			<th>Modificateur</th>
			<th>Date de création</th>
			<th>Date de modification</th>
			<th>Modifier</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$sqlUg = "SELECT * FROM annuaire_php_param_ug";
			$queryUg = $connectBdd->prepare($sqlUg);
			$queryUg->execute();
			$resultUg = ($queryUg->rowCount() === 0) ? 0 : $queryUg->fetchAll();

			if ($resultUg !== 0) {
				for ($i = 0 ; $i < count($resultUg) ; $i++) {
					echo "<tr>\n";
					// echo "<td>\n";
					// echo $resultUg[$i]['id_Pug'];
					// echo "</td>\n";
					echo "<td>\n";
					echo $resultUg[$i]['num_ug'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUg[$i]['lib_ug'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUg[$i]['id_Pservice'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUg[$i]['actif_ug'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUg[$i]['createur_ug'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUg[$i]['modificateur_ug'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUg[$i]['date_crea_ug'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUg[$i]['date_modif_ug'];
					echo "</td>\n";
					echo "<td>\n";
					echo "<center><a href=\"#ug".$resultUg[$i]['id_Pug']."\" data-toggle=\"modal\" data-backdrop=\"false\"><i class=\"fa-solid fa-pen\"></i></a></center>";
					echo "</td>\n";
					echo "</tr>\n";
			?>
				<!-- FENETRE MODALE MODIFIER -->
				<div class="modal" id="<?php echo "ug".$resultUg[$i]['id_Pug']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Modifier une unité de gestion</h5>
							</div>
							<div class="modal-body">
								<form class="form-horizontal col-lg-offset-1" name="formUg2" method="post" action="admin_interface/parametrage_ug_modifier.php">								
									<div class="form-group">
										<div class="row">
											<label class="col-lg-2">ID</label>
											<input type="hidden" name="id" value="<?php echo $resultUg[$i]['id_Pug']; ?>">
											<?php echo $resultUg[$i]['id_Pug']; ?>
										</div>

										<div class="row">
											<label class="col-lg-2">numéro</label>
											<input type="text" name="numero2" value="<?php echo $resultUg[$i]['num_ug']; ?>">
										</div>
										
										<div class="row">
											<label class="col-lg-2">Service</label>
											<select name="service2">
												<?php
													$sqlService3 = "SELECT * FROM annuaire_php_param_service WHERE id_Pservice='".$resultUg[$i]['id_Pservice']."'";
													$queryService3 = $connectBdd->prepare($sqlService3);
													$queryService3->execute();
													$resultService3 = ($queryService3->rowCount() === 0) ? 0 : $queryService3->fetchAll();

													echo "<option value=\"".$resultService3[0]['id_Pservice']."\">".$resultService3[0]['lib_ser']."</option>";
												?>
												<option></option>
												<?php
													$sqlService2 = "SELECT * FROM annuaire_php_param_service ORDER BY num_ser";
													$queryService2 = $connectBdd->prepare($sqlService2);
													$queryService2->execute();
													$resultService2 = ($queryService2->rowCount() === 0) ? 0 : $queryService2->fetchAll();

													if ($resultService2 !== 0) {
														for ($j = 0 ; $j < count($resultService2) ; $j++) {
															echo "<option value=\"".$resultService2[$j]['id_Pservice']."\">".$resultService2[$j]['num_ser']." - ".$resultService2[$j]['lib_ser']."</option>";
														}
													}
												?>
											</select>
										</div>
										
										<div class="row">
											<label class="col-lg-2">Libellé</label>
											<input type="text" name="libelle2" value="<?php echo $resultUg[$i]['lib_ug']; ?>">
										</div>
										
										<div class="row">
											<label class="col-lg-2">Actif</label>
											<input type="text" name="actif" value="<?php echo $resultUg[$i]['actif_ug']; ?>">&nbsp;&nbsp;
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