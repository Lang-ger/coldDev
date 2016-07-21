<?php
  session_start();
  if(!isset($_SESSION['login'])){
    header("Location:loginAdm.php");
  }
  include("admClass.php");
    $u = adm::getInstance();
    $resposta = -1;
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $u->__set('idadm',$_POST['idadm']);
    $u->__set('nome',$_POST['nome']);
    $u->__set('login',$_POST['login']);
    $u->__set('senha',$_POST['senha']);
    if(isset($_GET['codigo'])){
      $resposta = $u->alterar();
      unset($_GET['codigo']);
    }else{
      $resposta = $u->salvar();
    }
  }
  if(isset($_GET['codigo'])){
     $u->__set('idadm',$_GET['codigo']);
     $result = $u->procurar();
     $linha = null;
     foreach($result as $linha){
      $u->__set('nome',$linha['nome']);
      $u->__set('login',$linha['login']);
      $u->__set('senha',$linha['senha']);
     }
  }
include("js/datetime.js");

$senha = "mypassword";
$criptografada = md5($senha);

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
    <input class="input" type="hidden" name="idadm" value="" readonly/>
    <div class="field">
      <label for="nome">Nome e Sobrenome</label>
      <input type="text" class="input" name="nome" onfocus="this.value='';" value="" required/>
    </div>
    <div class="field">
      <label for="login">Login</label>
      <input type="text" class="input" name="login" onfocus="this.value='';" value="" maxlength="4" required/>
    </div>
    <div class="field">
      <label for="senha">Senha</label>
      <input type="password" class="input" name="senha" onfocus="this.value='';" value="" maxlength="4" required/>
    </div><br>
    <input type="submit" class="submit" value="Salvar"></input> 
    <script>
    function adicionado() {
    alert("Administrador cadastrado com sucesso");
    }
    </script>
    <?php
    if($resposta==1){
      echo "";
    }elseif($resposta==0){
      echo "<h1>Erro ao incluir Administrador</h1>";      
    }
    ?>
    <a class="but" href="admPanel.php"/> Voltar</input>
  </form></div>
</body>