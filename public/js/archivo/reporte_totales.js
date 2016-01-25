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
            $( "#btnFrmReporteTotales" ).trigger( "click" );
        }
    });

    //Detecto el evento click sobre el boton del formulario
    $('#btnFrmReporteTotales').on( "click", function(event) {
        var anio = $('#select_anio').val();
        
        var nombreApp = getNombreApp();

        reiniciarDatatable('dtEvaluados', '/'+nombreApp+'/archivo/reporte/getDatosReporteTotales?'+$('#frmReporteTotales').serialize(),
              'expedientes_totales', 'Reporte de expedientes totales al año ' + $('#select_anio').val());
        
        event.preventDefault();
    });   

}(window.jQuery, window, document));