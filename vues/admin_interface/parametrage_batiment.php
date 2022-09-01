<?php 
	// CONNEXION A LA BASE DE DONNEES	
	include('../../connexion/connexionBdd.php');
?>	

<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajouterbatiment" data-toggle="modal" data-backdrop="false"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
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
			$queryBat = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_batiment");
			while($resultBat = mysqli_fetch_assoc($queryBat))
			{
				echo "<tr>\n";
				// echo "<td>\n";
				// echo $resultBat['id_Pbatiment'];
				// echo "</td>\n";
				echo "<td>\n";
				echo $resultBat['lib_bat'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultBat['actif_bat'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultBat['createur_bat'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultBat['modificateur_bat'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultBat['date_crea_bat'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultBat['date_modif_bat'];
				echo "</td>\n";
				echo "<td>\n";
				echo "<center><a href=\"#batiment".$resultBat['id_Pbatiment']."\" data-toggle=\"modal\" data-backdrop=\"false\"><span class=\"glyphicon glyphicon-pencil\"></span></a></center>";
				echo "</td>\n";
				echo "</tr>\n";
		?>		
			<!-- FENETRE MODALE MODIFIER -->
			<div class="modal" id="<?php echo "batiment".$resultBat['id_Pbatiment']; ?>">
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
										<input type="hidden" name="id" value="<?php echo $resultBat['id_Pbatiment']; ?>">
										<?php echo $resultBat['id_Pbatiment']; ?>
									</div>
								
									<div class="row">
										<label class="col-lg-2">Libellé</label>
										<input type="text" name="libelle2" value="<?php echo $resultBat['lib_bat']; ?>">
									</div>
									
									<div class="row">
										<label class="col-lg-2">Actif</label>
										<input type="text" name="actif" value="<?php echo $resultBat['actif_bat']; ?>">&nbsp;&nbsp;
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