<?php include('fixe.php');
echo('<section class="col-xs-10">');
if(isset($_SESSION['Utilisateur']) && isset($_GET['categ']))
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
	$req = $bdd->prepare('SELECT * FROM publications WHERE Categ = ?');
	$req->execute(array($_GET['categ']));
	echo('<p><div class="table-responsive"><table class="table table-hover table-bordered">
	<thead><tr><th>Image</th><th>Nom</th><th>Auteur</th><th>Prix</th><th>Type</th><th>Descritption</th><th>Lien de téléchargement</th></tr></thead><tbody>');
	while($data = $req->fetch())
	{
		echo('<tr><td class="imgcell"><img src="publications/'.$data['Nom'].'.'.$data['ImgExt'].'" class="img-circle img-responsive"></td>'.
		'<td>'.$data['Nom'].'</td><td>'.$data['Auteur'].'</td><td>'.$data['Prix'].'</td><td>'.$data['SUB'].', '.$data['MODV'].'</td><td>'.$data['Descr'].'</td><td><a class="btn btn-primary" href="fiche.php?ID='.$data['ID'].'">Téléchargement</a></td></tr>');
	}
	echo('</tbody></table></div></p>');
}
echo('</section>');
include('fin.php'); ?>