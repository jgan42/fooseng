<?php      
session_start();
if (strpos($_SERVER['PHP_SELF'],'login') === false) {
if (!isset($_SESSION['pseudo']))
  {header('Location: login.php'); } 
}
?>
