<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajouterua" data-toggle="modal" data-backdrop="false"><i class="fa-solid fa-plus"></i>Ajouter</a>
</div>

<!-- FENETRE MODALE -->
<div class="modal" id="ajouterua">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter une unité administrative</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formUa1" method="post" action="admin_interface/parametrage_ua_ajouter.php">								
					<div class="form-group">
						<div class="row">
							<label class="col-lg-2">Numéro</label>
							<input type="text" name="numero1">
						</div>
					
						<div class="row">
							<label class="col-lg-2">Libellé</label>
							<input type="text" name="libelle1">
						</div>
						
						<div class="row">
							<label class="col-lg-2">UG</label>
							<select name="ug1">
								<option></option>
								<?php
									$sqlUg1 = "SELECT * FROM annuaire_php_param_ug ORDER BY lib_ug";
									$queryUg1 = $connectBdd->prepare($sqlUg1);
									$queryUg1->execute();
									$resultUg1 = ($queryUg1->rowCount() === 0) ? 0 : $queryUg1->fetchAll();

									if ($resultUg1 !== 0) {
										for ($i = 0 ; $i < count($resultUg1) ; $i++) {
											echo "<option value=\"".$resultUg1[$i]['id_Pug']."\">".$resultUg1[$i]['lib_ug']."</option>";
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

<!-- TABLEAU CONTENU TABLE -->
<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<!--<th>Id</th>-->
			<th>Numéro</th>
			<th>Libellé</th>
			<th>UG</th>
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
			$sqlUa = "SELECT * FROM annuaire_php_param_ua";
			$queryUa = $connectBdd->prepare($sqlUa);
			$queryUa->execute();
			$resultUa = ($queryUa->rowCount() === 0) ? 0 : $queryUa->fetchAll();

			if ($resultUa !== 0) {
				for ($i = 0 ; $i < count($resultUa) ; $i++) {
					echo "<tr>\n";
					// echo "<td>\n";
					// echo $resultUa[$i]['id_Pua'];
					// echo "</td>\n";
					echo "<td>\n";
					echo $resultUa[$i]['num_ua'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUa[$i]['lib_ua'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUa[$i]['id_Pug'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUa[$i]['actif_ua'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUa[$i]['createur_ua'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUa[$i]['modificateur_ua'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUa[$i]['date_crea_ua'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUa[$i]['date_modif_ua'];
					echo "</td>\n";
					echo "<td>\n";
					echo "<center><a href=\"#ua".$resultUa[$i]['id_Pua']."\" data-toggle=\"modal\" data-backdrop=\"false\"><i class=\"fa-solid fa-pen\"></i></a></center>";
					echo "</td>\n";
					echo "</tr>\n";
			?>
				<!-- FENETRE MODALE MODIFIER -->
				<div class="modal" id="<?php echo "ua".$resultUa[$i]['id_Pua']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Modifier une unité administrative</h5>
							</div>
							<div class="modal-body">
								<form class="form-horizontal col-lg-offset-1" name="formUa2" method="post" action="admin_interface/parametrage_ua_modifier.php">								
									<div class="form-group">
										<div class="row">
											<label class="col-lg-2">ID</label>
											<input type="hidden" name="id" value="<?php echo $resultUa[$i]['id_Pua']; ?>">
											<?php echo $resultUa[$i]['id_Pua']; ?>
										</div>
										
										<div class="row">
											<label class="col-lg-2">Numéro</label>
											<input type="text" name="numero2" value="<?php echo $resultUa[$i]['num_ua']; ?>">
										</div>
									
										<div class="row">
											<label class="col-lg-2">Libellé</label>
											<input type="text" name="libelle2" value="<?php echo $resultUa[$i]['lib_ua']; ?>">
										</div>
										
										<div class="row">
											<label class="col-lg-2">UG</label>
											<select name="ug2">
												<?php
													$sqlUg3 = "SELECT * FROM annuaire_php_param_ug WHERE id_Pug='".$resultUa[$i]['id_Pug']."'";
													$queryUg3 = $connectBdd->prepare($sqlUg3);
													$queryUg3->execute();
													$resultUg3 = ($queryUg3->rowCount() === 0) ? 0 : $queryUg3->fetchAll();

													echo "<option>".$resultUg3[0]['lib_ug']."</option>";
												?>
												<option></option>
												<?php
													$sqlUg2 = "SELECT * FROM annuaire_php_param_ug ORDER BY lib_ug";
													$queryUg2 = $connectBdd->prepare($sqlUg2);
													$queryUg2->execute();
													$resultUg2 = ($queryUg2->rowCount() === 0) ? 0 : $queryUg2->fetchAll();

													if ($resultUg2 !== 0) {
														for ($j = 0 ; $j < count($resultUg2) ; $j++) {
															echo "<option value=\"".$resultUg2[$j]['id_Pug']."\">".$resultUg2[$j]['lib_ug']."</option>";
														}
													}
												?>
											</select>
										</div>
										
										<div class="row">
											<label class="col-lg-2">Actif</label>
											<input type="text" name="actif" value="<?php echo $resultUa[$i]['actif_ua']; ?>">&nbsp;&nbsp;
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