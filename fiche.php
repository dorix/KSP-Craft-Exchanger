<?php
include('fixe.php');
echo('<section class="col-xs-10">');
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
	include('BDD.php');
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