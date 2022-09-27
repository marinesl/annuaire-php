<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajouterbatiment" data-toggle="modal" data-backdrop="false"><i class="fa-solid fa-plus"></i>Ajouter</a>
</div>

<!-- FENETRE MODALE AJOUTER -->
<div class="modal" id="ajouterbatiment">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter un bâtiment</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formBat1" method="post" action="admin_interface/parametrage_batiment_ajouter.php">								
					<div class="form-group">
						<div class="row">
							<label class="col-lg-2">Libellé</label>
							<input type="text" name="libelle1">&nbsp;&nbsp;
							(<u>ex</u> : <font color="red">R</font>obert <font color="red">D</font>ebré)
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

<!-- TABLEAU CONTENU TABLE BATIMENT -->
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
			$sqlBat = "SELECT * FROM annuaire_php_param_batiment";
			$queryBat = $connectBdd->prepare($sqlBat);
			$queryBat->execute();
			$resultBat = ($queryBat->rowCount() === 0) ? 0 : $queryBat->fetchAll();

			if ($resultBat !== 0) {
				for ($i = 0 ; $i < count($resultBat) ; $i++) {
					echo "<tr>\n";
					// echo "<td>\n";
					// echo $resultBat[$i]['id_Pbatiment'];
					// echo "</td>\n";
					echo "<td>\n";
					echo $resultBat[$i]['lib_bat'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultBat[$i]['actif_bat'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultBat[$i]['createur_bat'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultBat[$i]['modificateur_bat'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultBat[$i]['date_crea_bat'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultBat[$i]['date_modif_bat'];
					echo "</td>\n";
					echo "<td>\n";
					echo "<center><a href=\"#batiment".$resultBat[$i]['id_Pbatiment']."\" data-toggle=\"modal\" data-backdrop=\"false\"><i class=\"fa-solid fa-pen\"></i></a></center>";
					echo "</td>\n";
					echo "</tr>\n";
			?>		
				<!-- FENETRE MODALE MODIFIER -->
				<div class="modal" id="<?php echo "batiment".$resultBat[$i]['id_Pbatiment']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Modifier un bâtiment</h5>
							</div>
							<div class="modal-body">
								<form class="form-horizontal col-lg-offset-1" name="formBat2" method="post" action="admin_interface/parametrage_batiment_modifier.php">								
									<div class="form-group">
										<div class="row">
											<label class="col-lg-2">ID</label>
											<input type="hidden" name="id" value="<?php echo $resultBat[$i]['id_Pbatiment']; ?>">
											<?php echo $resultBat[$i]['id_Pbatiment']; ?>
										</div>
									
										<div class="row">
											<label class="col-lg-2">Libellé</label>
											<input type="text" name="libelle2" value="<?php echo $resultBat[$i]['lib_bat']; ?>">
										</div>
										
										<div class="row">
											<label class="col-lg-2">Actif</label>
											<input type="text" name="actif" value="<?php echo $resultBat[$i]['actif_bat']; ?>">&nbsp;&nbsp;
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