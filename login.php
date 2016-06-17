<?php 
if (isset($_POST['Connecter']))
{
	$pseudo = $_POST['pseudo'];
// Hachage du mot de passe
$pass_hache = sha1($_POST['mdp']);

// Vérification des identifiants
include ('connect.php');
$req = $bdd->prepare('SELECT id FROM users WHERE pseudo = :pseudo AND mdp = :mdp');
$req->execute(array(
    'pseudo' => $pseudo,
    'mdp' => $pass_hache));

$resultat = $req->fetch();

if ($resultat['id'] > 0)
{
    session_start();
    $_SESSION['id'] = $resultat['id'];
    $_SESSION['pseudo'] = $pseudo;
	header('Location: index.php');
}  
}
?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width"/>

<title>Uzinanem</title>

<link href="jquery-mobile/jquery.mobile.theme-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<link href="jquery-mobile/jquery.mobile.structure-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="jquery-mobile/jquery.mobile-1.3.0.min.js" type="text/javascript"></script>
<script src="jquery-mobile/listeproduit.js" type="text/javascript"></script>

</head>
<body>
<div data-role="page" id="Login">
  <div data-role="header">
    <h1>Login</h1>
  </div>
  <div data-role="content">
    <form method="post" action="login.php">
      <label for="pseudo"><strong><center>Utilisateur :</center></strong></label>
        <input type="text" name="pseudo"/>
      <label for="pseudo"><strong><center>Mot de passe :</center></strong></label>
        <input type="password" name="mdp"/>
        <input type="submit" name="Connecter" value="Se connecter"/></form>
<?php
	if (isset ($_POST['Connecter']) && !$resultat)
{
    echo '<center><font color="red">Mauvais identifiant ou mot de passe !</font></center>';
}
?>
<p></p>
</div>

<?php include ('footer.php'); ?>