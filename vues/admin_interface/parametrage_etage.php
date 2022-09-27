<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajouteretage" data-toggle="modal" data-backdrop="false"><i class="fa-solid fa-plus"></i>Ajouter</a>
</div>

<!-- FENETRE MODALE AJOUTER -->
<div class="modal" id="ajouteretage">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter un étage</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formEta1" method="post" action="admin_interface/parametrage_etage_ajouter.php">								
					<div class="form-group">
						<div class="row">
							<label class="col-lg-2">Libellé</label>
							<input type="text" name="libelle1">&nbsp;&nbsp;
							(<u>ex</u> : <font color="red">RDCbas</font> ou <font color="red">2ème</font>)
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

<!-- TABLEAU CONTENU TABLE ETAGE -->
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
			$sqlEta = "SELECT * FROM annuaire_php_param_etage";
			$queryEta = $connectBdd->prepare($sqlEta);
			$queryEta->execute();
			$resultEta = ($queryEta->rowCount() === 0) ? 0 : $queryEta->fetchAll();

			if ($resultEta !== 0) {
				for ($i = 0 ; $i < count($resultEta) ; $i++) {
					echo "<tr>\n";
					// echo "<td>\n";
					// echo $resultEta[$i]['id_Petage'];
					// echo "</td>\n";
					echo "<td>\n";
					echo $resultEta[$i]['lib_eta'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultEta[$i]['actif_eta'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultEta[$i]['createur_eta'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultEta[$i]['modificateur_eta'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultEta[$i]['date_crea_eta'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultEta[$i]['date_modif_eta'];
					echo "</td>\n";
					echo "<td>\n";
					echo "<center><a href=\"#etage".$resultEta[$i]['id_Petage']."\" data-toggle=\"modal\" data-backdrop=\"false\"><i class=\"fa-solid fa-pen\"></i></a></center>";
					echo "</td>\n";
					echo "</tr>\n";
			?>
				<!-- FENETRE MODALE MODIFIER -->
				<div class="modal" id="<?php echo "etage".$resultEta[$i]['id_Petage']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Modifier un étage</h5>
							</div>
							<div class="modal-body">
								<form class="form-horizontal col-lg-offset-1" name="formEta2" method="post" action="admin_interface/parametrage_etage_modifier.php">								
									<div class="form-group">
										<div class="row">
											<label class="col-lg-2">ID</label>
											<input type="hidden" name="id" value="<?php echo $resultEta[$i]['id_Petage']; ?>">
											<?php echo $resultEta[$i]['id_Petage']; ?>
										</div>
									
										<div class="row">
											<label class="col-lg-2">Libellé</label>
											<input type="text" name="libelle2" value="<?php echo $resultEta[$i]['lib_eta']; ?>">
										</div>
										
										<div class="row">
											<label class="col-lg-2">Actif</label>
											<input type="text" name="actif" value="<?php echo $resultEta[$i]['actif_eta']; ?>">&nbsp;&nbsp;
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