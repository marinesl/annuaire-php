<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajouterporte" data-toggle="modal" data-backdrop="false"><i class="fa-solid fa-plus"></i>Ajouter</a>
</div>

<!-- FENETRE MODALE AJOUTER -->
<div class="modal" id="ajouterporte">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter une porte</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formPorte1" method="post" action="admin_interface/parametrage_porte_ajouter.php">								
					<div class="form-group">
						<div class="row">
							<label class="col-lg-2">Libellé</label>
							<input type="text" name="libelle1">&nbsp;&nbsp;
							(<u>ex</u> : <font color="red">D</font>1)
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

<!-- TABLEAU CONTENU TABLE PORTE -->
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
			$sqlPorte = "SELECT * FROM annuaire_php_param_porte";
			$queryPorte = $connectBdd->prepare($sqlPorte);
			$queryPorte->execute();
			$resultPorte = ($queryPorte->rowCount() === 0) ? 0 : $queryPorte->fetchAll();

			if ($resultPorte !== 0) {
				for ($i = 0 ; $i < count($resultPorte) ; $i++) {
					echo "<tr>\n";
					// echo "<td>\n";
					// echo $resultPorte[$i]['id_Pporte'];
					// echo "</td>\n";
					echo "<td>\n";
					echo "<center>".$resultPorte[$i]['lib_porte']."</center>";
					echo "</td>\n";
					echo "<td>\n";
					echo $resultPorte[$i]['actif_porte'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultPorte[$i]['createur_porte'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultPorte[$i]['modificateur_porte'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultPorte[$i]['date_crea_porte'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultPorte[$i]['date_modif_porte'];
					echo "</td>\n";
					echo "<td>\n";
					echo "<center><a href=\"#porte".$resultPorte[$i]['id_Pporte']."\" data-toggle=\"modal\" data-backdrop=\"false\"><i class=\"fa-solid fa-pen\"></i></a></center>";
					echo "</td>\n";
					echo "</tr>\n";
			?>
				<!-- FENETRE MODALE MODIFIER -->
				<div class="modal" id="<?php echo "porte".$resultPorte[$i]['id_Pporte']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Modifier une porte</h5>
							</div>
							<div class="modal-body">
								<form class="form-horizontal col-lg-offset-1" name="formPorte2" method="post" action="admin_interface/parametrage_porte_modifier.php">								
									<div class="form-group">
										<div class="row">
											<label class="col-lg-2">ID</label>
											<input type="hidden" name="id" value="<?php echo $resultPorte[$i]['id_Pporte']; ?>">
											<?php echo $resultPorte[$i]['id_Pporte']; ?>
										</div>
									
										<div class="row">
											<label class="col-lg-2">Libellé</label>
											<input type="text" name="libelle2" value="<?php echo $resultPorte[$i]['lib_porte']; ?>">
										</div>
										
										<div class="row">
											<label class="col-lg-2">Actif</label>
											<input type="text" name="actif" value="<?php echo $resultPorte[$i]['actif_porte']; ?>">&nbsp;&nbsp;
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