<?php 
	// CONNEXION A LA BASE DE DONNEES
	include('../../connexion/connexionBdd');
?>

<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajouteretage" data-toggle="modal" data-backdrop="false"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
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
			$queryEta = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_etage");
			while($resultEta = mysqli_fetch_assoc($queryEta))
			{
				echo "<tr>\n";
				// echo "<td>\n";
				// echo $resultEta['id_Petage'];
				// echo "</td>\n";
				echo "<td>\n";
				echo $resultEta['lib_eta'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultEta['actif_eta'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultEta['createur_eta'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultEta['modificateur_eta'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultEta['date_crea_eta'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultEta['date_modif_eta'];
				echo "</td>\n";
				echo "<td>\n";
				echo "<center><a href=\"#etage".$resultEta['id_Petage']."\" data-toggle=\"modal\" data-backdrop=\"false\"><span class=\"glyphicon glyphicon-pencil\"></span></a></center>";
				echo "</td>\n";
				echo "</tr>\n";
		?>
			<!-- FENETRE MODALE MODIFIER -->
			<div class="modal" id="<?php echo "etage".$resultEta['id_Petage']; ?>">
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
										<input type="hidden" name="id" value="<?php echo $resultEta['id_Petage']; ?>">
										<?php echo $resultEta['id_Petage']; ?>
									</div>
								
									<div class="row">
										<label class="col-lg-2">Libellé</label>
										<input type="text" name="libelle2" value="<?php echo $resultEta['lib_eta']; ?>">
									</div>
									
									<div class="row">
										<label class="col-lg-2">Actif</label>
										<input type="text" name="actif" value="<?php echo $resultEta['actif_eta']; ?>">&nbsp;&nbsp;
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