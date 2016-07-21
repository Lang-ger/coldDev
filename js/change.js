$('#definicao').change(function(){ //Aqui ela define a Trigger da parada
	var mudar = "consultar.php?buscar="+$(this).val(); //Variavel de indicação da pagina de solicitação
	$.getJSON(mudar, function(data){ //Solicitação em si no formato JSON
		$('#TempMinMax').html(data.temperatura); //Coloca o que está dentro de data.temperatura em #TempMinMax
		$('#UmidMinMax').html(data.umidade);  //Coloca o que está dentro de data.umidade em #UmidMinMax
	});
});