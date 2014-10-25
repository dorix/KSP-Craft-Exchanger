<?php include('fixe.php'); ?>
		<section class="col-xs-10">
        <h1>KSP Craft Exchanger</h1>
        
        <p>Bonjour et bienvenue sur la plateforme d'échange de craft KSP Craft Exchanger.</p>
        <p>Ce site deviendra, à terme, une plateforme d'échange de craft pour KSP.</br>
		Vous pourrez envoyer des crafts, les télécharger, avec vos fonds de KSP glanés en mode carrière ou en vendant des crafts contre des fonds.</p>
		<p><em>Dès maintenant</em>, inscrivez-vous sur KSP Craft Exchanger et ayez à votre dispositions tous les fichiers craft de notre communauté.</p>
		<?php
		if(isset($_SESSION['Utilisateur']) == 0)
		{ echo('
		<a href="inscription.php"><button class="btn btn-primary">Inscrivez-vous</button></a> 
		<a href="connection.php"><button class="btn btn-danger">Connectez-vous</button></a>
		');}
		?>
		</section>
<?php include('fin.php'); ?>