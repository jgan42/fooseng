<?php 
include ('connect.php');
$reponse = $bdd->prepare('SELECT * FROM mvt LIMIT 1000');
$reponse->execute();
while ($stock = $reponse->fetch())
{
?>
<table align="center" width="95%" border="1">
  <tbody>
      <tr>
      <td><?php echo $stock['id'];?></td>
      <td><?php echo $stock['Date'];?></td>
      <td><?php echo $stock['Groupe']; ?></td>
      <td><?php echo $stock['Produit']; ?></td>
      <td><?php echo $stock['Plus1']; ?></td>
      <td><?php echo $stock['Plus2']; ?></td>
      <td><?php echo $stock['Plus3']; ?></td>
      <td><?php echo $stock['Moins1']; ?></td>
      <td><?php echo $stock['Moins2']; ?></td>
      <td><?php echo $stock['Moins3']; ?></td>
    </tr>
    </tbody></table>
		<?php
}
$reponse->closeCursor();

?>