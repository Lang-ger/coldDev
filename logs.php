<html>
<head>
  <title> ColDdev Monitoramento </title><!--Definindo titulo da pagina-->
  <link rel="stylesheet" href="css/def.css" type="text/css">
  <meta charset="utf8">
</head>
<?php
	session_start();
	if(!isset($_SESSION['login'])){
		header("Location:loginAdm.php");
	}
	include("sysLogClass.php");
	$u = syslog::pegarInstancia();
?>
<div align="center" class="busca"><?php

echo "&nbsp;<a href='logs.php?u=dia'>Últimas 24hs</a>";
echo "&nbsp|";
echo "&nbsp;<a href='logs.php?u=semana'>Última Semana</a>";
echo "&nbsp|";
echo "&nbsp;<a href='logs.php?u=mes'>Último Mês</a>";
echo "&nbsp|";
echo "&nbsp;<a href='logs.php?u=bimes'>Último Bimestre</a>";
echo "&nbsp|";
echo "&nbsp;<a href='logs.php?u=semestre'>Último Semestre</a>";
echo "&nbsp|";
echo "&nbsp;<a href='logs.php?u=anual'>Último Ano</a>";
echo "&nbsp|";
echo "&nbsp;<a href='logs.php?u='>Listar Tudo</a>";
echo "&nbsp|";
?></div><br>
	<table width='100%' margin='1'>
	  <tr>
	    <td class="titulos">Data e Hora</td>
	    <td class="titulos">ID</td>
	    <td class="titulos">Temperatura</td>
	    <td class="titulos">Umidade</td>
	  </tr>
		<?php
		$dia = "dia";
		$ontem = "ontem";
		$semana = "semana";
		$mes = "mes";
		$bimes = "bimes";
		$semestre = "semestre";
		$anual = "anual";
		$tudo = "";

		if ($dia == $_GET['u']){
		$result = $u->listarDia();
		foreach($result as $linha){
			echo "<tr>";
			echo "<td class='resultados'>".$linha['dataLog']."</td>";
			echo "<td class='resultados'>".$linha['codTemperatura']."</td>";
			echo "<td class='resultados'>".$linha['temperatura']."</td>";
			echo "<td class='resultados'>".$linha['umidade']."</td>";
			echo "</tr>";
			}
		} 
		elseif ($semana == $_GET['u']){
		$result = $u->listarSemana();
		foreach($result as $linha){
			echo "<tr>";
			echo "<td class='resultados'>".$linha['dataLog']."</td>";
			echo "<td class='resultados'>".$linha['codTemperatura']."</td>";
			echo "<td class='resultados'>".$linha['temperatura']."</td>";
			echo "<td class='resultados'>".$linha['umidade']."</td>";
			echo "</tr>";
			}	
		}
		elseif ($mes == $_GET['u']){
		$result = $u->listarMes();
		foreach($result as $linha){
			echo "<tr>";
			echo "<td class='resultados'>".$linha['dataLog']."</td>";
			echo "<td class='resultados'>".$linha['codTemperatura']."</td>";
			echo "<td class='resultados'>".$linha['temperatura']."</td>";
			echo "<td class='resultados'>".$linha['umidade']."</td>";
			echo "</tr>";
			}	
		}
		elseif ($bimes == $_GET['u']){
		$result = $u->listarBimes();
		foreach($result as $linha){
			echo "<tr>";
			echo "<td class='resultados'>".$linha['dataLog']."</td>";
			echo "<td class='resultados'>".$linha['codTemperatura']."</td>";
			echo "<td class='resultados'>".$linha['temperatura']."</td>";
			echo "<td class='resultados'>".$linha['umidade']."</td>";
			echo "</tr>";
			}	
		}
		elseif ($semestre == $_GET['u']){
		$result = $u->listarSemestre();
		foreach($result as $linha){
			echo "<tr>";
			echo "<td class='resultados'>".$linha['dataLog']."</td>";
			echo "<td class='resultados'>".$linha['codTemperatura']."</td>";
			echo "<td class='resultados'>".$linha['temperatura']."</td>";
			echo "<td class='resultados'>".$linha['umidade']."</td>";
			echo "</tr>";
			}	
		}
		elseif ($anual == $_GET['u']){
		$result = $u->listarAnual();
		foreach($result as $linha){
			echo "<tr>";
			echo "<td class='resultados'>".$linha['dataLog']."</td>";
			echo "<td class='resultados'>".$linha['codTemperatura']."</td>";
			echo "<td class='resultados'>".$linha['temperatura']."</td>";
			echo "<td class='resultados'>".$linha['umidade']."</td>";
			echo "</tr>";
			}	
		}
		elseif ($tudo == $_GET['u']){
		$result = $u->listarTudo();
		foreach($result as $linha){
			echo "<tr>";
			echo "<td class='resultados'>".$linha['dataLog']."</td>";
			echo "<td class='resultados'>".$linha['codTemperatura']."</td>";
			echo "<td class='resultados'>".$linha['temperatura']."</td>";
			echo "<td class='resultados'>".$linha['umidade']."</td>";
			echo "</tr>";
			}	
		}
		else {
			echo "Valores não encontrados";
		}
	?>
</html>

