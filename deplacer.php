<?php include ('header.php'); ?>
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Deplacements</title>
<link href="jquery-mobile/jquery.mobile.theme-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<link href="jquery-mobile/jquery.mobile.structure-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="jquery-mobile/jquery.mobile-1.3.0.min.js" type="text/javascript"></script>
 </head> 
<body>
<div data-role="page" id="Deplacements">
	<div data-role="header">
		<h1>Deplacements</h1>
	</div>
	<div data-role="content">	
<?php

  if (isset ($_POST['Valider']))
            $Groupe=$_POST['Groupe'];
            $Produit=$_POST['Produit'];
            $Stock123=$_POST['Stock123'];
            $Stock1234=$_POST['Stock1234'];
            $Plus=$_POST['Plus']+(48*$_POST['Palettes']);
			
	if ($Groupe == "--- Groupe ---" OR $Produit == "--- Produit ---" OR $Stock123 == "Depuis quel stock ?" OR $Stock1234 == "Vers quel stock ?" OR $Plus == "")
{
	exit('<strong><center>Il manque une information !</center></strong> <button type="button" onclick="window.history.back();">Corriger</button>
	</div>
	<div data-role="footer">
		<h4><a href="#" onclick="location.href=\'index.php\'">Accueil</a></h4>
	</div>
</div>

</body>
</html>');
}


include ('connect.php');

$reponse = $bdd->prepare('SELECT Groupe, Produit, SUM(Plus1), SUM(Plus2), SUM(Plus3), SUM(Moins1), SUM(Moins2), SUM(Moins3) FROM mvt WHERE Groupe = :Groupe AND Produit = :Produit');
$reponse->bindValue(':Groupe', $Groupe, PDO::PARAM_STR);
$reponse->bindValue(':Produit', $Produit, PDO::PARAM_STR);
$reponse->execute();
$stock = $reponse->fetch();

if (!$reponse) {exit ('Erreur');}

$Stockp = ($stock['SUM(Plus'.$Stock123.')'] - $stock['SUM(Moins'.$Stock123.')']);
	if($Plus > $Stockp)
{
	exit('<strong><center>Il n\'y a que '.$Stockp.' cartons de '.$Groupe.' '.$Produit.' dans le stock '.$Stock123.' ! Impossible de déplacer '.$Plus.' Cartons depuis ce stock ! </center></strong> <button type="button" onclick="window.history.back();">Corriger</button> 
	</div>
	<div data-role="footer">
		<h4><a href="#" onclick="location.href=\'index.php\'">Accueil</a></h4>
	</div>
</div>

</body>
</html>');
}

$req = $bdd->prepare('INSERT INTO mvt(Groupe, Produit, Plus'.$Stock123.', Plus'.$Stock1234.')
VALUES(:Groupe, :Produit, :Plus, :Vers)');
                         
$req->execute(array(
'Groupe' => $Groupe,
'Produit' => $Produit,
'Plus' => -$Plus,
'Vers' => $Plus,
));
$id = $bdd->lastInsertId();

?>
<style type='text/css'>
table.fixed {
    table-layout: fixed;
}
table.fixed td {
	overflow: hidden;
}
img#forme {
    width: 100%;
    height: auto;
}

</style>
<table class="fixed" align="center" width="98%"><col width="24%" /><col width="50%" /><col width="24%" />
    <tr>
      <td><center><strong>Stock <?php echo $Stock123; ?></center></strong></td>
      <td><center><strong><?php if($_POST['Palettes']>0) {echo $_POST['Palettes'].'P';} if($_POST['Palettes']>0 && $_POST['Plus']>0) {echo '|';} if($_POST['Plus']>0) {echo $_POST['Plus'].'C';} ?> "<?php echo $Groupe.' '.$Produit; ?>"</center></strong></td>
      <td><center><strong>Stock <?php echo $Stock1234; ?></center></strong></td>
    </tr>
    <tr>
      <td><img src="img/stock.png" id="forme"/></td>
      <td><img src="img/mvt2.gif" id="forme"/></td>
      <td><img src="img/stock.png" id="forme"/></td>
    </tr>
</table>

<button type="button" onclick="location.href='index.php#Deplacements'">Déplacer un autre produit</button>
<form method="post" action="cancel.php">
        <button type="submit" name="Annuler" value="<?php echo $id; ?>">Annuler</button>
        </select>
</form>
	</div>
<?php include ('footer.php'); ?>