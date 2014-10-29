<?php include('fixe.php'); ?>
		<section class="col-xs-10" role="form">
        <h1>Inscription</h1>
		<p>Inscrivez-vous dès maintenant sur notre plateforme via ce formulaire et profitez dès a présent de tous les crafts disponibles sur notre plateforme.</p>
		<form class="form-horizontal" role="form" method="POST" action="inscription.php">
			<div class="form-group">
				<label for="Pseudo" class="col-sm-3 control-label">Pseudo</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" name="Pseudo" id="Pseudo" placeholder="Pseudo">
				</div>
			</div>
			<div class="form-group">
				<label for="MDP" class="col-sm-3 control-label">Mot de passe</label>
				<div class="col-sm-5">
					<input type="password" class="form-control" name="MDP" id="MDP" placeholder="Mot de passe">
				</div>
			</div>
			<div class="form-group">
				<label for="MDPC" class="col-sm-3 control-label">Confirmez le mot de passe</label>
				<div class="col-sm-5">
					<input type="password" class="form-control" name="MDPC" id="MDPC" placeholder="Confirmation">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-1">
					<input type="hidden" name="inscrip" value="1"/>
					<button type="submit" class="btn btn-primary" name="inscr" id="inscr">Inscription</button>
				</div>
			</div>
		</form>
		<?php
		if(isset($_POST['Pseudo']) && $_POST['Pseudo'] != "")
		{
			if(isset($_POST['MDP']) && isset($_POST['MDPC']) && $_POST['MDP'] != "" && $_POST['MDPC'] != "")
			{
				if($_POST['MDP'] == $_POST['MDPC'])
				{
					$pseudo = $_POST['Pseudo'];
					$password = md5($_POST['MDP']);
					$bdd = new PDO('mysql:host=sql2.olympe.in;dbname=cxo2zffc', 'cxo2zffc', '4msupcqal4cadtjsc');
					$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$req = $bdd->prepare('SELECT Pseudo FROM membres WHERE Pseudo = ?');
					$req->execute(array($pseudo));
					$data = $req->fetch();
						if($data['Pseudo'] == '')
						{
						$req->closeCursor();
						$addm = $bdd->prepare("INSERT INTO membres(ID, Pseudo, Password,Funds,Idtrans,Nbrtrans) VALUES('', ? , ? ,'5000','1','0')");
						$addm->execute(array($pseudo,$password));
						echo('<div class="alert alert-success col-sm-5" role="alert"><h1>Bienvenue !</h1>
						<p>Vous êtes maintenant inscrit sur notre plateforme. Que diriez vous d\'aller regarder les créations de nos membres ?</p>
						</div>');
						}
				}
				else
				{
					echo('<div class="alert alert-warning col-sm-5" role="alert"><h1>Erreur</h1><p>Mots de passes non concordants</p></div>');
				}
			}
			else
			{
				echo('<div class="alert alert-warning col-sm-5" role="alert"><h1>Erreur</h1><p>Mot de passe manquant</p></div>');
			}
		}
		elseif(isset($_POST['inscrip']))
		{
			echo('<div class="alert alert-warning col-sm-5" role="alert"><h1>Erreur</h1><p>Pseudo manquant</p></div>');
		}
		?>
		</section>
<?php include('fin.php'); ?>
