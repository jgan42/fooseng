	
     	<?php if(isset($_GET["l"]))
	{$Date=$_GET["l"];}
	else {$Date='';}
	include ('connect.php');
$reponse = $bdd->prepare('SELECT Date, Groupe, Produit, SUM(Plus1), SUM(Plus2), SUM(Plus3), SUM(Moins1), SUM(Moins2), SUM(Moins3) FROM mvt WHERE Date < :Date "23:59:59" GROUP BY Produit ORDER BY FIELD(Groupe, \'Nems\',\'Samossas\',\'Autre\'), Produit ASC');
$reponse->bindValue(':Date', $Date, PDO::PARAM_STR);
$reponse->execute();
if (!$reponse) {exit ('Erreur');}
	?>
       <table align="center" width="95%" border="1">
  <tbody>
  <tr><th colspan="6">Stocks <?php if($Date!=''){echo 'le '.$Date.' à 23h59';}else {echo 'en temps réel';}?></th></tr>
     <tr>
      <th rowspan="2" scope="col">Groupe :</th>
      <th rowspan="2" scope="col" width="50%">Produit :</th>
      <th colspan="4" width="32%">En Stock :</th></tr>
      <tr>
      <th scope="col" width="8%">Total</th>
      <th scope="col" width="8%">1</th>
      <th scope="col" width="8%">2</th>
      <th scope="col" width="8%">3</th></tr>
<?php

while ($stock = $reponse->fetch())
{
	$Stockt = ($stock['SUM(Plus1)'] + $stock['SUM(Plus2)'] + $stock['SUM(Plus3)'] - $stock['SUM(Moins1)'] - $stock['SUM(Moins2)'] - $stock['SUM(Moins3)']);
	if ($Stockt<95) 
  {echo "<tr bgcolor='#FA5858'>";}
 elseif ($Stockt>300)
  {echo "<tr bgcolor='#58FAF4'>";}
  else
  {echo "<tr>";}
?>
      <td><?php echo $stock['Groupe']; ?></td>
      <td><?php echo $stock['Produit']; ?></td>
      <td align="center"><?php if($Stockt>47 && ($Stockt%48)!=0) {echo floor($Stockt/48).'p|'.($Stockt%48).'c';}
	  							elseif(($Stockt%48)==0 && $Stockt!=0) {echo ($Stockt/48).'p';}
								else {echo $Stockt.'c';} ?></td>
      <td align="center"><?php echo $stock['SUM(Plus1)'] - $stock['SUM(Moins1)']; ?></td>
      <td align="center"><?php echo $stock['SUM(Plus2)'] - $stock['SUM(Moins2)']; ?></td>
      <td align="center"><?php echo $stock['SUM(Plus3)'] - $stock['SUM(Moins3)']; ?></td>
    </tr>

		<?php
}
$reponse->closeCursor();
?>
  </tbody>
</table>