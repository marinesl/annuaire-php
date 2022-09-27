<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajoutercommunication" data-toggle="modal" data-backdrop="false"><i class="fa-solid fa-plus"></i>Ajouter</a>
</div>

<!-- FENETRE MODALE AJOUTER -->
<div class="modal" id="ajoutercommunication">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter une communication</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formCom1" method="post" action="admin_interface/parametrage_communication_ajouter.php">								
					<div class="form-group">
						<div class="row">
							<label class="col-lg-2">Libellé</label>
							<input type="text" name="libelle1">&nbsp;&nbsp;
							(<u>ex</u> : <font color="red">F</font>ixe)
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

<!-- TABLEAU CONTENU TABLE COMMUNICATION -->
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
			$sqlCom = "SELECT * FROM annuaire_php_param_communication";
			$queryCom = $connectBdd->prepare($sqlCom);
			$queryCom->execute();
			$resultCom = ($queryCom->rowCount() === 0) ? 0 : $queryCom->fetchAll();

			if ($resultCom !== 0) {
				for ($i = 0 ; $i < count($resultCom) ; $i++) {
					echo "<tr>\n";
					// echo "<td>\n";
					// echo $resultCom[$i]['id_Pcommunication'];
					// echo "</td>\n";
					echo "<td>\n";
					echo $resultCom[$i]['lib_com'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultCom[$i]['actif_com'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultCom[$i]['createur_com'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultCom[$i]['modificateur_com'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultCom[$i]['date_crea_com'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultCom[$i]['date_modif_com'];
					echo "</td>\n";
					echo "<td>\n";
					echo "<center><a href=\"#communication".$resultCom[$i]['id_Pcommunication']."\" data-toggle=\"modal\" data-backdrop=\"false\"><i class=\"fa-solid fa-pen\"></i></a></center>";
					echo "</td>\n";
					echo "</tr>\n";
			?>
				<!-- FENETRE MODALE MODIFIER -->
				<div class="modal" id="<?php echo "communication".$resultCom[$i]['id_Pcommunication']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Modifier une communication</h5>
							</div>
							<div class="modal-body">
								<form class="form-horizontal col-lg-offset-1" name="formCom2" method="post" action="admin_interface/parametrage_communication_modifier.php">								
									<div class="form-group">
										<div class="row">
											<label class="col-lg-2">ID</label>
											<input type="hidden" name="id" value="<?php echo $resultCom[$i]['id_Pcommunication']; ?>">
											<?php echo $resultCom[$i]['id_Pcommunication']; ?>
										</div>
									
										<div class="row">
											<label class="col-lg-2">Libellé</label>
											<input type="text" name="libelle2" value="<?php echo $resultCom[$i]['lib_com']; ?>">
										</div>
										
										<div class="row">
											<label class="col-lg-2">Actif</label>
											<input type="text" name="actif" value="<?php echo $resultCom[$i]['actif_com']; ?>">
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