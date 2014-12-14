<?php include('fixe.php'); ?>
		<section class="col-xs-10">
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-57642885-1', 'auto');
			ga('send', 'pageview');
		</script>
        <h1>KSP Craft Exchanger</h1>
        
        <p>Bonjour et bienvenue sur la plateforme d'échange de craft KSP Craft Exchanger.</p>
        <p>Ce site deviendra, à terme, une plateforme d'échange de craft pour KSP.</br>
		Vous pourrez envoyer des crafts, les télécharger, avec vos fonds de KSP glanés en mode carrière ou en vendant des crafts contre des fonds.</p>
		<p><em>Dès maintenant</em>, inscrivez-vous sur KSP Craft Exchanger et ayez à votre dispositions tous les fichiers craft de notre communauté.</p>
		<?php
		if(isset($_SESSION['Utilisateur']) == 0)
		{ echo('
		<p>
		<a href="inscription.php"><button class="btn btn-primary">Inscrivez-vous</button></a> 
		<a href="connection.php"><button class="btn btn-danger">Connectez-vous</button></a>
		</p>
		');}
		try
		{
			$bdd = new PDO('mysql:host=sql2.olympe.in;dbname=cxo2zffc', 'cxo2zffc', '4msupcqal4cadtjsc', array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
		}
		catch (Exception $e)
		{
			die('Erreur: '. $e->getMessage());
		}
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