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
            $( "#btnFrmReporteEnProceso" ).trigger( "click" );
        }
    });

    //Detecto el evento click sobre el boton del formulario
    $('#btnFrmReporteEnProceso').on( "click", function(event) {
        var anio = $('#select_anio').val();
        var url = $('#urlGraficaEnProceso').val();
        var nombreApp = getNombreApp();

        //Despliego los datos por pagina en la vista de detalle
        reiniciarDatatable('dtEvaluados', '/'+nombreApp+'/archivo/reporte/getDatosReporteEnProceso?'+$('#frmReporteEnProceso').serialize(),
              'expedientes_en_proceso', 'Reporte de expedientes en proceso de dictaminación correspondiente al año ' + $('#select_anio').val());
        //Despliego la grafica
        getGrafica(anio, url, 'script');
        
        event.preventDefault();
    });   

}(window.jQuery, window, document));