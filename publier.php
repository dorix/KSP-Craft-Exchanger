<?php include('fixe.php'); 
	if(isset($_SESSION['Utilisateur']) && $_SESSION['Utilisateur'] != '')
	{
		echo('
		<section class="col-xs-10">
			<h1>Publier</h1>
			<p>Publiez votre création et récoltez des fonds !</p>
			<form class="form-horizontal" role="form" action="upload.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="Name" class="col-sm-3 control-label">Nom : </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="Name" id="Name" required>
					</div>
				</div>
				<div class="form-group">
					<label for="Prix" class="col-sm-3 control-label">Prix : </label>
					<div class="col-sm-5">
						<input type="number" min="0" step="100" max="500000" class="form-control" name="Prix" id="Prix" required>
					</div>
				</div>
				<div class="form-group">
					<label for="categ" class="col-sm-3 control-label">Catégorie : </label>
					<div class="col-sm-3">
						<select name="categ" id="categ" required>
							<option value="Lanceurs">Lanceurs</option>
							<option value="Navettes">Navettes</option>
							<option value="Sondes">Sondes</option>
							<option value="Rovers">Rovers</option>
							<option value="Satellites">Satellites</option>
							<option value="Vaisseaux">Vaisseaux</option>
							<option value="Stations">Stations</option>
							<option value="Bases">Bases</option>
							<option value="Avions">Avions</option>
							<option value="Inclassables">Inclassables</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="SUB" class="col-sm-3 control-label">Type : </label>
					<div class="col-sm-3">
						<select name="SUB" id="SUB" required>
							<option value="Vaisseau">Vaisseau</option>
							<option value="Subassemblie">Subassemblie</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="MOD" class="col-sm-3 control-label">Moddé/Vanilla : </label>
					<div class="col-sm-3">
						<select name="MOD" id="MOD" required>
							<option value="Vanilla">Vanilla</option>
							<option value="Moddé">Moddé</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="Desc" class="col-sm-3 control-label">Description : </label>
					<div class="col-sm-5">
						<textarea class="form-control" name="Desc" id="Desc" required></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="MDP" class="col-sm-3 control-label">Mot de passe de gratuité : </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="MDP" id="MDP" required/>
					</div>
				</div>
				<div class="form-group">
					<label for="craft" class="col-sm-3 control-label">Fichier craft : </label>
					<div class="col-sm-5">
						<input type="file" class="form-control" name="craft" id="craft" required>
					</div>
				</div>
				<div class="form-group">
					<label for="image" class="col-sm-3 control-label">Image : </label>
					<div class="col-sm-5">
						<input type="file" class="form-control" name="image" id="image" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-1">
						<button type="submit" class="btn btn-primary" name="inscr" id="inscr">Publier</button>
					</div>
				</div>
		</section>');
	}
include('fin.php'); ?>