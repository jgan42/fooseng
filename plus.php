<?php include ('header.php'); ?>
<!DOCTYPE html> 
<html><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Ajouts</title>
<link href="jquery-mobile/jquery.mobile.theme-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<link href="jquery-mobile/jquery.mobile.structure-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="jquery-mobile/jquery.mobile-1.3.0.min.js" type="text/javascript"></script>


</head>
<body>
<div data-role="page" id="Ajouts">
	<div data-role="header">
		<h1>Ajouts</h1>
	</div>
	<div data-role="content">	
<?php

  if (isset ($_POST['Valider']))
            $Groupe=$_POST['Groupe'];
            $Produit=$_POST['Produit'];
            $Stock123=$_POST['Stock123'];
            $Plus=$_POST['Plus']+(48*$_POST['Palettes']);
			
	if ($Groupe == "--- Groupe ---" OR $Produit == "--- Produit ---" OR $Stock123 == "Dans quel stock ?" OR $Plus == "")
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

$req = $bdd->prepare('INSERT INTO mvt(Groupe, Produit, Plus'.$Stock123.')
VALUES(:Groupe, :Produit, :Plus)');
                         
$req->execute(array(
'Groupe' => $Groupe,
'Produit' => $Produit,
'Plus' => $Plus,
));
if (!$req) {exit ('Erreur');}
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
      <td><center><strong>Prod.</center></strong></td>
      <td><center><strong><?php if($_POST['Palettes']>0) {echo $_POST['Palettes'].'P';} if($_POST['Palettes']>0 && $_POST['Plus']>0) {echo '|';} if($_POST['Plus']>0) {echo $_POST['Plus'].'C';} ?> "<?php echo $Groupe.' '.$Produit; ?>"</center></strong></td>
      <td><center><strong>Stock <?php echo $Stock123; ?></center></strong></td>
    </tr>
    <tr>
      <td><img src="img/prod.png" id="forme"/></td>
      <td><img src="img/mvt2.gif" id="forme"/></td>
      <td><img src="img/stock.png" id="forme"/></td>
    </tr>
</table>


<button type="button" onclick="location.href='index.php#Production'">Ajouter un autre produit</button>
<form method="post" action="cancel.php">
        <button type="submit" name="Annuler" value="<?php echo $id; ?>">Annuler</button>
        </select>
</form>
</div>
<?php include ('footer.php'); ?>