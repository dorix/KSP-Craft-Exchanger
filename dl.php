<?php include('fixe.php');
echo('<section class="col-xs-10">');
	include('BDD.php');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if(isset($_GET['categ']))
	{
		$req = $bdd->prepare('SELECT * FROM publications WHERE Categ = ?');
		$req->execute(array($_GET['categ']));
		$incr = 0;
		while($data = $req->fetch())
		{
			if($incr == 0){echo('<div class="row">');}
			echo('<div class="col-sm-6 col-md-4"><div class="thumbnail">
			<img src="publications/'.$data['Nom'].'.'.$data['ImgExt'].'" class="img-responsive"><div class="caption"><h3>'
			.$data['Nom'].'</h3><p><strong>Auteur : </strong><a href="dl.php?author='.$data['Auteur'].'">'.$data['Auteur'].'</a><br><strong>Prix : </strong>'.$data['Prix'].'<br><strong>Type : </strong>'.$data['SUB'].', '.$data['MODV'].'<br><strong>Description : </strong>'.$data['Descr'].'<br><br><a class="btn btn-primary yolo" href="fiche.php?ID='.$data['ID'].'">Voir la fiche</a>
			 </p></div></div></div>');
			$incr = $incr + 1;
			if($incr == 3){echo('</div>');$incr=0;}
		}
		$req->closeCursor();
	}
	
	if(isset($_GET['author']))
	{
		$req = $bdd->prepare('SELECT * FROM publications WHERE Auteur = ?');
		$req->execute(array($_GET['author']));
		$incr = 0;
		while($data = $req->fetch())
		{
			if($incr == 0){echo('<div class="row">');}
			echo('<div class="col-sm-6 col-md-4"><div class="thumbnail">
			<img src="publications/'.$data['Nom'].'.'.$data['ImgExt'].'" class="img-responsive"><div class="caption"><h3>'
			.$data['Nom'].'</h3><p><strong>Auteur : </strong><a href="dl.php?author='.$data['Auteur'].'">'.$data['Auteur'].'</a><br><strong>Catégorie : </strong>'.$data['Categ'].'<br><strong>Prix : </strong>'.$data['Prix'].'<br><strong>Type : </strong>'.$data['SUB'].', '.$data['MODV'].'<br><strong>Description : </strong>'.$data['Descr'].'<br><br><a class="btn btn-primary yolo" href="fiche.php?ID='.$data['ID'].'">Voir la fiche</a>
			 </p></div></div></div>');
			$incr = $incr + 1;
			if($incr == 3){echo('</div>');$incr=0;}
		}
		$req->closeCursor();
	}
echo('</section>');
include('fin.php'); ?>