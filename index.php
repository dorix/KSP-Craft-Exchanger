<?php include('fixe.php'); ?>
		<section class="col-xs-10">
        <h1>KSP Craft Exchanger</h1>
        
        <p>Bonjour et bienvenue sur la plateforme d'�change de craft KSP Craft Exchanger.</p>
        <p>Ce site deviendra, � terme, une plateforme d'�change de craft pour KSP.</br>
		Vous pourrez envoyer des crafts, les t�l�charger, avec vos fonds de KSP glan�s en mode carri�re ou en vendant des crafts contre des fonds.</p>
		<p><em>D�s maintenant</em>, inscrivez-vous sur KSP Craft Exchanger et ayez � votre dispositions tous les fichiers craft de notre communaut�.</p>
		<?php
		if(isset($_SESSION['Utilisateur']) == 0)
		{ echo('
		<a href="inscription.php"><button class="btn btn-primary">Inscrivez-vous</button></a> 
		<a href="connection.php"><button class="btn btn-danger">Connectez-vous</button></a>
		');}
		?>
		</section>
<?php include('fin.php'); ?>