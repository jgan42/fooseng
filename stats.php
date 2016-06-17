<?php include ('header.php'); ?>
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<title>Statistiques</title>
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

		if(isset($_POST['Valider']))
	{$Date=$_POST['datedebut'].' 00:00:00'; $Datend=$_POST['datefin'].' 23:59:59';
	 $datedebut=$_POST['datedebut']; $datefin=$_POST['datefin'];}
	else {$Date='2015-05-18 00:00:00'; $Datend=date('Y-m-d').' 23:59:59';
	      $datedebut='2015-05-18'; $datefin=date("Y-m-d");}

	
	include ('connect.php');
$reponse = $bdd->prepare('SELECT Date, Groupe, Produit, SUM(Moins1+Moins2+Moins3) FROM mvt WHERE Date BETWEEN :Date AND :Datend GROUP BY Produit ORDER BY FIELD(Groupe, \'Nems\',\'Samossas\',\'Autre\'), Produit ASC');
$reponse->bindValue(':Date', $Date, PDO::PARAM_STR);
$reponse->bindValue(':Datend', $Datend, PDO::PARAM_STR);
$reponse->execute();
if (!$reponse) {exit ('Erreur');}
	?>
<div data-role="page" id="Statistiques">
	<div data-role="header">
		<h1>Statistiques</h1>
	</div>
	<div data-role="content">

       <table align="center" width="95%" border="1">
  <tbody>
  <tr><th colspan="9">Statistiques sorties du <?php echo $Date.' à '.$Datend; ?></th></tr>
     <tr>
      <th rowspan="2" scope="col">Groupe :</th>
      <th rowspan="2" scope="col" width="50%">Produit :</th>
      <th scope="col">Par :</th>
      <th colspan="2" scope="col">Jour</th>
      <th colspan="2" scope="col">Sem.</th>
      <th colspan="2" scope="col">Mois</th></tr><tr>
      <th scope="col">Total</th>
      <th scope="col">Max</th>
      <th scope="col">Moy.</th>
      <th scope="col">Max</th>
      <th scope="col">Moy.</th>
      <th scope="col">Max</th>
      <th scope="col">Moy.</th></tr>
<?php

while ($stats = $reponse->fetch())
{
	$reponsej = $bdd->prepare('SELECT DATE_FORMAT(Date, \'%Y-%m-%d\') AS Jour, Date, Groupe, Produit, SUM(Moins1+Moins2+Moins3) AS Moins FROM mvt WHERE Date BETWEEN :Date AND :Datend AND Groupe = :Groupe AND Produit = :Produit GROUP BY Jour ORDER BY Moins DESC');
$reponsej->bindValue(':Date', $Date, PDO::PARAM_STR);
$reponsej->bindValue(':Datend', $Datend, PDO::PARAM_STR);
$reponsej->bindValue(':Groupe', $stats['Groupe'], PDO::PARAM_STR);
$reponsej->bindValue(':Produit', $stats['Produit'], PDO::PARAM_STR);
$reponsej->execute();
if (!$reponsej) {exit ('Erreur');}
$statsj = $reponsej->fetch(); 

	$reponses = $bdd->prepare('SELECT DATE_FORMAT(Date, \'%Y-%W\') AS Semaine, Date, Groupe, Produit, SUM(Moins1+Moins2+Moins3) AS Moins FROM mvt WHERE Date BETWEEN :Date AND :Datend AND Groupe = :Groupe AND Produit = :Produit GROUP BY Semaine ORDER BY Moins DESC');
$reponses->bindValue(':Date', $Date, PDO::PARAM_STR);
$reponses->bindValue(':Datend', $Datend, PDO::PARAM_STR);
$reponses->bindValue(':Groupe', $stats['Groupe'], PDO::PARAM_STR);
$reponses->bindValue(':Produit', $stats['Produit'], PDO::PARAM_STR);
$reponses->execute();
if (!$reponses) {exit ('Erreur');}
$statss = $reponses->fetch(); 

	$reponsem = $bdd->prepare('SELECT DATE_FORMAT(Date, \'%Y-%m\') AS Mois, Date, Groupe, Produit, SUM(Moins1+Moins2+Moins3) AS Moins FROM mvt WHERE Date BETWEEN :Date AND :Datend AND Groupe = :Groupe AND Produit = :Produit GROUP BY Mois ORDER BY Moins DESC');
$reponsem->bindValue(':Date', $Date, PDO::PARAM_STR);
$reponsem->bindValue(':Datend', $Datend, PDO::PARAM_STR);
$reponsem->bindValue(':Groupe', $stats['Groupe'], PDO::PARAM_STR);
$reponsem->bindValue(':Produit', $stats['Produit'], PDO::PARAM_STR);
$reponsem->execute();
if (!$reponsem) {exit ('Erreur');}
$statsm = $reponsem->fetch(); 


 $amjd = explode("-", $datedebut);
 $amjf = explode("-", $datefin);
	$nbrjour = ($amjf[0] - $amjd[0])*365 + ($amjf[1]-$amjd[1])*(304/10) + ($amjf[2]-$amjd[2]) + 1;
	$nbrmois = ($amjf[0] - $amjd[0])*12 + ($amjf[1]-$amjd[1]) + 1;
	if ($nbrjour == 1) {$moyj = 1;} elseif ($nbrjour < 7) {$moyj = $nbrjour;} else {$moyj = $nbrjour*(6/7);}
	if ($nbrjour < 7) {$moys = 1;} else {$moys = $nbrjour/7;}
?>
<tr>
      <td><?php echo $stats['Groupe']; ?></td>
      <td><?php echo $stats['Produit']; ?></td>
      <td align="center"><?php echo $stats['SUM(Moins1+Moins2+Moins3)']; ?></td>
      <td align="center"><?php echo $statsj['Moins']; ?></td>
      <td align="center"><?php echo round($stats['SUM(Moins1+Moins2+Moins3)']/$moyj,1); ?></td>
      <td align="center"><?php echo $statss['Moins']; ?></td>
      <td align="center"><?php echo round($stats['SUM(Moins1+Moins2+Moins3)']/$moys,1); ?></td>
      <td align="center"><?php echo $statsm['Moins']; ?></td>
      <td align="center"><?php echo round($stats['SUM(Moins1+Moins2+Moins3)']/$nbrmois,1); ?></td>
    </tr>

		<?php
}
$reponse->closeCursor();
?>
  </tbody>
</table>
<?php if ($Date!='2015-05-18 00:00:00' OR $Datend!=date('Y-m-d').' 23:59:59')
{echo '<button onclick="window.location.reload()">Retour aux statistiques globales</button>';}
else { echo '<form method="post" action="stats.php" name="dateform">
<div><input type="text" id="datedebut" name="datedebut" value="'.$datedebut.'"></div>
<div><input type="text" id="datefin" name="datefin" value="'.$datefin.'"></div>
        <button type="submit" name="Valider" Value="Valider">Changer la date</button>
</form>';}
?>
</div>
<?php include ('footer.php'); ?>