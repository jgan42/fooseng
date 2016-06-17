<?php include ('header.php'); ?>
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Historique</title>
<link href="jquery-mobile/jquery.mobile.theme-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<link href="jquery-mobile/jquery.mobile.structure-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="jquery-mobile/jquery.mobile-1.3.0.min.js" type="text/javascript"></script>

                <link rel="stylesheet" href="datepicker/metallic.css" type="text/css">
        <script type="text/javascript" src="datepicker/zebra_datepicker.js"></script>
        <script type="text/javascript" src="datepicker/core.js"></script>
        
 </head> 
<body>
  	<?php 

	if(isset($_POST['suppr']))
	{	include ('connect.php');
$cancel = $bdd->prepare('DELETE FROM mvt WHERE id = :id');
$cancel->bindParam(':id', $_POST['suppr'], PDO::PARAM_INT);   
$cancel->execute();
	}
	if(isset($_POST['Valider']))
	{$Date=$_POST['datepicker'].' 00:00:00'; $Datend=$_POST['datepicker'].' 23:59:59'; $dateshort=$_POST['datepicker'];}
	else {$Date=date('Y-m-d').' 00:00:00'; $Datend=date('Y-m-d').' 23:59:59'; $dateshort=date('Y-m-d');}
	
	include ('connect.php');
$reponse = $bdd->prepare('SELECT id, Date, Groupe, Produit, Plus1, Plus2, Plus3, Moins1, Moins2, Moins3 FROM mvt WHERE Date BETWEEN :Date AND :Datend ORDER BY Date');
$reponse->bindValue(':Date', $Date, PDO::PARAM_STR);
$reponse->bindValue(':Datend', $Datend, PDO::PARAM_STR);
$reponse->execute();
if (!$reponse) {exit ('Erreur');}
	?>
<div data-role="page" id="Historique">
	<div data-role="header">
		<h1>Historique</h1>
	</div>
	<div data-role="content">
    <div> <?php
	if ($_SESSION['id'] == 1) {
	if(isset($_POST['suppression'])) {echo '<strong><font color="red"><center>Attention les suppressions sont définitives !</center></font></strong>';}
	else  {echo
'<form method="post" action="histo.php" name="suppression">
	<input type="hidden" name="datepicker" value="'.$dateshort.'">
	<input type="hidden" name="Valider" value="Valider">
        <button type="submit" name="suppression" Value="suppression"><FONT color="red">Activer le mode suppression</FONT></button>
</form>';}}?> 
</div>
       <table align="center" width="95%" border="1">
  <tbody>
  <tr><th colspan="6">Historique <?php if($Date!=date('Y-m-d').' 00:00:00'){echo 'du '.$_POST['datepicker'];}else {echo 'd\'Aujourd\'hui';}?></th></tr>
     <tr>
      <th rowspan="2" scope="col">Date/Heure :</th>
      <th rowspan="2" scope="col">Groupe :</th>
      <th rowspan="2" scope="col" width="50%">Produit :</th>
      <th colspan="3" width="32%">Stock :</th></tr>
      <tr>
      <th scope="col" width="8%">1</th>
      <th scope="col" width="8%">2</th>
      <th scope="col" width="8%">3</th></tr>
<?php

while ($stock = $reponse->fetch())
{
?>
      <tr>
      <td><?php echo $stock['Date']; if(isset($_POST['suppression'])) {echo '<form method="post" action="histo.php"><button type="submit" name="suppr" value="'.$stock['id'].'"><font color="red">Suppr</font></button></form>';} ?></td>
      <td><?php echo $stock['Groupe']; ?></td>
      <td><?php echo $stock['Produit']; ?></td>
      <td align="center"><?php echo $stock['Plus1'] - $stock['Moins1']; ?></td>
      <td align="center"><?php echo $stock['Plus2'] - $stock['Moins2']; ?></td>
      <td align="center"><?php echo $stock['Plus3'] - $stock['Moins3']; ?></td>
    </tr>
		<?php
}
$reponse->closeCursor();
?>
  </tbody>
</table>
<?php if ($Date!=date('Y-m-d').' 00:00:00')
{echo '<button onclick="window.location.reload()">Retour à l\'historique d\'aujourd\'hui</button>';}
elseif(isset($_POST['suppression'])) {echo '<button onclick="window.location.reload()">Retour à l\'historique d\'aujourd\'hui</button>';}
else { echo
    '<form method="post" action="histo.php" name="dateform">
<div><input type="text" id="datepicker" name="datepicker" value="--- Choisir la date ---"></div>
        <button type="submit" name="Valider" Value="Valider">Changer la date</button>
</form>';}
?>
</div>
<?php include ('footer.php'); ?>