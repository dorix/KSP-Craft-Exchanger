<?php
class hangar // Cet objet est unique par hangar, il servira à donner certaines informations spécifiques pour certains usages et à fournir la base de donnée.
{
	private $PDO;
	private $Nom;
	
	public function __construct(PDO $bdd, $nom)
	{
		$this->PDO = $bdd;
		$this->Nom = $nom;
	}
	
	public function setName($nom)
	{
		$this->Nom = $nom;
	}
	
	public function getName()
	{
		return $this->Nom;
	}
	
	public function getDB()
	{
		return $this->PDO;
	}
}

class publication // Cette classe sert à gérer les publications.
{
	private $Hangar;
	private $ID;
	private $Nom;
	private $Auteur;
	private $Categorie;
	private $Modde;
	private $Subassembly;
	private $Description;
	private $ImgExt;
	private $Request;
	private $Autorext = array('jpg','jpeg','gif','png');
	
	public function __construct(hangar $hangar) // On set le hangar dès le début, quand même
	{
		$this->Hangar = $hangar;
	}
	
	public function setDatas($nom, $auteur, $categorie, $modde, $subassembly, $description, $imgExt) // On met toutes les données qu'on a besoin
	{
		$this->Nom = $nom;
		$this->Auteur = $auteur;
		$this->Categorie = $categorie;
		$this->Modde  = $modde;
		$this->Subassembly = $subassembly;
		$this->Description = $description;
		$this->ImgExt = $imgExt;
	}
	
	public function getDatas() // retourne un tableau contenant toutes les données de la publication.
	{
		return array(
		'ID'=>$this->ID,
		'Name'=>$this->Nom,
		'Author'=>$this->Auteur,
		'Category'=>$this->Categorie,
		'Modded'=>$this->Modde,
		'Subassembly'=>$this->Subassembly,
		'Description'=>$this->Description,
		'CraftPATH'=>$this->Categorie.'/'.$this->Nom.'.craft',
		'ImgPATH'=>$this->Categorie.'/'.$this->Nom.'.'.$this->ImgExt
		);
	}
	
	public function push($craftname, $imgname) // On envoie la publication sur la bdd et le serveur
	{
		$BDD = $this->Hangar->getDB();
		$this->Request = $BDD->prepare('SELECT Nom FROM publications WHERE Nom = ?'); // Vérification de si le nom existe déjà
		$this->Request->execute(array($this->Nom));
		$data = $this->Request->fetch();
		$craftinfo = pathinfo($_FILES[$craftname]['name']);
		$extcraft = $craftinfo['extension'];
		$imginfo = pathinfo($_FILES[$imgname]['name']);
		$extimg = $imginfo['extension'];
		if($data['Nom'] == '' && in_array($extimg, $this->Autorext) && $extcraft == 'craft')
		{
			$this->Request->closeCursor();
			move_uploaded_file($_FILES[$craftname]['tmp_name'], 'publications/'.$this->Categorie.'/'.$this->Nom.'.craft'); // On met les fichiers ou il faut
			move_uploaded_file($_FILES[$imgname]['tmp_name'], 'publications/'.$this->Categorie.'/'.$this->Nom.'.'.$extimg);
			$this->Request = $BDD->prepare("INSERT INTO publications(ID, Nom, Auteur, Categ, ImgExt, Descr, MODV, SUB) VALUES('', ? , ? , ? , ? , ? , ? , ? )"); // On ajoute tout ca dans la BDD
			$this->Request->execute(array($this->Nom,$this->Auteur,$this->Categorie,$this->ImgExt,$this->Description,$this->Modde,$this->Subassembly));
			$this->Request = $BDD->prepare('SELECT * FROM publications WHERE Nom = ?');
			$this->Request->execute(array($this->Nom));
			$data2 = $this->Request->fetch();
			return $data2['ID'];
		}
		else
		{
			$this->Request->closeCursor();
			return "Error : Name already exist or the extensions don't match with the autorized extensions."; // Petit retour d'erreur, au cas où
		}
	}
	
	public function pull($id)
	{
		$BDD = $this->Hangar->getDB();
		$this->Request = $BDD->prepare('SELECT * FROM publications WHERE ID = ?');
		$this->Request->execute(array($id));
		$data = $this->Request->fetch();
		
		$this->ID = $data['ID'];
		$this->Nom = $data['Nom'];
		$this->Auteur = $data['Auteur'];
		$this->Categorie = $data['Categ'];
		$this->Modde  = $data['MODV'];
		$this->Subassembly = $data['SUB'];
		$this->Description = $data['Descr'];
		$this->ImgExt = $data['ImgExt'];
		
		$this->Request->closeCursor();
		return $this->getDatas();
	}
}

class vote // La zolie classe de vote
{
	private $Hangar;
	private $ID;
	
	public function __construct(hangar $hangar, $id) // On met les chôses fixes direct histoire de gagner du temps
	{
		$this->Hangar = $hangar;
		$this->ID = $id;
	}
	
	public function push($member, $value) // On met tout dans la BDD
	{
		$BDD = $this->Hangar->getDB();
		$req = $BDD->prepare('SELECT * FROM votes WHERE Membre = ? AND IDpub = ?'); // On teste si le membre a déja voté pour la publication (ce serait bête de voter deux fois)
		$req->execute(array($member, $this->ID));
		$data = $req->fetch();
		if($data['ID'] == NULL)
		{
			$req = $BDD->prepare("INSERT INTO votes(ID, IDpub, Membre, Note) VALUES('', ? , ? , ?)"); // On inscrit le vote
			$req->execute(array($this->ID, $member, $value));
		}
		else
		{
			return "This member has already voted for this creation";
		}
	}
	
	public function getAverage()
	{
		$BDD = $this->Hangar->getDB();
		$req = $BDD->prepare('SELECT * FROM votes WHERE IDpub = ?');
		$req->execute(array($this->ID));
		$value = 0.0;
		$i = 0.0;
		while($data = $req->fetch()) // On calcule la moyenne
		{
			$value = $value + $data['Note'];
			$i++;
		}
		if($i>0.0)
		{
			$average = $value / $i;
		}
		else
		{
			$average = 'Empty';
		}
		return $average;
	}
	
	public function getAlreadyVoted($member)
	{
		$BDD = $this->Hangar->getDB();
		$req = $BDD->prepare('SELECT * FROM votes WHERE Membre = ? AND IDpub = ?'); // On teste si le membre a déja voté pour la publication
		$req->execute(array($member, $this->ID));
		$data = $req->fetch();
		if($data['ID'] == NULL)
		{
			return False;
		}
		else
		{
			return True;
		}
	}
}


?>