<?php
// Conexão com o banco de dados
$conn = mysql_connect("localhost", "usuario", "senha");
$db = mysql_select_db("banco", $conn);

// Incluindo a biblioteca do xajax
require_once("xajax/xajax_core/xajax.inc.php");
 
// Instanciamos a classe
$xajax = new xajax();
 
// Registramos a função calcular()
$xajax->registerFunction("atualizar");
 
// Criamos a função atualizar(), que será responsável por atualizar a div
function atualizar() {
    //Instância do objeto de resposta do Ajax
	$objResponse = new xajaxResponse();
 	// Buscamos uma frase
	$query = mysql_query("SELECT * FROM frases");
	// Verificamos o número de frases
	$numFrases = mysql_num_rows($query);
	// Sorteamos uma frase
	$sortido = rand(0, $numFrases - 1);
	// Frase sortida
	$frase = mysql_result($query, $sortido, 1);
	// Autor da frase sortida
	$autor = mysql_result($query, $sortido, 2);
	// Construimos a resposta
	$resposta = utf8_encode("<i>" . $frase . "</i><br />" . $autor);
	// Colocamos a frase e seu respectivo autor na div
	$objResponse->assign("frase", "innerHTML", $resposta);
	//Devolve a resposta para a página
	return $objResponse;
}
 
// Função para processar as requisições (indispensável)
$xajax->processRequest();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Frases sortidas: Atualizar DIV de segundos em segundos com PHP/XAJAX</title>
<?php
// Método para que seje gerado as funções javascript
$xajax->printJavascript("xajax/");
?>

<script language="javascript" type="text/javascript">
// Chamamos a função criada com XAJAX a cada 10 segundos
setInterval("xajax_atualizar()", 10000);
</script>
</head>

<body onload="xajax_atualizar()">
<h1>Frases sortidas</h1>
<div id="frase"></div>
</body>
</html>