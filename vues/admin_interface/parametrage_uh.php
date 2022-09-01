<?php 
	// CONNEXION A LA BASE DE DONNEES
	include('../../connexion/connexionBdd.php');
?>

<!-- BOUTON AJOUTER -->
<div class="pull-right">
	<a href="#ajouteruh" data-toggle="modal" data-backdrop="false"><span class="glyphicon glyphicon-plus"></span>&nbsp;Ajouter</a>
</div>

<!-- FENETRE MODALE AJOUTER -->
<div class="modal" id="ajouteruh">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter une unité hospitalière</h5>
			</div>
			<div class="modal-body">
				<form class="form-horizontal col-lg-offset-1" name="formUh1" method="post" action="admin_interface/parametrage_uh_ajouter.php">								
					<div class="form-group">
						<div class="row">
							<label class="col-lg-2">Numéro</label>
							<input type="text" name="numero1">
						</div>
						
						<div class="row">
							<label class="col-lg-2">Libellé</label>
							<input type="text" name="libelle1">&nbsp;&nbsp;
							(<u>ex</u> : <font color="red">HJ2 DIABETOLOGIE D1</font>)
						</div>
						
						<div class="row">
							<label class="col-lg-2">UA</label>
							<select name="ua1">
								<option></option>
								<?php
									$queryUa1 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_ua ORDER BY num_ua");
									while($resultUa1 = mysqli_fetch_assoc($queryUa1))
									{
										echo "<option value=\"".$resultUa1['id_Pua']."\">".$resultUa1['num_ua']." ".$resultUa1['lib_ua']."</option>";
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

<!-- TABLEAU CONTENU TABLE UH -->
<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<!--<th>Id</th>-->
			<th>Num</th>
			<th><center>Libellé</center></th>
			<th>UA</th>
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
			$queryUh = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_uh");
			while($resultUh = mysqli_fetch_assoc($queryUh))
			{
				echo "<tr>\n";
				// echo "<td>\n";
				// echo $resultUh['id_Puh'];
				// echo "</td>\n";
				echo "<td>\n";
				echo $resultUh['num_uh'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUh['lib_uh'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUh['id_Pua'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUh['actif_uh'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUh['createur_uh'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUh['modificateur_uh'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUh['date_crea_uh'];
				echo "</td>\n";
				echo "<td>\n";
				echo $resultUh['date_modif_uh'];
				echo "</td>\n";
				echo "<td>\n";
				echo "<center><a href=\"#uh".$resultUh['id_Puh']."\" data-toggle=\"modal\" data-backdrop=\"false\"><span class=\"glyphicon glyphicon-pencil\"></span></a></center>";
				echo "</td>\n";
				echo "</tr>\n";
		?>
			<!-- FENETRE MODALE MODIFIER -->
			<div class="modal" id="<?php echo "uh".$resultUh['id_Puh']; ?>">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Modifier une unité hospitalière</h5>
						</div>
						<div class="modal-body">
							<form class="form-horizontal col-lg-offset-1" name="formUh2" method="post" action="admin_interface/parametrage_uh_modifier.php">								
								<div class="form-group">
									<div class="row">
										<label class="col-lg-2">ID</label>
										<input type="hidden" name="id" value="<?php echo $resultUh['id_Puh']; ?>">
										<?php echo $resultUh['id_Puh']; ?>
									</div>
									
									<div class="row">
										<label class="col-lg-2">Numéro</label>
										<input type="text" name="numero2" value="<?php echo $resultUh['num_uh']; ?>">
									</div>
								
									<div class="row">
										<label class="col-lg-2">Libellé</label>
										<input type="text" name="libelle2" value="<?php echo $resultUh['lib_uh']; ?>">
									</div>
									
									<div class="row">
										<label class="col-lg-2">UA</label>
										<select name="ua2">
											<?php
												$queryUa3 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_ua WHERE id_Pua='".$resultUh['id_Pua']."'");
												$resultUa3 = mysqli_fetch_assoc($queryUa3);
												echo "<option value=\"".$resultUa3['id_Pua']."\">".$resultUa3['lib_ua']."</option>";
											?>
											<option></option>
											<?php
												$queryUa2 = mysqli_query($connectBdd, "SELECT * FROM annuaire_param_ua ORDER BY num_ua");
												while($resultUa2 = mysqli_fetch_assoc($queryUa2))
												{
													echo "<option value=\"".$resultUa2['id_Pua']."\">".$resultUa2['num_ua']." ".$resultUa2['lib_ua']."</option>";
												}
											?>
										</select>
									</div>
									
									<div class="row">
										<label class="col-lg-2">Actif</label>
										<input type="text" name="actif" value="<?php echo $resultUh['actif_uh']; ?>">&nbsp;&nbsp;
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