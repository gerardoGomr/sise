(function($, window, document) {
	$(function() {
		//cargo la funcion graficas
		cargarGraficas();	
	});

	//Detecto si el select de año ha cambiado de valor    
	$( "#select_anio" ).change(function() {
		cargarGraficas();
	});

	function cargarGraficas(){
		var anio = $('#select_anio').val();
        var url = $('#urlGraficaProgramadosMensual').val();
        var _token = $('#_token').val();
    
	    // opciones para búsquedas ajax
	    var datos = {
	        anio:  anio,
	        _token: _token
	    };
        //Despliego la grafica
        getGrafica(anio, url, 'script');
        //Despliega los totales
		getDatosTotales(datos);
	}
		
	//Obtengo los datos totales
	function getDatosTotales(datos){		
		$.ajax({
            url:      $('#urlTotales').val(),
            type:     'post',
            dataType: 'json',
            data:     datos
        }).done(function(resultado) {
            console.log('exito');
            $('#divDatosTotales').html(resultado);  

            $.each($('.easy-pie'), function(k,v)
			{	
				var color = primaryColor;
				if ($(this).is('.info')) color = infoColor;
				if ($(this).is('.danger')) color = dangerColor;
				if ($(this).is('.success')) color = successColor;
				if ($(this).is('.warning')) color = warningColor;
				if ($(this).is('.inverse')) color = inverseColor;

				
				$(v).easyPieChart({
					barColor: color,
					animate: ($('html').is('.ie') ? false : 3000),
	                lineWidth: 4,
	                size: 50
				});
			});            
        })
        .fail(function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown, textStatus);
            bootbox.alert('Imposible realizar la operación solicitada');
        });
	}

}(window.jQuery, window, document));