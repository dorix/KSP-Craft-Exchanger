<?php include('fixe.php'); ?>
		<section class="col-xs-10">
        <h1>KSP Craft Exchanger</h1>
        
        <p>Bonjour et bienvenue sur la plateforme d'échange de craft KSP Craft Exchanger.</p>
        <p>Ce site deviendra, à terme, une plateforme d'échange de craft pour KSP.</br>
		Vous pourrez envoyer des crafts, les télécharger, avec vos fonds de KSP glanés en mode carrière ou en vendant des crafts contre des fonds.</p>
		<p><em>Dès maintenant</em>, inscrivez-vous sur KSP Craft Exchanger et ayez à votre dispositions tous les fichiers craft de notre communauté. <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://kspce.olympe.in/" data-text="Site d'échange de craft communautaire" data-via="KSPCraftE" data-lang="fr" data-count="none" data-hashtags="KSPCE">Tweeter</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></p>
		<?php
		if(isset($_SESSION['Utilisateur']) == 0)
		{ echo('
		<p>
		<a href="inscription.php"><button class="btn btn-primary">Inscrivez-vous</button></a> 
		<a href="connection.php"><button class="btn btn-danger">Connectez-vous</button></a>
		</p>
		');}
		include('BDD.php');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$reponse = $bdd->query('SELECT * FROM publications ORDER BY ID DESC LIMIT 0,5');
		echo('<div class="col-sm-9"><div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner" role="listbox">');
		$i = 0;
		while ($data = $reponse->fetch())
		{
			if($i == 0)
			{
				$first = ' active';
			}
			else
			{
				$first = '';
			}
			echo('<div class="item'.$first.'">
					<img src="publications/'.$data['Nom'].'.'.$data['ImgExt'].'" alt="'.$data['Nom'].'">
					<div class="carousel-caption">
						<h3>'.$data['Nom'].'</h3>
						<a class="btn btn-primary" href="fiche.php?ID='.$data['ID'].'">Fiche</a>
					</div>
				</div>');
			$i = i + 1;
		}
		echo('</div>
		<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
		</div>
		</div>');
		?>
		</section>
<?php include('fin.php'); ?>