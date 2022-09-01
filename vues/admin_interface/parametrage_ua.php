<?php 
	// CONNEXION A LA BASE DE DONNEES
	include('../../connexion/connexionBdd.php');
?>

<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajouterua" data-toggle="modal" data-backdrop="false"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
</div>

<!-- FENETRE MODALE -->
<div class="modal" id="ajouterua">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter une unité administrative</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formUa1" method="post" action="admin_interface/parametrage_ua_ajouter.php">								
					<div class="form-group">
						<div class="row">
							<label class="col-lg-2">Numéro</label>
							<input type="text" name="numero1">
						</div>
					
						<div class="row">
							<label class="col-lg-2">Libellé</label>
							<input type="text" name="libelle1">
						</div>
						
						<div class="row">
							<label class="col-lg-2">UG</label>
							<select name="ug1">
								<option></option>
								<?php
									$queryUg1 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_ug ORDER BY lib_ug");
									while($resultUg1 = mysqli_fetch_assoc($queryUg1))
									{
										echo "<option value=\"".$resultUg1['id_Pug']."\">".$resultUg1['lib_ug']."</option>";
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

<!-- TABLEAU CONTENU TABLE -->
<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<!--<th>Id</th>-->
			<th>Numéro</th>
			<th>Libellé</th>
			<th>UG</th>
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
			$queryUa = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_ua");
			while($resultUa = mysqli_fetch_assoc($queryUa))
			{
				echo "<tr>\n";
				// echo "<td>\n";
				// echo $resultUa['id_Pua'];
				// echo "</td>\n";
				echo "<td>\n";
				echo $resultUa['num_ua'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUa['lib_ua'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUa['id_Pug'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUa['actif_ua'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUa['createur_ua'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUa['modificateur_ua'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUa['date_crea_ua'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUa['date_modif_ua'];
				echo "</td>\n";
				echo "<td>\n";
				echo "<center><a href=\"#ua".$resultUa['id_Pua']."\" data-toggle=\"modal\" data-backdrop=\"false\"><span class=\"glyphicon glyphicon-pencil\"></span></a></center>";
				echo "</td>\n";
				echo "</tr>\n";
		?>
			<!-- FENETRE MODALE MODIFIER -->
			<div class="modal" id="<?php echo "ua".$resultUa['id_Pua']; ?>">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Modifier une unité administrative</h5>
						</div>
						<div class="modal-body">
							<form class="form-horizontal col-lg-offset-1" name="formUa2" method="post" action="admin_interface/parametrage_ua_modifier.php">								
								<div class="form-group">
									<div class="row">
										<label class="col-lg-2">ID</label>
										<input type="hidden" name="id" value="<?php echo $resultUa['id_Pua']; ?>">
										<?php echo $resultUa['id_Pua']; ?>
									</div>
									
									<div class="row">
										<label class="col-lg-2">Numéro</label>
										<input type="text" name="numero2" value="<?php echo $resultUa['num_ua']; ?>">
									</div>
								
									<div class="row">
										<label class="col-lg-2">Libellé</label>
										<input type="text" name="libelle2" value="<?php echo $resultUa['lib_ua']; ?>">
									</div>
									
									<div class="row">
										<label class="col-lg-2">UG</label>
										<select name="ug2">
											<?php
												$queryUg3 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_ug WHERE id_Pug='".$resultUa['id_Pug']."'");
												$resultUg3 = mysqli_fetch_assoc($queryUg3);
												echo "<option>".$resultUg3['lib_ug']."</option>";
											?>
											<option></option>
											<?php
												$queryUg2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_ug ORDER BY lib_ug");
												while($resultUg2 = mysqli_fetch_assoc($queryUg2))
												{
													echo "<option value=\"".$resultUg2['id_Pug']."\">".$resultUg2['lib_ug']."</option>";
												}
											?>
										</select>
									</div>
									
									<div class="row">
										<label class="col-lg-2">Actif</label>
										<input type="text" name="actif" value="<?php echo $resultUa['actif_ua']; ?>">&nbsp;&nbsp;
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