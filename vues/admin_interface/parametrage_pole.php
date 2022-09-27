<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajouterpole" data-toggle="modal" data-backdrop="false"><i class="fa-solid fa-plus"></i>Ajouter</a>
</div>

<!-- FENETRE MODALE AJOUTER -->
<div class="modal" id="ajouterpole">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter un pôle</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formPole1" method="post" action="admin_interface/parametrage_pole_ajouter.php">								
					<div class="form-group">
						<div class="row">
							<label class="col-lg-2">Numéro</label>
							<input type="text" name="numero1">&nbsp;&nbsp;
						</div>
						
						<div class="row">
							<label class="col-lg-2">Libellé</label>
							<input type="text" name="libelle1">
						</div>
						
						<div class="row">
							<div class="col-lg-offset-2">
								(<u>ex</u> : <font color="red">P</font>édiatrie <font color="red">G</font>énérale)
							</div>
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

<!-- TABLEAU CONTENU TABLE POLE -->
<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<!--<th>Id</th>-->
			<th>Num.</th>
			<th><center>Libellé</center></th>
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
			$sqlPole = "SELECT * FROM annuaire_php_param_pole";
			$queryPole = $connectBdd->prepare($sqlPole);
			$queryPole->execute();
			$resultPole = ($queryPole->rowCount() === 0) ? 0 : $queryPole->fetchAll();

			if ($resultPole !== 0) {
				for ($i = 0 ; $i < count($resultPole) ; $i++) {
					echo "<tr>\n";
					// echo "<td>\n";
					// echo $resultPole[$i]['id_Ppole'];
					// echo "</td>\n";
					echo "<td>\n";
					echo $resultPole[$i]['num_pole'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultPole[$i]['lib_pole'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultPole[$i]['actif_pole'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultPole[$i]['createur_pole'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultPole[$i]['modificateur_pole'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultPole[$i]['date_crea_pole'];
					echo "</td>\n";
					echo "<td>\n";
					echo $resultPole[$i]['date_modif_pole'];
					echo "</td>\n";
					echo "<td>\n";
					echo "<center><a href=\"#pole".$resultPole[$i]['id_Ppole']."\" data-toggle=\"modal\" data-backdrop=\"false\"><i class=\"fa-solid fa-pen\"></i></a></center>";
					echo "</td>\n";
					echo "</tr>\n";
			?>
				<!-- FENETRE MODALE MODIFIER -->
				<div class="modal" id="<?php echo "pole".$resultPole[$i]['id_Ppole']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Modifier un pôle</h5>
							</div>
							<div class="modal-body">
								<form class="form-horizontal col-lg-offset-1" name="formPole2" method="post" action="admin_interface/parametrage_pole_modifier.php">								
									<div class="form-group">
										<div class="row">
											<label class="col-lg-2">ID</label>
											<input type="hidden" name="id" value="<?php echo $resultPole[$i]['id_Ppole']; ?>">
											<?php echo $resultPole[$i]['id_Ppole']; ?>
										</div>
										
										<div class="row">
											<label class="col-lg-2">Numéro</label>
											<input type="text" name="numero2" value="<?php echo $resultPole[$i]['num_pole']; ?>">
										</div>
									
										<div class="row">
											<label class="col-lg-2">Libellé</label>
											<input class="col-lg-6" type="text" name="libelle2" value="<?php echo $resultPole[$i]['lib_pole']; ?>">
										</div>
										
										<div class="row">
											<label class="col-lg-2">Actif</label>
											<input type="text" name="actif" value="<?php echo $resultPole[$i]['actif_pole']; ?>">&nbsp;&nbsp;
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