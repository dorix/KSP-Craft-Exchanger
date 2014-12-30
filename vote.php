<?php
session_start();
include('API.php');
if(isset($_GET['ID']) && isset($_GET['Note']) && isset($_SESSION['Utilisateur']))
{
	include('BDD.php');
	$CE = new hangar($bdd,'KSP-CE');
	$votes = new vote($CE, $_GET['ID']);
	echo($votes->push($_SESSION['Utilisateur'],$_GET['Note']));
}
echo('<script language="javascript" type="text/javascript">
					<!--
					window.location.replace("index.php");
					-->
					</script>');
?>
