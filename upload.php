<?php include('fixe.php');
include('API.php');
echo('<section class="col-xs-10">');
if(isset($_POST['MDP']) && isset($_POST['DescCom']) && isset($_POST['MOD']) && isset($_POST['SUB']) && isset($_POST['Name']) && isset($_POST['Desc']) && isset($_POST['Prix']) && isset($_POST['categ']) && isset($_FILES['craft']) && isset($_FILES['image']) && $_FILES['craft']['error'] == 0 && $_FILES['image']['error'] == 0)
{
	$nom = strip_tags($_POST['Name']); // Definition des variables
	$MDP = strip_tags($_POST['MDP']);
	$MOD = $_POST['MOD'];
	$SUB = $_POST['SUB'];
	$prix = $_POST['Prix'];
	$categ = $_POST['categ'];
	$desc = strip_tags($_POST['Desc']);
	$advdesc = $_POST['DescCom'];
	$craftinfo = pathinfo($_FILES['craft']['name']);
	$extcraft = $craftinfo['extension'];
	$imginfo = pathinfo($_FILES['image']['name']);
	$extimg = $imginfo['extension'];
	$autorext = array('jpg','jpeg','gif','png');
	 // Verification sur la bdd
	include('BDD.php');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$CE = new hangar($bdd,'KSP-CE');
	$req = $bdd->prepare('SELECT Nom FROM publications WHERE Nom = ?');
	$req->execute(array($nom));
	$data = $req->fetch();
	if($data['Nom'] == '' && in_array($extimg, $autorext) && $extcraft == 'craft')
	{
		$req->closeCursor();
		move_uploaded_file($_FILES['craft']['tmp_name'], 'publications/'.$nom.'.craft'); // On met les fichiers ou il faut
		move_uploaded_file($_FILES['image']['tmp_name'], 'publications/'.$nom.'.'.$extimg);
		$addc = $bdd->prepare("INSERT INTO publications(ID, Nom, Auteur, Categ, Prix, ImgExt, Descr, MDP, MODV, SUB) VALUES('', ? , ? , ? , ? , ? , ? , ? , ? , ? )"); // On ajoute tout ca dans la BDD
		$addc->execute(array($nom,$_SESSION['Utilisateur'],$categ,$prix,$extimg,$desc,$MDP,$MOD,$SUB));
		$req2 = $bdd->prepare('SELECT * FROM publications WHERE Nom = ?');
		$req2->execute(array($nom));
		$data2 = $req2->fetch();
		$ADVdesc = new advancedDescription($CE);
		$ADVdesc->push($data2['ID'], $advdesc);
		echo('<h2>Création ajoutée à notre catalogue.</h2><p>Le lien public de téléchargement sans compte est : http://kspce.olympe.in/dlnomember?ID='.$data2['ID'].'&MDP='.$data2['MDP'].'</p>');
		
	}
	else
	{
		$req->closeCursor();
		echo('<p><h1>Oups</h1> Il y a eu une erreur dans l\'envoi de vos fichiers. Véfifiez le nom de votre création et les extentsions de vos fichiers. Nous précisons que nous ne prenons en charge que les extensions d\'images suivantes : jpeg, jpg, gif et png. Il est aussi possible que le nom que vous ayez choisi soit déja pris.</p>');
	}
}
echo('</section>');
include('fin.php'); ?>