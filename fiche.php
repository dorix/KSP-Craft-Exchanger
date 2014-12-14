<?php
include('fixe.php');
echo('<section class="col-xs-10">');
echo("<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-57642885-1', 'auto');
  ga('send', 'pageview');

</script>");
if(isset($_GET['ID']))
{
	if(isset($_SESSION['Utilisateur']))
	{
		$type = 'a';
		$desactive = '';
	}
	else
	{
		$type = 'span';
		$desactive = ' disabled="disabled"';
	}
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
	if($data['Nom'] != '')
	{
		echo('<p><h1>'.$data['Nom'].'</h1><div class="table-responsive"><table class="table table-bordered fiche"><tbody>');
		echo('<tr><td class="col-sm-8"><img src="publications/'.$data['Nom'].'.'.$data['ImgExt'].'" class="img-responsive"></td><td class="col-sm-3"><strong>Description : </strong>'.$data['Descr'].'</td></tr>');
		echo('<tr><td><strong>Auteur : </strong>'.$data['Auteur'].'</td><td><strong>Prix : </strong>'.$data['Prix'].'</td></tr>');
		echo('<tr><td><strong>Type : </strong>'.$data['MODV'].', '.$data['SUB'].'</td><td><'.$type.' class="btn btn-primary"'.$desactive.' href="dlpage.php?ID='.$data['ID'].'">Télécharger</'.$type.'></td></tr>');
		echo('</tbody></table></div></p>');
	}
	$req->closeCursor();
}
echo('</section>');
include('fin.php'); ?>