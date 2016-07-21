<?php
  session_start();
  if(!isset($_SESSION['login'])){
    header("Location:loginAdm.php");
  }
  include("TempUClass.php");
  $u = TempUmiReal::getInstance();
  $resposta = -1;
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $u->__set('codDef',$_POST['codDef']);
    $u->__set('definicao',$_POST['definicao']);
    $u->__set('tempMin',$_POST['tempMin']);
    $u->__set('tempMax',$_POST['tempMax']);
    $u->__set('umidMin',$_POST['umidMin']);
    $u->__set('umidMax',$_POST['umidMax']);
    if(isset($_GET['codigo'])){
      $resposta = $u->alterarDefinicao();
      unset($_GET['codigo']);
    }else{
      $resposta = $u->salvarDefinicao();  
    }
  }
  /*Procura os dados no banco pela classe*/

  if(isset($_GET['codigo'])){
     $u->__set('codDef',$_GET['codigo']);
     $result = $u->consultarDefinicao(); 
     $linha = null;
     foreach($result as $linha){
      $u->__set('tempMin',$linha['tempMin']);
      $u->__set('tempMax',$linha['tempMax']);
      $u->__set('umidMin',$linha['umidMin']);
      $u->__set('umidMax',$linha['umidMax']);
      $u->__set('definicao',$linha['definicao']);
     }   
  }
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
    <link rel="stylesheet" href="css/def.css" type="text/css">
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
  <br><br>
   <div class="row">
    <div class="large-6 large-centered columns">
      <div class="primary callout">
        <p id="TitleTempUmi" align="center">Selecionar Definição</p>
        <p id="ValorTempUmi" align="center"><select id="definicao">
        <option value="Manual">Manual</option>
         <?php
          $result = $u->consultarDefinicao();
          foreach ($result as $linha){
          echo "<option value='".$linha['codDef']."'>".$linha['definicao']."</option>";
          }
        ?>
        </select>
        </p>
      </div>
    </div>
        <div class="large-3 large-offset-3  columns">
      <div class="primary callout">
        <p id="TitleTempUmi" align="center">Temp(Min-Max)</p>
        <p id="TempMinMax" class="ValorTempUmi" align="center"></p>
      </div>
    </div>
    <div class="large-3 columns">
      <div class="primary callout">
        <p class="TitleTempUmi" align="center">Umid(Min-Max)</p>
        <p id="UmidMinMax" class="ValorTempUmi" align="center"></p>
      </div>
    </div
    <div class="large-3 columns"><!--Nula-->
        <p align="center"></p><!--Nula-->
    </div><!--Nula-->
  <input type="submit" class="submit" value="Salvar"></input>
  <a href="admPanel.php"/> Voltar</input>

  <script src="js/jquery.js"></script>
<script src="js/change.js"></script>
</body>
</html>