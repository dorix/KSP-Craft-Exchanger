<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="ANSI" />
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
		<script src="bootstrap/js/jquery-2.1.1.min.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
        <title>KSP craft exchanger</title>
    </head>

    <body>
		<div class="logo-background col-xs-2">
		<strong class="logo">KSP Craft Exchanger</strong></div>
		<nav class="menu item-menu-px">
		<ul>
			<li><a class="accu" href="index.php">Accueil</a></li>
			<?php
			if(isset($_SESSION['Utilisateur']) && $_SESSION['Utilisateur'] != '')
			{
			echo('
			<li><a class="publ" href="publier.php">Publier</a></li>
			<li></br></li>
			<li><a class="lien-menu" href="dl.php?categ=Lanceurs">Lanceurs</a></li>
			<li><a class="lien-menu" href="dl.php?categ=Navettes">Navettes</a></li>
			<li><a class="lien-menu" href="dl.php?categ=Sondes">Sondes</a></li>
			<li><a class="lien-menu" href="dl.php?categ=Rovers">Rovers</a></li>
			<li><a class="lien-menu" href="dl.php?categ=Satellites">Satellites</a></li>
			<li><a class="lien-menu" href="dl.php?categ=Vaisseaux">Vaisseaux</a></li>
			<li><a class="lien-menu" href="dl.php?categ=Avions">Avions</a></li>
			<li><a class="lien-menu" href="dl.php?categ=Inclassables">Inclassables</a></li>
			<li></br></li>
			<div style=" font-size: 95%;"><strong>Fonds : </strong>'. $_SESSION['Fonds'] .'</div>
			');
			}
			?>
		</ul>
		</nav>