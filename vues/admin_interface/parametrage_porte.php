<?php 
	// CONNEXION A LA BASE DE DONNEES
	include('../../connexion/connexionBdd.php');
?>

<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajouterporte" data-toggle="modal" data-backdrop="false"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
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
			$queryPorte = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_porte");
			while($resultPorte = mysqli_fetch_assoc($queryPorte))
			{
				echo "<tr>\n";
				// echo "<td>\n";
				// echo $resultPorte['id_Pporte'];
				// echo "</td>\n";
				echo "<td>\n";
				echo "<center>".$resultPorte['lib_porte']."</center>";
				echo "</td>\n";
				echo "<td>\n";
				echo $resultPorte['actif_porte'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultPorte['createur_porte'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultPorte['modificateur_porte'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultPorte['date_crea_porte'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultPorte['date_modif_porte'];
				echo "</td>\n";
				echo "<td>\n";
				echo "<center><a href=\"#porte".$resultPorte['id_Pporte']."\" data-toggle=\"modal\" data-backdrop=\"false\"><span class=\"glyphicon glyphicon-pencil\"></span></a></center>";
				echo "</td>\n";
				echo "</tr>\n";
		?>
			<!-- FENETRE MODALE MODIFIER -->
			<div class="modal" id="<?php echo "porte".$resultPorte['id_Pporte']; ?>">
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
										<input type="hidden" name="id" value="<?php echo $resultPorte['id_Pporte']; ?>">
										<?php echo $resultPorte['id_Pporte']; ?>
									</div>
								
									<div class="row">
										<label class="col-lg-2">Libellé</label>
										<input type="text" name="libelle2" value="<?php echo $resultPorte['lib_porte']; ?>">
									</div>
									
									<div class="row">
										<label class="col-lg-2">Actif</label>
										<input type="text" name="actif" value="<?php echo $resultPorte['actif_porte']; ?>">&nbsp;&nbsp;
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