<?php 
	// CONNEXION A LA BASE DE DONNEES
	include('../../connexion/connexionBdd.php');
?>

<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajoutercommunication" data-toggle="modal" data-backdrop="false"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
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
			$queryCom = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_communication");
			while($resultCom = mysqli_fetch_assoc($queryCom))
			{
				echo "<tr>\n";
				// echo "<td>\n";
				// echo $resultCom['id_Pcommunication'];
				// echo "</td>\n";
				echo "<td>\n";
				echo $resultCom['lib_com'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultCom['actif_com'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultCom['createur_com'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultCom['modificateur_com'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultCom['date_crea_com'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultCom['date_modif_com'];
				echo "</td>\n";
				echo "<td>\n";
				echo "<center><a href=\"#communication".$resultCom['id_Pcommunication']."\" data-toggle=\"modal\" data-backdrop=\"false\"><span class=\"glyphicon glyphicon-pencil\"></span></a></center>";
				echo "</td>\n";
				echo "</tr>\n";
		?>
			<!-- FENETRE MODALE MODIFIER -->
			<div class="modal" id="<?php echo "communication".$resultCom['id_Pcommunication']; ?>">
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
										<input type="hidden" name="id" value="<?php echo $resultCom['id_Pcommunication']; ?>">
										<?php echo $resultCom['id_Pcommunication']; ?>
									</div>
								
									<div class="row">
										<label class="col-lg-2">Libellé</label>
										<input type="text" name="libelle2" value="<?php echo $resultCom['lib_com']; ?>">
									</div>
									
									<div class="row">
										<label class="col-lg-2">Actif</label>
										<input type="text" name="actif" value="<?php echo $resultCom['actif_com']; ?>">
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