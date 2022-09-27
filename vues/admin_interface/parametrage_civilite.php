<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajoutercivilite" data-toggle="modal" data-backdrop="false"><i class="fa-solid fa-plus"></i>Ajouter</a>
</div>

<!-- FENETRE MODALE AJOUTER -->
<div class="modal" id="ajoutercivilite">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter une civilité</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formCiv1" method="post" action="admin_interface/parametrage_civilite_ajouter.php">								
					<div class="form-group">
						<div class="row">
							<label class="col-lg-2">Libellé</label>
							<input type="text" name="libelle1">&nbsp;&nbsp;
							(<u>ex</u> : <font color="red">P</font>rofesseur)
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
</div>	<!-- .cmodal -->

<!-- TABLEAU CONTENU TABLE CIVILITE -->
<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<!--<th>Id</th>-->
			<th>Libellé</th>
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
			$sqlCiv = "SELECT * FROM annuaire_php_param_civilite";
			$queryCiv = $connectBdd->prepare($sqlCiv);
			$queryCiv->execute();
			$resultCiv = ($queryCiv->rowCount() === 0) ? 0 : $queryCiv->fetchAll();

			if ($resultCiv !== 0) {
				for ($i = 0 ; $i < count($resultCiv) ; $i++) {
					echo "<tr>\n";
					// echo "<td>\n";
					// echo $resultCiv[$i]['id_Pcivilite'];
					// echo "</td>\n";
					echo "<td>\n";
					echo $resultCiv[$i]['lib_civ'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultCiv[$i]['actif_civ'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultCiv[$i]['createur_civ'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultCiv[$i]['modificateur_civ'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultCiv[$i]['date_crea_civ'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultCiv[$i]['date_modif_civ'];
					echo "</td>\n";
					echo "<td>\n";
					echo "<center><a href=\"#civilite".$resultCiv[$i]['id_Pcivilite']."\" data-toggle=\"modal\" data-backdrop=\"false\"><i class=\"fa-solid fa-pen\"></i></a></center>";
					echo "</td>\n";
					echo "</tr>\n";
			?>
				<!-- FENETRE MODALE MODIFIER -->
				<div class="modal" id="<?php echo "civilite".$resultCiv[$i]['id_Pcivilite']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Modifier une civilité</h5>
							</div>
							<div class="modal-body">
								<form class="form-horizontal col-lg-offset-1" name="formCiv2" method="post" action="admin_interface/parametrage_civilite_modifier.php">								
									<div class="form-group">
										<div class="row">
											<label class="col-lg-2">ID</label>
											<input type="hidden" name="id" value="<?php echo $resultCiv[$i]['id_Pcivilite']; ?>">
											<?php echo $resultCiv[$i]['id_Pcivilite']; ?>
										</div>
									
										<div class="row">
											<label class="col-lg-2">Libellé</label>
											<input type="text" name="libelle2" value="<?php echo $resultCiv[$i]['lib_civ']; ?>">
										</div>
										
										<div class="row">
											<label class="col-lg-2">Actif</label>
											<input type="text" name="actif" value="<?php echo $resultCiv[$i]['actif_civ']; ?>">&nbsp;&nbsp;
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