$(document).ready(function(){
	var admin = location.pathname.indexOf('admin');
	var tam = location.pathname.indexOf('/', 10);
	var path = location.pathname.substring(0, tam);
	var pathComunidades = path + '/public/index.php/combos/comunidades';
	var pathProvincias = path + '/public/index.php/combos/provincias';
	var pathMunicipios = path + '/public/index.php/combos/municipios';
	
	if (admin == -1){
		var pathRecargaMunicipios = path + '/public/index.php/buscador/recarga';
	} else {
		var pathRecargaMunicipios = path + '/public/index.php/admin/municipios/recarga';
		var encuentros = location.pathname.indexOf('encuentros');
		if (encuentros != -1){
			var pathRecargaMunicipios = path + '/public/index.php/admin/encuentros/recarga';
		}
	}

	$.ajax({
		type: "POST",
		url: pathComunidades,
		success: function(response)
		{
			$('.selector-comunidad select').html(response).fadeIn();
			anyoelegido=$("#anyoSelect").val();
			$.post(pathRecargaMunicipios, { anyoelegido: anyoelegido }, function(data){
				$("#recargaEncuentros").html(data);
			});  
		}
	});

	$.ajax({
		type: "POST",
		url: pathProvincias,
		success: function(response)
		{
			$('.selector-provincia select').html(response).fadeIn();
		}
	});

	$.ajax({
		type: "POST",
		url: pathMunicipios,
		success: function(response)
		{
			$('.selector-municipio select').html(response).fadeIn();
		}
	});
	   
	$("#anyoSelect").on('change', function () {
		$("#anyoSelect option:selected").each(function () {
			anyoelegido=$(this).val();
			$.post(pathRecargaMunicipios, { anyoelegido: anyoelegido }, function(data){
				$("#recargaEncuentros").html(data);
				$("#comunidadSelect").val('0');
				$("#provinciaSelect").val('0');
				$("#municipioSelect").val('0');
				$("#provinciaSelect").prop("disabled", true);
				$("#municipioSelect").prop("disabled", true);
			});        
		});
	});

	$("#comunidades").on('change', function () {
		$("#comunidades option:selected").each(function () {
			comunidadelegida=$(this).val();
			$.post(pathProvincias, { comunidadelegida: comunidadelegida }, function(data){
				$("#provinciaSelect").html(data);
				$("#provinciaSelect").prop("disabled", false);
				$("#municipioSelect").prop("disabled", true);
			});   
			$.post(pathRecargaMunicipios, { anyoelegido: anyoelegido, comunidadelegida: comunidadelegida }, function(data){
				$("#recargaEncuentros").html(data);
			});        
		});
	});

	$("#provincias").on('change', function () {
		$("#provincias option:selected").each(function () {
			provinciaelegida=$(this).val();
			$.post(pathMunicipios, { provinciaelegida: provinciaelegida }, function(data){
				$("#municipioSelect").html(data);
				$("#municipioSelect").prop("disabled", false);
			});   
			$.post(pathRecargaMunicipios, { anyoelegido: anyoelegido, comunidadelegida: comunidadelegida, provinciaelegida: provinciaelegida }, function(data){
				$("#recargaEncuentros").html(data);
			});      
		});
	});

	$("#municipios").on('change', function () {
		$("#municipios option:selected").each(function () {
			municipioelegido=$(this).val();
			$.post(pathRecargaMunicipios, { anyoelegido: anyoelegido, comunidadelegida: comunidadelegida, provinciaelegida: provinciaelegida, municipioelegido: municipioelegido }, function(data){
				$("#recargaEncuentros").html(data);
			});      
		});
	});
	
	

			
});