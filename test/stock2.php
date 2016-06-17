<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Stocks</title>
<link href="jquery-mobile/jquery.mobile.theme-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<link href="jquery-mobile/jquery.mobile.structure-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<script src="jquery-mobile/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="jquery-mobile/jquery.mobile-1.3.0.min.js" type="text/javascript"></script>
        
                <link rel="stylesheet" href="datepicker/metallic.css" type="text/css">
        <script type="text/javascript" src="datepicker/zebra_datepicker.js"></script>
        <script type="text/javascript" src="datepicker/core.js"></script>

 </head> 
<body>

<div data-role="page" id="Stocks">
	<div data-role="header">
		<h1>Stocks</h1>
	</div>
	<div data-role="content">
<div id="r">lol
 <?php include ('testdate.php'); ?>
</div>
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

             </div>
            	<div data-role="footer">
		<h4><a href="#" onclick="location.href='index.php'">Accueil</a></h4>
	</div>
            </div>
</body>
</html>
