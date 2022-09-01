<?php 
	// CONNEXION A LA BASE DE DONNEES
	include('../../connexion/connexionBdd.php');
?>

<div class="pull-right">
	<a href="#ajouterug" data-toggle="modal" data-backdrop="false"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
</div>

<div class="modal" id="ajouterug">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter une unité de gestion</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formUg1" method="post" action="admin_interface/parametrage_ug_ajouter.php">								
					<div class="form-group">
					<div class="row">
							<label class="col-lg-2">Numéro</label>
							<input type="text" name="numero1">&nbsp;&nbsp;
						</div>
						
						<div class="row">
							<label class="col-lg-2">Libellé</label>
							<input type="text" name="libelle1">&nbsp;&nbsp;
						</div>
						
						<div class="row">
							<label class="col-lg-2">Service</label>
							<select name="service1">
								<option></option>
								<?php
									$queryService1 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_service ORDER BY num_ser");
									while($resultService1 = mysqli_fetch_assoc($queryService1))
									{
										echo "<option value=\"".$resultService1['id_Pservice']."\">".$resultService1['num_ser']." - ".$resultService1['lib_ser']."</option>";
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

<!-- TABLEAU CONTENU TABLE UG -->
<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<!--<th>Id</th>-->
			<th>Num.</th>
			<th><center>Libellé</center></th>
			<th>Service</th>
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
			$queryUg = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_ug");
			while($resultUg = mysqli_fetch_assoc($queryUg))
			{
				echo "<tr>\n";
				// echo "<td>\n";
				// echo $resultUg['id_Pug'];
				// echo "</td>\n";
				echo "<td>\n";
				echo $resultUg['num_ug'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUg['lib_ug'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUg['id_Pservice'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUg['actif_ug'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUg['createur_ug'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUg['modificateur_ug'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUg['date_crea_ug'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUg['date_modif_ug'];
				echo "</td>\n";
				echo "<td>\n";
				echo "<center><a href=\"#ug".$resultUg['id_Pug']."\" data-toggle=\"modal\" data-backdrop=\"false\"><span class=\"glyphicon glyphicon-pencil\"></span></a></center>";
				echo "</td>\n";
				echo "</tr>\n";
		?>
			<!-- FENETRE MODALE MODIFIER -->
			<div class="modal" id="<?php echo "ug".$resultUg['id_Pug']; ?>">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Modifier une unité de gestion</h5>
						</div>
						<div class="modal-body">
							<form class="form-horizontal col-lg-offset-1" name="formUg2" method="post" action="admin_interface/parametrage_ug_modifier.php">								
								<div class="form-group">
									<div class="row">
										<label class="col-lg-2">ID</label>
										<input type="hidden" name="id" value="<?php echo $resultUg['id_Pug']; ?>">
										<?php echo $resultUg['id_Pug']; ?>
									</div>

									<div class="row">
										<label class="col-lg-2">numéro</label>
										<input type="text" name="numero2" value="<?php echo $resultUg['num_ug']; ?>">
									</div>
									
									<div class="row">
										<label class="col-lg-2">Service</label>
										<select name="service2">
											<?php
												$queryService3 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_service WHERE id_Pservice='".$resultUg['id_Pservice']."'");
												$resultService3 = mysqli_fetch_assoc($queryService3);
												echo "<option value=\"".$resultService3['id_Pservice']."\">".$resultService3['lib_ser']."</option>";
											?>
											<option></option>
											<?php
												$queryService2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_service ORDER BY num_ser");
												while($resultService2 = mysqli_fetch_assoc($queryService2))
												{
													echo "<option value=\"".$resultService2['id_Pservice']."\">".$resultService2['num_ser']." - ".$resultService2['lib_ser']."</option>";
												}
											?>
										</select>
									</div>
									
									<div class="row">
										<label class="col-lg-2">Libellé</label>
										<input type="text" name="libelle2" value="<?php echo $resultUg['lib_ug']; ?>">
									</div>
									
									<div class="row">
										<label class="col-lg-2">Actif</label>
										<input type="text" name="actif" value="<?php echo $resultUg['actif_ug']; ?>">&nbsp;&nbsp;
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
			}
		?>
	</tbody>
</table>