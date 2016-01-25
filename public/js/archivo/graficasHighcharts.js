function getGrafica(anio, url, tipo_de_dato){
    var _token = $('#_token').val();
    
    // opciones para búsquedas ajax
    var datos = {
        anio:  anio,
        _token: _token
    };
    
    graficarExpedientes(url, 'post', tipo_de_dato, datos);     

}

function graficarExpedientes(url, tipo, tipo_de_dato, datos){        
    $.ajax({
        url:      url,
        type:     tipo,
        dataType: tipo_de_dato,
        data:     datos
    }).done(function(resultado) {
        console.log('exito');

        if(tipo_de_dato !=  'script')
            grafica(resultado);
        //$('#dvGraficaExpedientes_script').html(resultado); 
    })
    .fail(function(XMLHttpRequest, textStatus, errorThrown) {
        console.log(errorThrown, textStatus);
        bootbox.alert('Imposible realizar la operación solicitada');
    });
}

function grafica (series) {

    var opcionesGrafica = series;


    Highcharts.setOptions({
        lang: {
            drillUpText: '<< Regresar'
        },
        chart: {
            backgroundColor: {
                linearGradient: [0, 0, 500, 500],
                stops: [
                    [0, 'rgb(255, 255, 255)'],
                    [1, 'rgb(240, 240, 255)']
                    ]
            },
            borderWidth: 2,
            plotBackgroundColor: 'rgba(255, 255, 255, .9)',
            plotShadow: true,
            plotBorderWidth: 1
        }
    });
    var graficaHighcharts = new Highcharts.Chart(opcionesGrafica);
}

