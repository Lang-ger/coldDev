$('#definicao').click(function(){ //Aqui ela define a Trigger da parada
	var alterar = "salvaralterar.php?salvar="+$(this).val(); //Variavel de indicação da pagina de solicitação
	$.getJSON(alterar, function(data){ //Solicitação em si no formato JSON
		$('#TempMinMax').html(data.temperatura); //Coloca o que está dentro de data.temperatura em #TempMinMax
		$('#UmidMinMax').html(data.umidade);
		$('#Def').html(data.def); //Coloca o que está dentro de data.temperatura em #TempMinMax
	});
});