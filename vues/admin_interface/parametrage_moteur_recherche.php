<?php 
	// CONNEXION A LA BASE DE DONNEES	
	include('../../connexion/connexionBdd.php');
?>

<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajoutermoteur" data-toggle="modal" data-backdrop="false"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
</div>

<!-- FENETRE MODALE AJOUTER -->
<div class="modal" id="ajoutermoteur">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter une information</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formRch1" method="post" action="admin_interface/parametrage_moteur_recherche_ajouter.php">								
					<div class="form-group">
						<div class="row">
							<label class="col-lg-2">Abonné</label>
							<select name="abonne1">
								<option></option>
								<?php
									$queryAb1 = mysqli_query($connectBdd, "SELECT * FROM annuaire_exploit_abonne ORDER BY nom_ab");
									while($resultAb1 = mysqli_fetch_assoc($queryAb1))
									{
										echo "<option>".$resultAb1['nom_ab']."_".$resultAb1['prenom_personne']."</option>";
									}
								?>
							</select>
						</div>
						
						<div class="row">
							<label class="col-lg-2">Information</label>&nbsp;
							<textarea rows="7" cols="50" name="info1"></textarea>
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

<!-- TABLEAU CONTENU TABLE MOTEUR DE RECHERCHE -->
<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<!--<th>Id</th>-->
			<th><center>Abonné</center></th>
			<th><center>Info</center></th>
			<th>Modifier</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$queryRch = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_moteur_recherche,annuaire_exploit_abonne
																WHERE annuaire_param_moteur_recherche.id_Eabonne=annuaire_exploit_abonne.id_Eabonne
																");
			while($resultRch = mysqli_fetch_assoc($queryRch))
			{
				echo "<tr>\n";
				// echo "<td>\n";
				// echo $resultRch['id_Pmoteur_rch'];
				// echo "</td>\n";
				echo "<td>\n";
				echo $resultRch['nom_ab']."&nbsp;".$resultRch['prenom_personne'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultRch['info_integrale'];
				echo "</td>\n";
				echo "<td>\n";
				echo "<center><a href=\"#moteur".$resultRch['id_Pmoteur_rch']."\" data-toggle=\"modal\" data-backdrop=\"false\"><span class=\"glyphicon glyphicon-pencil\"></span></a></center>";
				echo "</td>\n";
				echo "</tr>\n";
		?>
			<!-- FENETRE MODALE MODIFIER -->
			<div class="modal" id="<?php echo "moteur".$resultRch['id_Pmoteur_rch']; ?>">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Modifier une information</h5>
						</div>
						<div class="modal-body">
							<form class="form-horizontal col-lg-offset-1" name="formRch2" method="post" action="admin_interface/parametrage_moteur_recherche_modifier.php">								
								<div class="form-group">
									<div class="row">
										<label class="col-lg-2">ID</label>
										<input type="hidden" name="id" value="<?php echo $resultRch['id_Pmoteur_rch']; ?>">
										<?php echo $resultRch['id_Pmoteur_rch']; ?>
									</div>
								
									<div class="row">
										<label class="col-lg-2">Abonné</label>
										<input type="hidden" name="abonne2" value="<?php echo $resultRch['nom_ab']."_".$resultRch['prenom_personne']; ?>">
										<?php echo $resultRch['nom_ab']."&nbsp;".$resultRch['prenom_personne']; ?>
										<select name="abonne3">
											<option></option>
											<?php
												$queryAb2 = mysqli_query ($connectBdd, "SELECT * FROM annuaire_exploit_abonne ORDER BY nom_ab");
												while($resultAb2 = mysqli_fetch_assoc($queryAb2))
												{
													echo "<option>".$resultAb2['nom_ab']."_".$resultAb2['prenom_personne']."</option>";
												}
											?>
										</select>
									</div>
									
									<div class="row">
										<label class="col-lg-2">Information</label>
										<textarea rows="7" cols="50" name="info2"><?php echo $resultRch['info_integrale']; ?></textarea>
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