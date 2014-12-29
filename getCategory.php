<?php
if(isset($_GET['Category']))
{
	include('API.php');
	include('BDD.php');
	$CE = new hangar($bdd,'KSP-CE');
	$recherche = new search($CE);
	$resultat = $recherche->Category($_GET['Category']);
	echo(json_encode($resultat));
}
?>