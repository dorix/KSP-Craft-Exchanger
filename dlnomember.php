<?php
session_start();
if(isset($_GET['ID']) && isset($_GET['MDP']))
{
	try
	{
		$bdd = new PDO('mysql:host=sql2.olympe.in;dbname=cxo2zffc', 'cxo2zffc', '4msupcqal4cadtjsc', array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
	}
	catch (Exception $e)
	{
		die('Erreur: '. $e->getMessage());
	}
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$req = $bdd->prepare('SELECT * FROM publications WHERE ID = ?');
	$req->execute(array($_GET['ID']));
	$data = $req->fetch();
	if($_GET['MDP'] == $data['MDP'])
	{
		$req->closeCursor();
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
		echo('<h1> Désolé, mais vous n\'avez pas assez de fond</h1>');
	}
}
else
{
	echo('<script language="javascript" type="text/javascript">
					<!--
					window.location.replace("index.php");
					-->
					</script>');
} ?>