<?php
// Vérifiez par phpinfo() le type d'accès à une base de données installé sur le système. 
// Ce fichier explique comment exploiter une base de données avec POO.
try 
{
  // Identifiants de connexion regroupés
  $host = 'localhost';
  $dbname = 'test';
  $userDB = 'vincent';
  $password = '';

  // Création d'un objet **pdo (*PHP Data Object) avec les identifiants de connexion
  $bdd = new PDO('mysql:host=' . $host .';dbname=' . $dbname . ';charset=utf8', $userDB, '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  echo "Connexion à la base de donnée réussie...";
 }
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}

 $req = $bdd->prepare('SELECT nom, commentaires FROM jeux_video WHERE possesseur= :possesseur ');
 $req->execute(array('possesseur' => $_GET['possesseur']));

 // On affiche chaque entrée une à une
 while($données = $req->fetch())
 {
 ?>
  <p>
    <strong> <?php echo $données['nom']; ?></strong><br />
    <em><?php echo $données['commentaires']; ?></em>
  </p>
<?php
}

$req->closeCursor();
?>
