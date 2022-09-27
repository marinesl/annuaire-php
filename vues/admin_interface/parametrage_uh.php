<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajouteruh" data-toggle="modal" data-backdrop="false"><i class="fa-solid fa-plus"></i>Ajouter</a>
</div>

<!-- FENETRE MODALE AJOUTER -->
<div class="modal" id="ajouteruh">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter une unité hospitalière</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formUh1" method="post" action="admin_interface/parametrage_uh_ajouter.php">								
					<div class="form-group">
						<div class="row">
							<label class="col-lg-2">Numéro</label>
							<input type="text" name="numero1">
						</div>
						
						<div class="row">
							<label class="col-lg-2">Libellé</label>
							<input type="text" name="libelle1">&nbsp;&nbsp;
							(<u>ex</u> : <font color="red">HJ2 DIABETOLOGIE D1</font>)
						</div>
						
						<div class="row">
							<label class="col-lg-2">UA</label>
							<select name="ua1">
								<option></option>
								<?php
									$sqlUa1 = "SELECT * FROM annuaire_php_param_ua ORDER BY num_ua";
									$queryUa1 = $connectBdd->prepare($sqlUa1);
									$queryUa1->execute();
									$resultUa1 = ($queryUa1->rowCount() === 0) ? 0 : $queryUa1->fetchAll();

									if ($resultUa1 !== 0) {
										for ($i = 0 ; $i < count($resultUa1) ; $i++) {
											echo "<option value=\"".$resultUa1[$i]['id_Pua']."\">".$resultUa1[$i]['num_ua']." ".$resultUa1[$i]['lib_ua']."</option>";
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

<!-- TABLEAU CONTENU TABLE UH -->
<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<!--<th>Id</th>-->
			<th>Num</th>
			<th><center>Libellé</center></th>
			<th>UA</th>
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
			$sqlUh = "SELECT * FROM annuaire_php_param_uh";
			$queryUh = $connectBdd->prepare($sqlUh);
			$queryUh->execute();
			$resultUh = ($queryUh->rowCount() === 0) ? 0 : $queryUh->fetchAll();

			if ($resultUh !== 0) {
				for ($i = 0 ; $i < count($resultUh) ; $i++) {
					echo "<tr>\n";
					// echo "<td>\n";
					// echo $resultUh[$i]['id_Puh'];
					// echo "</td>\n";
					echo "<td>\n";
					echo $resultUh[$i]['num_uh'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUh[$i]['lib_uh'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUh[$i]['id_Pua'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUh[$i]['actif_uh'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUh[$i]['createur_uh'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUh[$i]['modificateur_uh'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUh[$i]['date_crea_uh'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultUh[$i]['date_modif_uh'];
					echo "</td>\n";
					echo "<td>\n";
					echo "<center><a href=\"#uh".$resultUh[$i]['id_Puh']."\" data-toggle=\"modal\" data-backdrop=\"false\"><i class=\"fa-solid fa-pen\"></i></a></center>";
					echo "</td>\n";
					echo "</tr>\n";
			?>
				<!-- FENETRE MODALE MODIFIER -->
				<div class="modal" id="<?php echo "uh".$resultUh[$i]['id_Puh']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Modifier une unité hospitalière</h5>
							</div>
							<div class="modal-body">
								<form class="form-horizontal col-lg-offset-1" name="formUh2" method="post" action="admin_interface/parametrage_uh_modifier.php">								
									<div class="form-group">
										<div class="row">
											<label class="col-lg-2">ID</label>
											<input type="hidden" name="id" value="<?php echo $resultUh[$i]['id_Puh']; ?>">
											<?php echo $resultUh[$i]['id_Puh']; ?>
										</div>
										
										<div class="row">
											<label class="col-lg-2">Numéro</label>
											<input type="text" name="numero2" value="<?php echo $resultUh[$i]['num_uh']; ?>">
										</div>
									
										<div class="row">
											<label class="col-lg-2">Libellé</label>
											<input type="text" name="libelle2" value="<?php echo $resultUh[$i]['lib_uh']; ?>">
										</div>
										
										<div class="row">
											<label class="col-lg-2">UA</label>
											<select name="ua2">
												<?php
													$sqlUa3 = "SELECT * FROM annuaire_php_param_ua WHERE id_Pua='".$resultUh[$i]['id_Pua']."'";
													$queryUa3 = $connectBdd->prepare($sqlUa3);
													$queryUa3->execute();
													$resultUa3 = ($queryUa3->rowCount() === 0) ? 0 : $queryUa3->fetchAll();

													echo "<option value=\"".$resultUa3[0]['id_Pua']."\">".$resultUa3[0]['lib_ua']."</option>";
												?>
												<option></option>
												<?php
													$sqlUa2 = "SELECT * FROM annuaire_php_param_ua ORDER BY num_ua";
													$queryUa2 = $connectBdd->prepare($sqlUa2);
													$queryUa2->execute();
													$resultUa2 = ($queryUa2->rowCount() === 0) ? 0 : $queryUa2->fetchAll();

													if ($resultUa2 !== 0) {
														for ($j = 0 ; $j < count($resultUa2) ; $j++) {
															echo "<option value=\"".$resultUa2[$j]['id_Pua']."\">".$resultUa2[$j]['num_ua']." ".$resultUa2[$j]['lib_ua']."</option>";
														}
													}
												?>
											</select>
										</div>
										
										<div class="row">
											<label class="col-lg-2">Actif</label>
											<input type="text" name="actif" value="<?php echo $resultUh[$i]['actif_uh']; ?>">&nbsp;&nbsp;
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