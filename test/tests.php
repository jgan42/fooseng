<!DOCTYPE html> 
<html><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Annulation</title>
<link href="jquery-mobile/jquery.mobile.theme-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<link href="jquery-mobile/jquery.mobile.structure-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src="jquery-mobile/jquery.mobile-1.3.0.min.js" type="text/javascript"></script>
<script src="jquery-mobile/jquery.marquee.min.js" type="text/javascript"></script>
<style type='text/css'>
table{
    table-layout: fixed;
}
table td {
	overflow: hidden;
}
img#forme1 {
    width: 100%;
    height: auto;
}
img#forme2{
    width: 20%;
	display: inline;
}
.marquee {
			  width: 100%;
			  overflow: hidden;
			}
</style>

</head>
<body>
<div data-role="page" id="Annulation">
	<div data-role="header">
		<h1>Annulation</h1>
	</div>
	<div data-role="content">	
<table align="center" width="95%" border="1"><col width="23%" /><col width="49%" /><col width="23%" />
  <tbody>
    <tr>
      <td>&nbsp;</th>
      <td>&nbsp;</th>
      <td>&nbsp;</th>
    </tr>
    <tr>
      <td><img src="img/prod.png" id="forme1"/></td>
      <td><center><div data-speed="500" data-direction="right" class="marquee"><img src="img/mvt.png" id="forme2"/></div></center></td>
      <td><img src="img/stock.png" id="forme1"/></td>
    </tr>
  </tbody>
</table>

</div>
	<div data-role="footer">
		<h4><a href="#" onclick="location.href='index.php'">Accueil</a></h4>
	</div>
</div>
<script>
$(function(){
	$('.marquee').marquee();
});
</script>

</body>
</html>