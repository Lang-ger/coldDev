<?php
session_start();
if(!isset($_SESSION['login'])){
  header("Location:loginAdm.php");
}
include("admClass.php");
  $u = adm::getInstance();
include("js/datetime.js");
?>
<html>
<head>
  <title> ColDdev Monitoramento </title><!--Definindo titulo da pagina-->
    <meta charset="utf-8"/><!--Definindo Unicode #utf-8-->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imagens/icon3.png" type="image/png"><!--Tag link para chamar o Favicon-->
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/index.css" type="text/css">
    <link rel="stylesheet" href="css/img.css" type="text/css">
</head>
<body>
  <div id="header">
    <h1>ColDdev Monitoramento</h1>
    <script language="javascript">
    document.write('  '+todaysDate);
    </script>
    <SPAN ID="Clock">00:00:00</SPAN>
  <SCRIPT LANGUAGE="JavaScript">
  var Elem = document.getElementById("Clock");
  function Horario(){
    var Hoje = new Date();
    var Horas = Hoje.getHours();
    if(Horas < 10){
      Horas = "0"+Horas;
    }
    var Minutos = Hoje.getMinutes();
    if(Minutos < 10){
      Minutos = "0"+Minutos;
    }
    var Segundos = Hoje.getSeconds();
    if(Segundos < 10){
      Segundos = "0"+Segundos;
    }
    Elem.innerHTML = Horas+":"+Minutos+":"+Segundos;
    }
    window.setInterval("Horario()",1000);
</SCRIPT>
  </div>
    <br><?php
    echo "<h3 id='TitleTempUmi' align='center'>Você está logado, <a href='sair.php'>Sair</a></h3><br>";
  ?>
  <div class="imgBox">
    <table id="TitleDesc" align="center" width="50%" height="50%">
      <tr align="center">
        <td><p>Admin</p></td>
        <td><p>Alterar</p></td>
        <td><p>Adicionar</p></td>
      </tr>
      <tr align="center">
        <td><a href="admin.php"><img src="imagens/adm.png"/></a></td>
        <td><a href="alterar.php"><img src="imagens/definicao.png"/></a></td>
        <td><a href="adicionar.php"><img src="imagens/criardefinicao.png"/></a></td>
      </tr>
    </div>
  </div>
<script>
function myFunction() {
    window.open("index.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=300,left=500,width=500,height=500");
}
</script>
  <a id="versite" onclick="myFunction()">Visualizar site</a> 
</body>
</html>
