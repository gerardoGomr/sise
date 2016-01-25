(function($, window, document) {
    //El codigo dentro de la funcion ready se ejecuta al
    //cargarse la pagina
    $(document).ready(function() {
        //detecto si la url trae un parametro
        var url = jQuery(location).attr('href');
        var res = url.split("/"); 


        //Solo si trae como parametro un numero entero ejecuto 
        //el formulario a traves de un disparador al evento click
        if((isNaN(res[res.length-1])==false) && res.length ==8){
            $( "#btnFrmArchivo" ).trigger( "click" );
        }
    });

    
	//Detecto el evento click sobre el boton del formulario
    $('#btnFrmArchivo').on( "click", function(event) {
        var anio = $('#select_anio').val();
        var url = $('#urlGraficaNoEntregados').val();
        var nombreApp = getNombreApp(); 

        //Despliego los datos por pagina en la vista de detalle
        reiniciarDatatable('dtEvaluados', '/'+nombreApp+'/archivo/reporte/getDatosReporte?'+$('#frmArchivoReporte').serialize(),
              'expedientes_no_entregados_a_custodia', 'Reporte de expedientes no entregados a custodia correspondiente al año ' + $('#select_anio').val());
        
        //Despliego la grafica
        //alert(anio +' '+url);
        getHeader(anio, url, 'json');
        
        event.preventDefault();
    });

    function getHeader(anio, url, tipo_de_dato){
        var _token = $('#_token').val();
        
        // opciones para búsquedas ajax
        var datos = {
            anio:  anio,
            _token: _token
        };
        
        getGraficasHeader(url, 'post', tipo_de_dato, datos);     

    }

    function getGraficasHeader(url, tipo, tipo_de_dato, datos){        
        $.ajax({
            url:      url,
            type:     tipo,
            dataType: tipo_de_dato,
            data:     datos
        }).done(function(resultado) {
            console.log('exito');  
            $('#dvGrafica').html(resultado);


            $(".sparkline").each(function()
            {
                var d = $(this).data('data') || "html";
                $(this).sparkline(
                    d, {
                        type: 'bar',
                        height: '70',
                        barWidth: 10,
                        barSpacing: 8,
                        zeroAxis: false,
                        stackedBarColor: [primaryColor, "#dedede"],
                        colorMap: $(this).data('colors') ? $(this).data('colors').split(",") : [],
                        enableTagOptions: true
                        // tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{prefix}}{{value}}{{suffix}}'
                    }
                );
            });

        })
        .fail(function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown, textStatus);
            bootbox.alert('Imposible realizar la operación solicitada');
        });
    }

}(window.jQuery, window, document));