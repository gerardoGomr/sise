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
            $( "#btnFrmReporteEnArchivo" ).trigger( "click" );
        }

        //Pongo 20 pixeles al boton del formulario para alinearlo
        $('#btnFrmReporteEnArchivo').css({'margin-top':'20px'}); 
    });
    

    //Detecto el evento clic sobre el checkbox
    $( '#filtro_por_area' ).on( 'click', function() {
        if( $(this).is(':checked') ){
            //Si el checkbox ha sido seleccionado
            //Oculto el div de los selects de areas
           $('#sin_filtro').hide();
           //Muestro el div de select por numero de area
           $('#filtro').show();
        } else {
            //Si el checkbox ha sido deseleccionado
            //Muestro el div de los selects de areas
            $('#sin_filtro').show();
            //Oculto el div de select por numero de area
            $('#filtro').hide();
        }
    });

    //Detecto si el select de estatus expedientes ha cambiado de valor
    $( "#estatus_expediente" ).change(function() {
        if($('#estatus_expediente').val() == 3){
            //Si se selecciona la opcion incompletos
            //Muestro el div que contiene el select de no de areas
            $('#filtro_para_incompleto').show();  
            //Muestro el div de los selects de areas
            $('#sin_filtro').show();
            //Pongo 0 pixeles al boton del formulario para alinearlo
            $('#btnFrmReporteEnArchivo').css({'margin-top':'0px'});                      
        }else{
            //Si se selecciona la opcion todos o completos
            //Oculto el div que contiene el select de no de areas
            $('#filtro_para_incompleto').hide();
             //Oculto el div de los selects de areas
            $('#sin_filtro').hide();
            //Oculto el div de select por numero de area
            $('#filtro').hide();
            //Pongo 20 pixeles al boton del formulario para alinearlo
            $('#btnFrmReporteEnArchivo').css({'margin-top':'20px'}); 
            //Quito la propiedad checked del checkbox
            $('#filtro_por_area').attr('checked', false); 

            toggleSelectDiferenciadas();   
        }

    });

    //Detecto si el select de diferenciadas ha cambiado de valor    
    $( "#estatus_diferenciadas").change(function() {
       toggleSelectDiferenciadas();
    });

    function toggleSelectDiferenciadas()
    {
        //Si es diferenciada
        if($('#estatus_diferenciadas').val() == 1){
            //Oculto el select de poligrafia
            $('#ocultar_poligrafia').hide();                      
        }else{
            //Muestro el select de poligrafia
            $('#ocultar_poligrafia').show();                 
        }
    }

    //Detecto el evento click sobre el boton del formulario
    $('#btnFrmReporteEnArchivo').on( "click", function(event) {
        var anio = $('#select_anio').val();
        var url = $('#urlGraficaEnArchivo').val();
        var nombreApp = getNombreApp(); 

        //Despliego los datos por pagina en la vista de detalle
        reiniciarDatatable('dtEvaluados', '/'+nombreApp+'/archivo/reporte/getDatosReporteEnArchivo?'+$('#frmReporteEnArchivo').serialize(),
              'expedientes_en_archivo', 'Reporte de expedientes en archivo correspondiente al año ' + $('#select_anio').val());
        
        //Despliego la grafica
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

        })
        .fail(function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown, textStatus);
            bootbox.alert('Imposible realizar la operación solicitada');
        });
    }
    
}(window.jQuery, window, document));