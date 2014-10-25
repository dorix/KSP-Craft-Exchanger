<?php include('fixe.php');
echo('<section class="col-xs-10">');
if(isset($_POST['Name']) && isset($_POST['Desc']) && isset($_POST['Prix']) && isset($_POST['categ']) && isset($_FILES['craft']) && isset($_FILES['image']) && $_FILES['craft']['error'] == 0 && $_FILES['image']['error'] == 0)
{
	$nom = strip_tags($_POST['Name']); // Définition des variables
	$prix = $_POST['Prix'];
	$categ = $_POST['categ'];
	$desc = strip_tags($_POST['Desc']);
	$craftinfo = pathinfo($_FILES['craft']['name']);
	$extcraft = $craftinfo['extension'];
	$imginfo = pathinfo($_FILES['image']['name']);
	$extimg = $imginfo['extension'];
	$autorext = array('jpg','jpeg','gif','png');
	 // Verification sur la bdd
	try
	{
		$bdd = new PDO('mysql:host=sql2.olympe.in;dbname=cxo2zffc', 'cxo2zffc', '4msupcqal4cadtjsc');
	}
	catch (Exception $e)
	{
		die('Erreur: '. $e->getMessage());
	}
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$req = $bdd->prepare('SELECT Nom FROM publications WHERE Nom = ?');
	$req->execute(array($nom));
	$data = $req->fetch();
	if($data['Nom'] == '' && in_array($extimg, $autorext) && $extcraft == 'craft')
	{
		$req->closeCursor();
		move_uploaded_file($_FILES['craft']['tmp_name'], 'publications/'.$nom.'.craft'); // On met les fichiers où il faut
		move_uploaded_file($_FILES['image']['tmp_name'], 'publications/'.$nom.'.'.$extimg);
		$addc = $bdd->prepare("INSERT INTO publications(ID, Nom, Auteur, Categ, Prix, ImgExt, Descr) VALUES('', ? , ? , ? , ? , ? , ?)"); // On ajoute tout ça dans la BDD
		$addc->execute(array($nom,$_SESSION['Utilisateur'],$categ,$prix,$extimg,$desc));
		echo('<p>Création ajoutée à notre catalogue.</p>');
	}
	else
	{
		$req->closeCursor();
		echo('<p><h1>Oups</h1> Il y a eu une erreur dans l\'envoi de vos fichiers. Véfifier le nom de votre création et les extentsions de vos fichiers. Nous précisons que nous ne prenons en charge que les extensions d\'images suivantes : jpeg, jpg, gif et png. Il est aussi possible que le nom que vous ayez choisi soit déja pris.</p>');
	}
}
echo('</section>');
include('fin.php'); ?>