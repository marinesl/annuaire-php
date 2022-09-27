<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajouterfonction" data-toggle="modal" data-backdrop="false"><i class="fa-solid fa-plus"></i>Ajouter</a>
</div>

<!-- FENETRE MODALE AJOUTER -->
<div class="modal" id="ajouterfonction">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter une fonction</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formFonc1" method="post" action="admin_interface/parametrage_fonction_ajouter.php">								
					<div class="form-group">
						<div class="row">
							<label class="col-lg-2">Libellé</label>
							<input type="text" name="libelle1">&nbsp;&nbsp;
							(<u>ex</u> : <font color="red">S</font>ecrétaire)
						</div>
						
						<div class="row">
							<label class="col-lg-2">Ordre</label>
							<input type="text" name="ordre1">
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

<!-- TABLEAU CONTENU TABLE FONCTION -->
<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<!--<th>Id</th>-->
			<th>Libellé</th>
			<th>Ord.</th>
			<th>Act.</th>
			<th>Créateur</th>
			<th>Modif.</th>
			<th>Date de création</th>
			<th>Date de modification</th>
			<th>Modifier</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$sqlFonc = "SELECT * FROM annuaire_php_param_fonction";
		$queryCiv = $connectBdd->prepare($sqlFonc);
		$queryCiv->execute();
		$resultFonc = ($queryCiv->rowCount() === 0) ? 0 : $queryCiv->fetchAll();

		if ($resultCiv !== 0) {
			for ($i = 0 ; $i < count($resultCiv) ; $i++) {
				echo "<tr>\n";
				// echo "<td>\n";
				// echo $resultFonc[$i]['id_Pfonction'];
				// echo "</td>\n";
				echo "<td>\n";
				echo $resultFonc[$i]['lib_fonc'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultFonc[$i]['ordre_fonc'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultFonc[$i]['actif_fonc'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultFonc[$i]['createur_fonc'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultFonc[$i]['modificateur_fonc'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultFonc[$i]['date_crea_fonc'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultFonc[$i]['date_modif_fonc'];
				echo "</td>\n";
				echo "<td>\n";
				echo "<center><a href=\"#fonction".$resultFonc[$i]['id_Pfonction']."\" data-toggle=\"modal\" data-backdrop=\"false\"><i class=\"fa-solid fa-pen\"></i></a></center>";
				echo "</td>\n";
				echo "</tr>\n";
		?>
			<!-- FENETRE MODALE MODIFIER -->
				<div class="modal" id="<?php echo "fonction".$resultFonc[$i]['id_Pfonction']; ?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Modifier une fonction</h5>
							</div>
							<div class="modal-body">
								<form class="form-horizontal col-lg-offset-1" name="formFonc2" method="post" action="admin_interface/parametrage_fonction_modifier.php">								
									<div class="form-group">
										<div class="row">
											<label class="col-lg-2">ID</label>
											<input type="hidden" name="id" value="<?php echo $resultFonc[$i]['id_Pfonction']; ?>">
											<?php echo $resultFonc[$i]['id_Pfonction']; ?>
										</div>
									
										<div class="row">
											<label class="col-lg-2">Libellé</label>
											<input type="text" name="libelle2" value="<?php echo $resultFonc[$i]['lib_fonc']; ?>">
										</div>
										
										<div class="row">
											<label class="col-lg-2">Ordre</label>
											<input type="text" name="ordre2" value="<?php echo $resultFonc[$i]['ordre_fonc']; ?>">
										</div>
										
										<div class="row">
											<label class="col-lg-2">Actif</label>
											<input type="text" name="actif" value="<?php echo $resultFonc[$i]['actif_fonc']; ?>">&nbsp;&nbsp;
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