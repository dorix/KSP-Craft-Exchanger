 <?php
include('fixe.php');
echo ('<section class="col-xs-10">');
if (isset($_GET['password']) && isset($_GET["username"]) && isset($_GET["amount"])) {
    if ($_GET['password'] == (md5($_GET["username"]) ^ sha1($_GET["amount"]) ^ md5("sdfSS(34R43zFds(YSzz4tDqdsdsq"))) {
        try {
            $bdd = new PDO('mysql:host=sql2.olympe.in;dbname=cxo2zffc', 'cxo2zffc', '4msupcqal4cadtjsc', array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
            ));
        }
        catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
        $_SESSION["Fonds"] = $_GET["amount"];
        $req = $bdd->prepare('UPDATE membres SET Funds = ? WHERE Pseudo = ?');
        $req->execute(array($_GET["amount"], $_GET["username"]));
        echo($_GET["amount"]);
        echo("<br>");
        echo($_GET["username"]);
        echo("<br>");
        echo($_GET["password"]);

    }
}

echo ('</section>');
include('fin.php');
?> 