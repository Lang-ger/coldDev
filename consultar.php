<?php
include("TempUClass.php"); //Importando o TempUclass
  $u = TempUmiReal::getInstance();

  $chamar = $u->consultarValoresDefinicao($_GET['buscar']); //Chamando o método consultar valores/definição passando o conteudo de buscar e armazenando o retorno em chamar
  foreach ($chamar as $listar){
  
  $return['temperatura']=$listar['tempMin'].'°C - '.$listar['tempMax']."°C"; //Listando o retorno
  $return['umidade']=$listar['umidMin'].'% - '.$listar['umidMax'].'%'; //Listando o retorno
  
  }

  echo json_encode($return);//converte o JSON e depois escreve