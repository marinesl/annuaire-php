<?php 
	// CONNEXION A LA BASE DE DONNEES
	include('../../connexion/connexionBdd.php');
?>

<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajouterlocalisation" data-toggle="modal" data-backdrop="false"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
</div>

<!-- FENETRE MODALE AJOUTER -->
<div class="modal" id="ajouterlocalisation">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter une localisation</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formLoc1" method="post" action="admin_interface/parametrage_localisation_ajouter.php">								
					<div class="form-group">
						<div class="row">
							<label class="col-lg-2">Bâtiment</label>
							<select name="batiment1">
								<option></option>
								<?php 
									$queryBat1 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_batiment ORDER BY lib_bat");
									while($resultBat1 = mysqli_fetch_assoc($queryBat1))
									{
										echo "<option>".$resultBat1['lib_bat']."</option>\n";
									}
								?>
							</select>
						</div>
						
						<div class="row">
							<label class="col-lg-2">Etage</label>
							<select name="etage1">
								<option></option>
								<?php 
									$queryEta1 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_etage ORDER BY lib_eta");
									while($resultEta1 = mysqli_fetch_assoc($queryEta1))
									{
										echo "<option>".$resultEta1['lib_eta']."</option>\n";
									}
								?>
							</select>
						</div>
						
						<div class="row">
							<label class="col-lg-2">Porte</label>
							<select name="porte1">
								<option></option>
								<?php 
									$queryPor1 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_porte ORDER BY lib_porte");
									while($resultPor1 = mysqli_fetch_assoc($queryPor1))
									{
										echo "<option>".$resultPor1['lib_porte']."</option>\n";
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

<!-- TABLEAU CONTENU TABLE LOCALISATION -->
<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<!--<th>Id</th>-->
			<th>Bâtiment</th>
			<th>Etage</th>
			<th>Porte</th>
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
			$queryLoc = mysqli_query($connectBdd, "SELECT * 
													FROM annuaire_param_localisation,annuaire_param_batiment,annuaire_param_etage,annuaire_param_porte
													WHERE annuaire_param_localisation.id_Pbatiment=annuaire_param_batiment.id_Pbatiment
													AND annuaire_param_localisation.id_Petage=annuaire_param_etage.id_Petage
													AND annuaire_param_localisation.id_Pporte=annuaire_param_porte.id_Pporte
													");
			while($resultLoc = mysqli_fetch_assoc($queryLoc))
			{
				echo "<tr>\n";
				// echo "<td>\n";
				// echo $resultLoc['id_Plocalisation'];
				// echo "</td>\n";
				echo "<td>\n";
				echo $resultLoc['lib_bat'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultLoc['lib_eta'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultLoc['lib_porte'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultLoc['actif_loca'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultLoc['createur_loca'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultLoc['modificateur_loca'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultLoc['date_crea_loca'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultLoc['date_modif_loca'];
				echo "</td>\n";
				echo "<td>\n";
				echo "<center><a href=\"#localisation".$resultLoc['id_Plocalisation']."\" data-toggle=\"modal\" data-backdrop=\"false\"><span class=\"glyphicon glyphicon-pencil\"></span></a></center>";
				echo "</td>\n";
				echo "</tr>\n";
		?>
		<!-- FENETRE MODALE MODIFIER -->
			<div class="modal" id="<?php echo "localisation".$resultLoc['id_Plocalisation']; ?>">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Modifier une localisation</h5>
						</div>
						<div class="modal-body">
							<form class="form-horizontal col-lg-offset-1" name="formLoc2" method="post" action="admin_interface/parametrage_localisation_modifier.php">								
								<div class="form-group">
									<div class="row">
										<label class="col-lg-2">ID</label>
										<input type="hidden" name="id" value="<?php echo $resultLoc['id_Plocalisation']; ?>">
										<?php echo $resultLoc['id_Plocalisation']; ?>
									</div>
								
									<div class="row">
										<label class="col-lg-2">Bâtiment</label>
										<input type="hidden" name="batiment2" value="<?php echo $resultLoc['lib_bat']; ?>">
										<?php echo $resultLoc['lib_bat']; ?>
										<select name="batiment3">
											<option></option>
											<?php
												$queryBat2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_batiment ORDER BY lib_bat");
												while($resultBat2 = mysqli_fetch_assoc($queryBat2))
												{
													echo "<option>".$resultBat2['lib_bat']."</option>";
												}
											?>
										</select>
									</div>
									
									<div class="row">
										<label class="col-lg-2">Etage</label>
										<input type="hidden" name="etage2" value="<?php echo $resultLoc['lib_eta']; ?>">
										<?php echo $resultLoc['lib_eta']; ?>
										<select name="etage3">
											<option></option>
											<?php
												$queryEta2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_etage ORDER BY lib_eta");
												while($resultEta2 = mysqli_fetch_assoc($queryEta2))
												{
													echo "<option>".$resultEta2['lib_eta']."</option>";
												}
											?>
										</select>
									</div>
									
									<div class="row">
										<label class="col-lg-2">Porte</label>
										<input type="hidden" name="porte2" value="<?php echo $resultLoc['lib_porte']; ?>">
										<?php echo $resultLoc['lib_porte']; ?>
										<select name="porte3">
											<option></option>
											<?php
												$queryPor2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_porte");
												while($resultPor2 = mysqli_fetch_assoc($queryPor2))
												{
													echo "<option>".$resultPor2['lib_porte']."</option>";
												}
											?>
										</select>
									</div>
									
									<div class="row">
										<label class="col-lg-2">Actif</label>
										<input type="text" name="actif" value="<?php echo $resultLoc['actif_loca']; ?>">&nbsp;&nbsp;
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
			}
		?>
	</tbody>
</table>