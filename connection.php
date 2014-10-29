<?php include('fixe.php'); ?>
		<section class="col-xs-10" role="form">
        <h1>Connexion</h1>
		<form class="form-horizontal" role="form" method="POST" action="connection.php">
			<div class="form-group">
				<label for="Pseudo" class="col-sm-2 control-label">Pseudo</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" name="Pseudo" id="Pseudo" placeholder="Pseudo">
				</div>
			</div>
			<div class="form-group">
				<label for="MDP" class="col-sm-2 control-label">Mot de passe</label>
				<div class="col-sm-5">
					<input type="password" class="form-control" name="MDP" id="MDP" placeholder="Mot de passe">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-1">
					<input type="hidden" name="con" value="1"/>
					<button type="submit" class="btn btn-primary" name="connect" id="inscr">Connexion</button>
				</div>
			</div>
		</form>
		<?php 
		if(isset($_POST['Pseudo']) && $_POST['Pseudo'] != "")
		{
			if(isset($_POST['MDP']) && $_POST['MDP'] != "")
			{
				$pseudo = $_POST['Pseudo'];
				$password = md5($_POST['MDP']);
				$bdd = new PDO('mysql:host=sql2.olympe.in;dbname=cxo2zffc', 'cxo2zffc', '4msupcqal4cadtjsc', array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
					$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$req = $bdd->prepare('SELECT * FROM membres WHERE Pseudo = ?');
					$req->execute(array($pseudo));
					$data = $req->fetch();
					if($data['Pseudo'] != "" && $data['Password'] == $password)
					{
					$_SESSION['Utilisateur'] = $data['Pseudo'];
					$_SESSION['Fonds'] = $data['Funds'];
					echo('<div class="alert alert-success col-sm-5" role="alert"><h1>Connecté</h1><p>Vous étes connecté</p></div>');
					echo('<script language="javascript" type="text/javascript">
					<!--
					window.location.replace("index.php");
					-->
					</script>');
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