<?php
if(isset($_GET['ID']))
{
	include('API.php');
	include('BDD.php');
	$CE = new hangar($bdd,'KSP-CE');
	$publication = new publication($CE);
	$publication->pull($_GET['ID']);
	$publicatableau = $publication->getDatas();
	echo(json_encode($publicatableau));
}
?>