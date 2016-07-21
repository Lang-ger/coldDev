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
     $result = $u->procurarDefinicao(); 
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
<script>
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}
</script>
  </div>
  <form onsubmit="adicionado()" align="center" id="contactForm" method="post" name="contactForm" action="<?php $SELF_PHP; ?>">
    <input class="input" type="hidden" name="codDef" value="" readonly/>
    <div class="field">
      <label for="definicao">Nome da definição</label>
      <input type="text" class="input" name="definicao" onfocus="this.value='';" value="Ex: Queijo Minas Frescal Light" required/>
    </div><br>
    <div class="field">
      <label for="tempMin">Temperatura mínima permitida</label>
      <input type="text" class="input" name="tempMin" OnKeyPress="formatar('##.#', this)" onfocus="this.value='';" value="Ex: 22.5" maxlength="4" required/>
    </div>
    <div class="field">
      <label for="tempMax">Temperatura máxima permitida</label>
      <input type="text" class="input" name="tempMax" OnKeyPress="formatar('##.#', this)" onfocus="this.value='';" value="Ex: 30.2" maxlength="4" required/>
    </div><br>
    <div class="field">
      <label for="umidMin">Umidade mínima permitida</label>
      <input type="text" class="input" name="umidMin" OnKeyPress="formatar('##.#', this)" onfocus="this.value='';" value="Ex: 45.9" maxlength="4" required/>
    </div>
    <div class="field">
      <label for="umidMax">Umidade máxima permitida</label>
      <input type="text" class="input" name="umidMax" OnKeyPress="formatar('##.#', this)" onfocus="this.value='';" value="Ex: 63.4" maxlength="4" required/>
    </div><br>
    <input type="submit" class="submit" value="Salvar"></input>
    <script>
    function adicionado() {
    alert("Produto adicionado");
    }
    </script>
    <?php
    if($resposta==1){
      echo "";
    }elseif($resposta==0){
      echo "<h1>Erro ao incluir definição do produto</h1>";      
    }
    ?>
    <a class="but" href="admPanel.php"/> Voltar</input>

  </form>
