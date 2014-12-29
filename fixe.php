<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
		<link rel="alternate" href="kspce.olympe.in" hreflang="fr-fr" />
		<script src="bootstrap/js/jquery-2.1.1.min.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
        <title>KSP craft exchanger - Site d'échange de craft KSP communautaire - <?php echo($_SERVER['PHP_SELF']); ?></title>
		<meta name="google-site-verification" content="FtVGZDKKOgRibEVbSdlDaQ8zGCWyGzwOiEsYTmpM7Uk" />
    </head>

    <body>
		<div class="titlebar"><div class="titlebox"><img class="logoimg" src="logo2.svg"/><strong class="logo">KSP Craft Exchanger</strong></div></div>
		<nav class="menu item-menu-px">
		
		<ul>
			<li></br></li>
			<li><a class="accu" href="index.php">Accueil</a></li>
			<?php if(isset($_SESSION['Utilisateur']) && $_SESSION['Utilisateur'] != '')
			{echo('<li><a class="publ" href="publier.php">Publier</a></li>');} ?>
			<li></br></li>
			<li><a class="lien-menu" href="dl.php?categ=Rovers">Rovers</a></li>
			<li><a class="lien-menu" href="dl.php?categ=Avions">Avions</a></li>
			<li><a class="lien-menu" href="dl.php?categ=Lanceurs">Lanceurs</a></li>
			<li><a class="lien-menu" href="dl.php?categ=Sondes">Sondes</a></li>
			<li><a class="lien-menu" href="dl.php?categ=Satellites">Satellites</a></li>
			<li><a class="lien-menu" href="dl.php?categ=Vaisseaux">Vaisseaux</a></li>
			<li><a class="lien-menu" href="dl.php?categ=Stations">Stations</a></li>
			<li><a class="lien-menu" href="dl.php?categ=Bases">Bases</a></li>
			<li><a class="lien-menu" href="dl.php?categ=Navettes">Navettes</a></li>
			<li><a class="lien-menu" href="dl.php?categ=Inclassables">Inclassables</a></li>
			<?php
			if(isset($_SESSION['Utilisateur']) && $_SESSION['Utilisateur'] != '')
			{
			echo('<li></br></li>
			<div style=" font-size: 95%;"><strong>Fonds : </strong>'. $_SESSION['Fonds'] .'</div>
			');
			}
			echo("<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-57642885-1', 'auto');
  ga('send', 'pageview');

</script>");
			?>
			
		</ul>
		</nav>