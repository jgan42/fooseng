<?php include ('header.php'); ?>
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Annulation</title>
<link href="jquery-mobile/jquery.mobile.theme-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<link href="jquery-mobile/jquery.mobile.structure-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="jquery-mobile/jquery.mobile-1.3.0.min.js" type="text/javascript"></script>
</head>
<body>
<div data-role="page" id="Annulation">
	<div data-role="header">
		<h1>Annulation</h1>
	</div>
	<div data-role="content">	
<?php 
  if (isset ($_POST['Annuler']))
  
include ('connect.php');

$cancel = $bdd->prepare('DELETE FROM mvt WHERE id = :id');
$cancel->bindParam(':id', $_POST['Annuler'], PDO::PARAM_INT);   
$cancel->execute();
if (!$cancel) {exit ('Erreur');}
else {echo "<strong><center>Annulation validée</center></strong>";}
?>
</div>
<?php include ('footer.php'); ?>