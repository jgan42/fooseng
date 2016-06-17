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

<div data-role="page" id="Accueil">
  <div data-role="header">
    <h1>Accueil</h1>
  </div>
  <div data-role="content">
    <ul data-role="listview">
      <li><a href="#" onclick="location.href='stock.php'">Stocks</a></li>
      <?php if ($_SESSION['id'] == 1) {?>
      <li><a href="#Production">Production</a></li>
      <li><a href="#" onclick="location.href='sortie2.php'">Sorties</a></li>
      <li><a href="#Deplacements">Déplacements</a></li>
      <?php } ?>
      <li><a href="#" onclick="location.href='histo.php'">Historique</a></li>
      <li><a href="#" onclick="location.href='stats.php'">Statistiques</a></li>
      <li><a href="#" onclick="location.href='newpass.php'">Changer Mot de passe</a></li>
      <li><a href="#" onclick="location.href='logout.php'">Se déconnecter</a></li>
    </ul>
  </div>
      <div data-role="footer">
    <h4><?php if(isset($_SESSION['pseudo'])) {echo $_SESSION['pseudo'];}?>@FooSeng // <a href="#" onclick="location.href='index.php'">Accueil</a></h4>
  </div>
</div>


<div data-role="page" id="Production">
  <div data-role="header">
    <h1>Production</h1>
  </div>
  <div data-role="content">
    <form method="post" action="plus.php">
      <select name="Groupe" onchange='Choix(this.form)'>
        <option selected="selected">--- Groupe ---</option>
        <option value='Nems'>Nems</option>
        <option value='Samossas'>Samossas</option>
        <option value='Autre'>Autre</option>
      </select>
      <select name="Produit">
        <option selected="selected">--- Produit ---</option>
      </select>
      <select name="Stock123">
        <option selected="selected">Dans quel stock ?</option>
        <option value=1>Stock 1</option>
        <option value=2>Stock 2</option>
        <option value=3>Stock 3</option>
      </select>
      <label for="Palettes"><strong>Nombre de Palettes (x48 Cartons) :</strong></label>
      <input type="range" name="Palettes" min="0" max="10"/>
      <label for="Plus"><strong>Nombre de Cartons :</strong></label>
      <input type="tel" name="Plus"/>
      <input type="submit" name="Valider" value="Valider"/>
    </form>
  </div>
      <div data-role="footer">
    <h4><?php if(isset($_SESSION['pseudo'])) {echo $_SESSION['pseudo'];}?>@FooSeng // <a href="#" onclick="location.href='index.php'">Accueil</a></h4>
  </div>
</div>

<div data-role="page" id="Deplacements">
  <div data-role="header">
    <h1>Déplacements</h1>
  </div>
  <div data-role="content">
    <form method="post" action="deplacer.php">
      <select name="Groupe" onchange='Choix(this.form)'>
        <option selected="selected">--- Groupe ---</option>
        <option value='Nems'>Nems</option>
        <option value='Samossas'>Samossas</option>
        <option value='Autre'>Autre</option>
      </select>
      <select name="Produit">
        <option selected="selected">--- Produit ---</option>
      </select>
      <select name="Stock123">
        <option selected="selected">Depuis quel stock ?</option>
        <option value=1>Stock 1</option>
        <option value=2>Stock 2</option>
        <option value=3>Stock 3</option>
      </select>      
      <select name="Stock1234">
        <option selected="selected">Vers quel stock ?</option>
        <option value=1>Stock 1</option>
        <option value=2>Stock 2</option>
        <option value=3>Stock 3</option>
      </select>
      <label for="Palettes"><strong>Nombre de Palettes (x48 Cartons) :</strong></label>
      <input type="range" name="Palettes" min="0" max="10"/>
      <label for="Plus"><strong>Nombre de Cartons :</strong></label>
      <input type="tel" name="Plus"/>
      <input type="submit" name="Valider" value="Valider"/>
    </form>
  </div>
<?php include ('footer.php'); ?>