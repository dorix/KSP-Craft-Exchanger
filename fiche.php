<?php
include('fixe.php');
include('API.php');
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
	$CE = new hangar($bdd,'KSP-CE');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$req = $bdd->prepare('SELECT * FROM publications WHERE ID = ?');
	$req->execute(array($_GET['ID']));
	$data = $req->fetch();
	if($data['Nom'] != '')
	{
		$dlstring = '<'.$type.' class="btn btn-primary"'.$desactive.' href="dlpage.php?ID='.$data['ID'].'">Télécharger</'.$type.'>';
		$votes = new vote($CE, $_GET['ID']);
		function basicVote($votes)
		{
			$average = $votes->getAverage();
			if($average != NULL)
			{
				$green = $average * 100;
				$red = 100 - $green;
				$votesystem = ' <div class="progress">
									<div class="progress-bar progress-bar-success" style="width: '.$green.'%">
									</div>
									<div class="progress-bar progress-bar-primary" style="width: '.$red.'%">
									</div>
								</div>';
			}
			else
			{
				$votesystem = ' <div class="progress">
									<div class="progress-bar progress-bar-danger" style="width: 100%">
									</div>
								</div>';
			}
			return $votesystem;
		}
		if(isset($_SESSION['Utilisateur']))
		{
			if($_SESSION['Utilisateur'] == $data['Auteur'])
			{
				$dlstring = '<'.$type.' class="btn btn-warning"'.$desactive.' href="dlnomember.php?ID='.$data['ID'].'&MDP='.$data['MDP'].'">Télécharger</'.$type.'>';
				$votesystem = basicVote($votes);
			}
			else{}
			if($votes->getAlreadyVoted($_SESSION['Utilisateur']))
			{
				$votesystem = basicVote($votes);
			}
			elseif($_SESSION['Utilisateur'] != $data['Auteur'])
			{
				$average = $votes->getAverage();
				if($average == NULL){$average = 0.5; $empty = 1;}
				else{$empty = 0;}
				$green = $average * 100;
				$red = 100 - $green;
				if($empty == 1){
				$votesystem = ' <div class="progress">
									<div class="progress-bar progress-bar-danger" style="width: '.$green.'%">
									<a class="up" href="vote.php?ID='.$_GET['ID'].'&Note=1"><span class="glyphicon glyphicon-thumbs-up"></span></a>
									</div>
									<div class="progress-bar progress-bar-danger" style="width: '.$red.'%">
									<a class="down" href="vote.php?ID='.$_GET['ID'].'&Note=0"><span class="glyphicon glyphicon-thumbs-down"></span></a>
									</div>
								</div>';}
				else
				{
					$votesystem = ' <div class="progress">
									<div class="progress-bar progress-bar-success" style="width: '.$green.'%">
									<a class="up" href="vote.php?ID='.$_GET['ID'].'&Note=1"><span class="glyphicon glyphicon-thumbs-up"></span></a>
									</div>
									<div class="progress-bar progress-bar-primary" style="width: '.$red.'%">
									<a class="down" href="vote.php?ID='.$_GET['ID'].'&Note=0"><span class="glyphicon glyphicon-thumbs-down"></span></a>
									</div>
								</div>';
				}
			}
			else{}
		}
		else
		{
			$votesystem = basicVote($votes);
		}
		
		echo('<p><h1>'.$data['Nom'].'</h1><div class="table-responsive"><table class="table table-bordered fiche"><tbody>');
		echo('<tr><td class="col-sm-8"><img src="publications/'.$data['Nom'].'.'.$data['ImgExt'].'" class="img-responsive"></td><td class="col-sm-3"><strong>Description : </strong>'.$data['Descr'].'</td></tr>');
		echo('<tr><td><strong>Auteur : </strong>'.$data['Auteur'].'</td><td><strong>Prix : </strong>'.$data['Prix'].'</td></tr>');
		echo('<tr><td></td><td><strong>Votes : </strong>'.$votesystem.'</td></tr>');
		echo('<tr><td><strong>Type : </strong>'.$data['MODV'].', '.$data['SUB'].'</td><td>'.$dlstring.'</td></tr>');
		echo('</tbody></table></div></p>');
	}
	$req->closeCursor();
}
echo('</section>');
include('fin.php'); ?>