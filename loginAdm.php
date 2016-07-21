<?php
  session_start();
  include("admClass.php");
  $u = adm::getInstance();
  $resposta = "";
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $u->__set('login',$_POST['login']);
    $u->__set('senha',$_POST['senha']);
    if($u->validar()){
      $_SESSION['login']=$_POST['login'];
      header("Location:admPanel.php");
    }else{
      unset($_SESSION['login']);
      unset($_SESSION['senha']);
      $resposta = "<br><p>Login ou senha inválidos</p>";
    }
  }
?>
<html>
<head>
  <meta charset="UTF-8">
  <link href="css/admpainel.css" rel="stylesheet" type="text/css">
  <link href="css/img.css" rel="stylesheet" type="text/css">
  <title>coldDev | Login </title>
</head>
<body onload="myFunction()">
  <form align="center" id="contactForm" method="post" name="contactForm" action="<?php $SELF_PHP; ?>">
    <h1>Login Administrador</h1>
    <div class="field">
      <input type="hidden" name="idadm" value="<?php echo $u->__get('idadm'); ?>" readonly/>
    </div>
    <div class="field">
    <label for="login">Login</label>
    <input type="text" class="input" name="login" value="<?php echo $u->__get('login'); ?>" required/>
    </div>
    <div class="field">
      <label for="senha">Senha</label>
      <input type="password" class="input" id="senha" name="senha" value="<?php echo $u->__get('senha'); ?>" required/>
    </div><br>
     <div>
     <input type="submit" class="submit" value="Logar"></input>
  </form>
  <script src="js/jquery.js"></script>
  <script>
    function myFunction() {
    $("#contactForm .field input#senha").val("");
    }
  </script>
    <?php
      if($resposta!=null){
        echo $resposta;
      }
    ?>
    <br><br><h1><a class="imgBox" href="index.php"><img src="imagens/back.png" height="80" width="80"/></a></h1>
  </form></div>
</body>
</html>
