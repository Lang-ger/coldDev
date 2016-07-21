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
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Cadastro de Adm's</title>
  <link rel="shortcut icon" href="imagens/icones/faviconadm.png" type="image/x-icon"/>
  <link href="css/admpainel.css" rel="stylesheet" type="text/css">
</head>
<body>
<form align="center" id="contactForm" method="post" action="<?php $SELF_PHP; ?>">
  <h1>Cadastro de Adm's</h1><br><br><br>
  <div class="field">
    <input type="hidden" name="idadm" value="<?php echo $u->__get('idadm'); ?>" readonly/>
  </div>
  <div class="field">
    <label for="email">Nome completo</label>
     <input type="text" class="input" name="nome" value="<?php echo $u->__get('nome'); ?>"  maxlength="50" required/><br>
    <p class="hint">Insira o nome completo do novo Administrador</p>
  </div>
  <div class="field">
    <label for="login">Login</label>
      <input type="text" class="input" name="login" value="<?php echo $u->__get('login'); ?>" maxlength="20" required/><br>
    <p class="hint">Insira o Login que dará acesso ao sistema</p>
  </div>
  <div class="field">
    <label for="senha">Senha</label>
      <input type="password" class="input" name="senha" value="<?php echo $u->__get('senha'); ?>"  pattern="[a-Z0-9]{3,20}" maxlength="20" required/><br>
    <p class="hint">Insira a senha que dará acesso ao sistema</p>
  </div><br>
  <br><br><br>
   <div class"">
      <input type="submit" class="button" value=""/>
   </div>
    <h1><a href="painelAdm.php">Voltar</a></h1>
    <?php
     if($resposta==1){
      echo "<h1>O Adm foi incluido com sucesso</h1>";
     }elseif($resposta==0){
      echo "<h1>Erro ao incluir usuário</h1>";
    }
  ?>
</form>
</body>
</html>
