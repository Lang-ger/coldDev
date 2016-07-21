<html>
<title>Desconectando</title>
</html>
<?php
	session_start();
 	unset($_SESSION['login']);
  header("Location:loginAdm.php");
?>
