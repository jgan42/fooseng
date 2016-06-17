<?php include ('header.php'); ?>
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Sorties V2</title>
<link href="jquery-mobile/jquery.mobile.theme-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<link href="jquery-mobile/jquery.mobile.structure-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="jquery-mobile/jquery.mobile-1.3.0.min.js" type="text/javascript"></script>
</head>
<body>
<div data-role="page" id="Sorties V2">
	<div data-role="header">
		<h1>Sorties V2</h1>
	</div>
	<div data-role="content">	
  	<?php 
	if(isset ($_POST['Sortir'])){
            $Groupe=$_POST['Groupe'];
            $Produit=$_POST['Produit'];
            $Stock123=$_POST['Stock123'];
            $Nombre=$_POST['Nombre'];
			
			echo 'Il y a ';
			if($Nombre>47 && ($Nombre%48)!=0) {echo floor($Nombre/48).'p|'.($Nombre%48).'c';}
	  							elseif(($Nombre%48)==0 && $Nombre!=0) {echo ($Nombre/48).'p';}
								else {echo $Nombre.'c';}
								echo ' "'.$Groupe.' '.$Produit.'" dans le stock '.$Stock123.'.';
								?>
                                    <form method="post" action="moins.php">
	<input type="hidden" name="Groupe" value="<?php echo $Groupe; ?>">
	<input type="hidden" name="Produit" value="<?php echo $Produit; ?>">
	<input type="hidden" name="Stock123" value="<?php echo $Stock123; ?>">
      <label for="Palettes"><strong>Nombre de Palettes (x48 Cartons) :</strong></label>
      <input type="range" name="Palettes" min="0" max="10"/>
      <label for="Plus"><strong>Nombre de Cartons :</strong></label>
      <input type="tel" name="Moins"/>
      <input type="submit" name="Valider" value="Valider"/>
    </form>
                                <?php
	}
	else {
  if (isset ($_POST['Stock123']))
{	include ('connect.php');
$reponse = $bdd->prepare('SELECT Date, Groupe, Produit, SUM(Plus1), SUM(Plus2), SUM(Plus3), SUM(Moins1), SUM(Moins2), SUM(Moins3) FROM mvt WHERE Date < "23:59:59" GROUP BY Produit ORDER BY FIELD(Groupe, \'Nems\',\'Samossas\',\'Autre\'), Produit ASC');
$reponse->execute();
if (!$reponse) {exit ('Erreur');}
	?>
           <table align="center" width="95%" border="1">
  <tbody>
  <tr><th colspan="4">En stock</th></tr>
     <tr>
      <th scope="col">Groupe :</th>
      <th scope="col">Produit :</th>
      <th scope="col">Stock <?php echo $_POST['Stock123'];?> :</th>
      <th scope="col">Sortir</th></tr>
 <?php
while ($stock = $reponse->fetch())
{ 
	switch ($_POST['Stock123']) {
    case 1: $stockt = $stock['SUM(Plus1)'] - $stock['SUM(Moins1)'];
        break;
    case 2: $stockt = $stock['SUM(Plus2)'] - $stock['SUM(Moins2)'];
        break;
    case 3: $stockt = $stock['SUM(Plus3)'] - $stock['SUM(Moins3)'];
        break;
}
if($stockt == 0) {echo '';}
else{
?>
<tr>
      <td><?php echo $stock['Groupe']; ?></td>
      <td><?php echo $stock['Produit']; ?></td>
      <td align="center"><?php echo $stockt; ?></td>
      <td><form method="post" action="sortie2.php">
	<input type="hidden" name="Groupe" value="<?php echo $stock['Groupe']; ?>">
	<input type="hidden" name="Produit" value="<?php echo $stock['Produit']; ?>">
	<input type="hidden" name="Stock123" value="<?php echo $_POST['Stock123']; ?>">
	<input type="hidden" name="Nombre" value="<?php echo $stockt; ?>">
      <input type="submit" name="Sortir" value="Sortir"/>
    </form></td>
    </tr>
<?php
}
}
$reponse->closeCursor();
echo '</tbody></table>';
}
else {echo 
    '<form method="post" action="sortie2.php">
        <center><strong>Dans quel stock ?</strong></center>
        <button type="submit" name="Stock123" value="1">Stock 1</button>
        <button type="submit" name="Stock123" value="2">Stock 2</button>
        <button type="submit" name="Stock123" value="3">Stock 3</button>
    </form>';}}
?>

</div>
<?php include ('footer.php'); ?>