<?php
session_start();
if(isset($_SESSION['Utilisateur']) && isset($_GET['ID']) && isset($_SESSION['Fonds']))
{
	try
	{
		$bdd = new PDO('mysql:host=sql2.olympe.in;dbname=cxo2zffc', 'cxo2zffc', '4msupcqal4cadtjsc');
	}
	catch (Exception $e)
	{
		die('Erreur: '. $e->getMessage());
	}
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$req = $bdd->prepare('SELECT * FROM publications WHERE ID = ?');
	$req->execute(array($_GET['ID']));
	$data = $req->fetch();
	if($_SESSION['Fonds'] >= $data['Prix'])
	{
		$req->closeCursor();
		$finalfunds = $_SESSION['Fonds'] - $data['Prix'];
		$_SESSION['Fonds'] = $finalfunds;
		$update = $bdd->prepare('UPDATE membres SET Funds = ? WHERE Pseudo = ?');
		$update->execute(array($finalfunds, $_SESSION['Utilisateur']));
		$giveto = $bdd->prepare('UPDATE membres SET Funds = Funds+? WHERE Pseudo = ?');
		$giveto->execute(array($data['Prix'], $data['Auteur']));
		$size = filesize('./publications/'.$data['Nom'].'.craft');
		session_write_close();
		header("Cache-Control: no-cache, must-revalidate");
		header("Cache-Control: post-check=0,pre-check=0");
		header("Cache-Control: max-age=0");
		header("Pragma: no-cache");
		header("Expires: 0");
		header("Content-Type: application/force-download");
		header('Content-Disposition: attachment; filename="'.$data['Nom'].'.craft"');
		header("Content-Length: ".$size);
		readfile('./publications/'.$data['Nom'].'.craft');
	}
	else
	{
		echo('<h1> Désolé, mais vous n\'avez pas assez de fonds</h1>');
	}
} ?>
