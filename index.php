<?php
include("TempUClass.php");
  $u = TempUmiReal::getInstance();

include("js/datetime.js");

?>
<html>
<head>
  <title> ColDdev Monitoramento </title><!--Definindo titulo da pagina-->
    <meta charset="utf-8"/><!--Definindo Unicode #utf-8-->
    <meta http-equiv="refresh" content="5">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imagens/icon3.png" type="image/png"><!--Tag link para chamar o Favicon-->
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/index.css" type="text/css">
</head>
<body>
  <div id="header">
    <h1>ColDdev Monitoramento </h1>
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
  <?php 
    echo "<h3 id='TitleTempUmi' align='center'>Painel administrativo,"."
    <a href='admPanel.php'>Clique aqui</a></h3>";//( ͡° ͜ʖ ͡°)
  ?><br>
  <div class="row">
    <div class="large-3 columns"><!--Nula-->
        <p align="center"></p><!--Nula-->
    </div><!--Nula-->
    <div class="large-3 columns">
      <div class="primary callout">
        <p id="TitleTempUmi" align="center">Temperatura</p>
          <?php
            $result = $u->consultTempUmiReal();
            foreach ($result as $linha){
            echo "<p id='ValorTempUmi' align='center'>".$linha['temperatura']."°C</p>";
            }
          ?>
      </div>
    </div>
    <div class="large-3 columns">
      <div class="primary callout">
        <p id="TitleTempUmi" align="center">Umidade</p>
          <?php
            $result = $u->consultTempUmiReal();
            foreach ($result as $linha){
            echo "<p id='ValorTempUmi' align='center'>".$linha['umidade']."%</p>";
            }
          ?>
      </div>
    </div>
    <div class="large-3 columns"><!--Nula-->
        <p align="center"></p><!--Nula-->
    </div><!--Nula-->
  </div>
  <div class="row">
    <div class="large-3 columns">
        <p id="TitleTempUmi" align="center"></p>
    </div>
    <div class="large-3 columns">
      <div class="primary callout">
        <p id="TitleTempUmi" align="center">Temp(Min-Max)</p>
        <?php
          $result = $u->consultMinMax();
          foreach ($result as $linha){
          echo "<p id='ValorMinMax' align='center'>".$linha['tempMin']."°C - ".$linha['tempMax']."°C</p>";
          }
        ?>
      </div>
    </div>
    <div class="large-3 columns">
      <div class="primary callout">
        <p id="TitleTempUmi" align="center">Umid(Min-Max)</p>
        <?php
          $result = $u->consultMinMax();
          foreach ($result as $linha){
          echo "<p id='ValorMinMax' align='center'>".$linha['umidMin']."% - ".$linha['umidMax']."%</p>";
          }
        ?>
      </div>
    </div>
    <div class="large-3 columns">
        <p id="TitleTempUmi" align="center"></p>
    </div>
  </div>
  <div class="row">
    <div class="large-6 large-centered columns">
      <div class="primary callout">
        <p id="TitleTempUmi" align="center">Definição Atual</p>
        <?php
          $result = $u->consultarDefinicao();
          foreach ($result as $linha){
          echo "<p id='ValorMinMax' align='center'>".$linha['definicao']."</p>";
          }
        ?>
      </div>
    </div>
  </div>
  <br><br>
  <div id="footer">
    <h3>Todos os direitos reservados©</h3>
  </div>
</body>
</html>
