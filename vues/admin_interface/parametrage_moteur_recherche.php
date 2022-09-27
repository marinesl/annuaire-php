<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajoutermoteur" data-toggle="modal" data-backdrop="false"><i class="fa-solid fa-plus"></i>Ajouter</a>
</div>

<!-- FENETRE MODALE AJOUTER -->
<div class="modal" id="ajoutermoteur">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter une information</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formRch1" method="post" action="admin_interface/parametrage_moteur_recherche_ajouter.php">								
					<div class="form-group">
						<div class="row">
							<label class="col-lg-2">Abonné</label>
							<select name="abonne1">
								<option></option>
								<?php
									$sqlAb1 = "SELECT * FROM annuaire_php_exploit_abonne ORDER BY nom_ab";
									$queryAb1 = $connectBdd->prepare($sqlAb1);
									$queryAb1->execute();
									$resultAb1 = ($queryAb1->rowCount() === 0) ? 0 : $queryAb1->fetchAll();

									if ($resultAb1 !== 0) {
										for ($i = 0 ; $i < count($resultAb1) ; $i++) {
											echo "<option>".$resultAb1[$i]['nom_ab']."_".$resultAb1[$i]['prenom_personne']."</option>";
										}
									}
								?>
							</select>
						</div>
						
						<div class="row">
							<label class="col-lg-2">Information</label>&nbsp;
							<textarea rows="7" cols="50" name="info1"></textarea>
						</div>
						
						<br>
						
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

<!-- TABLEAU CONTENU TABLE MOTEUR DE RECHERCHE -->
<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<!--<th>Id</th>-->
			<th><center>Abonné</center></th>
			<th><center>Info</center></th>
			<th>Modifier</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$sqlRch = "SELECT * 
						FROM annuaire_php_param_moteur_recherche,annuaire_php_exploit_abonne
						WHERE annuaire_php_param_moteur_recherche.id_Eabonne=annuaire_php_exploit_abonne.id_Eabonne";
			$queryRch = $connectBdd->prepare($sqlRch);
			$queryRch->execute();
			$resultRch = ($queryRch->rowCount() === 0) ? 0 : $queryRch->fetchAll();

			if ($resultRch !== 0) {
				for ($i = 0 ; $i < count($resultRch) ; $i++) {
					echo "<tr>\n";
					// echo "<td>\n";
					// echo $resultRch[$i]['id_Pmoteur_rch'];
					// echo "</td>\n";
					echo "<td>\n";
					echo $resultRch[$i]['nom_ab']."&nbsp;".$resultRch[$i]['prenom_personne'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultRch[$i]['info_integrale'];
					echo "</td>\n";
					echo "<td>\n";
					echo "<center><a href=\"#moteur".$resultRch[$i]['id_Pmoteur_rch']."\" data-toggle=\"modal\" data-backdrop=\"false\"><i class=\"fa-solid fa-pen\"></i></a></center>";
					echo "</td>\n";
					echo "</tr>\n";
			?>
				<!-- FENETRE MODALE MODIFIER -->
				<div class="modal" id="<?php echo "moteur".$resultRch[$i]['id_Pmoteur_rch']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Modifier une information</h5>
							</div>
							<div class="modal-body">
								<form class="form-horizontal col-lg-offset-1" name="formRch2" method="post" action="admin_interface/parametrage_moteur_recherche_modifier.php">								
									<div class="form-group">
										<div class="row">
											<label class="col-lg-2">ID</label>
											<input type="hidden" name="id" value="<?php echo $resultRch[$i]['id_Pmoteur_rch']; ?>">
											<?php echo $resultRch[$i]['id_Pmoteur_rch']; ?>
										</div>
									
										<div class="row">
											<label class="col-lg-2">Abonné</label>
											<input type="hidden" name="abonne2" value="<?php echo $resultRch[$i]['nom_ab']."_".$resultRch[$i]['prenom_personne']; ?>">
											<?php echo $resultRch[$i]['nom_ab']."&nbsp;".$resultRch[$i]['prenom_personne']; ?>
											<select name="abonne3">
												<option></option>
												<?php
													$sqlAb2 = "SELECT * FROM annuaire_php_exploit_abonne ORDER BY nom_ab";
													$queryAb2 = $connectBdd->prepare($sqlAb2);
													$queryAb2->execute();
													$resultAb2 = ($queryAb2->rowCount() === 0) ? 0 : $queryAb2->fetchAll();

													if ($resultAb2 !== 0) {
														for ($j = 0 ; $j < count($resultAb2) ; $j++) {
															echo "<option>".$resultAb2[$j]['nom_ab']."_".$resultAb2[$j]['prenom_personne']."</option>";
														}
													}
												?>
											</select>
										</div>
										
										<div class="row">
											<label class="col-lg-2">Information</label>
											<textarea rows="7" cols="50" name="info2"><?php echo $resultRch[$i]['info_integrale']; ?></textarea>
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