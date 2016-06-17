<?php include ('header.php'); ?>
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

<div data-role="page" id="newpass">
  <div data-role="header">
    <h1>Changer de Mot de passe</h1>
  </div>
  <div data-role="content">
<form method="post" action="newpass.php">
      <label for="old"><strong><center>Ancien Mot de passe :</center></strong></label>
        <input type="password" name="mdp"/>
      <label for="new"><strong><center>Nouveau Mot de passe :</center></strong></label>
        <input type="password" name="new"/>
      <label for="new"><strong><center>Confirmer Mot de passe :</center></strong></label>
        <input type="password" name="newverif"/>
        <input type="submit" name="Changer" value="Changer"/></form>
<?php
if (isset($_POST['Changer']))
{
	if ($_POST['mdp'] != '' && $_POST['new'] != '' && $_POST['newverif'] != '')
{
include ('connect.php');

$pass_hache = sha1($_POST['mdp']);
$req = $bdd->prepare('SELECT id FROM users WHERE pseudo = :pseudo AND mdp = :mdp');
$req->execute(array(
    'pseudo' => $_SESSION['pseudo'],
    'mdp' => $pass_hache));

$resultat = $req->fetch();

if ($resultat['id'] > 0)
{
	if ($_POST['new'] != $_POST['newverif'])
	{echo '<center><font color="red">Les nouveaux mots de passe sont différents !</font></center>';}

else {	
$new_hache = sha1($_POST['new']);
$req2 = $bdd->prepare('UPDATE users SET mdp = :mdp WHERE pseudo = :pseudo');
$req2->execute(array('mdp' => $new_hache,'pseudo' => $_SESSION['pseudo']));
echo '<center>Mot de passe mis à jour !</center>';
}
}
else {	echo '<center><font color="red">Mauvais mot de passe !</font></center>';}
}
else {	echo '<center><font color="red">Veuillez remplir tous les champs !</font></center>';}
}
?>
<p></p>
</div>

<?php include ('footer.php'); ?>