<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Uzinanem</title>

<link href="jquery-mobile/jquery.mobile.theme-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<link href="jquery-mobile/jquery.mobile.structure-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<script src="jquery-mobile/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="jquery-mobile/jquery.mobile-1.3.0.min.js" type="text/javascript"></script>
<script src="jquery-mobile/listeproduit.js" type="text/javascript"></script>

<link rel="stylesheet" href="datepicker/metallic.css" type="text/css">
        <script type="text/javascript" src="datepicker/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="datepicker/zebra_datepicker.js"></script>
        <script type="text/javascript" src="datepicker/core.js"></script>
        
    </head>
    <body>
<div id="r">lol</div>
<input id="datepicker" name="datepicker" type="text">
        <button id="action">Changer la date</button>
    <script>
      $(function() {
        $('#action').click(function() {
          var param = 'l=' + $('#datepicker').val();
          $('#r').load('testdate.php',param);
        });  
      });
      </script>
</body>
</html>
