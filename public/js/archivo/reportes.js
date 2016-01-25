//Redirige al index del modulo de graficas de direccion 
//al hacer click sobre el enlace con el id direccion
$('#direccion').click(function() 
{   
    var nombreApp = getNombreApp();
    var url = '/'+nombreApp+'/dirGeneral';
       
    window.location = url;
});

//Redirige al index del modulo de graficas de archivo 
//al hacer click sobre el enlace con el id graficas
$('#graficas').click(function() 
{   
    redirigir(''); 
});


//Redirige al reporte de totales
//al hacer click sobre el enlace con el id reporteNoEntregados
$('#reporteTotales').on( "click", function() 
{  
    redirigir('reporte/reporte-totales/');   
});

//Redirige al reporte de expedientes no entregados a custodia 
//al hacer click sobre el enlace con el id reporteNoEntregados
$('#reporteNoEntregados').click(function() 
{    
    redirigir('reporte/reporte-no-entregados/');   
});

//Redirige al reporte de expedientes en archivo al hacer click sobre el 
//enlace con el id reporteEnArchivo
$('#reporteEnArchivo').click(function() 
{
    redirigir('reporte/reporte-en-archivo/');   
});

//Redirige al reporte de expedientes en proceso al hacer click sobre el 
//enlace con el id reporteEnProceso
$('#reporteEnProceso').click(function() 
{
    redirigir('reporte/reporte-en-proceso/');   
});

//Obtiene el nombre de la aplicacion, ejemplo http://wwww.dominio.com/sise/modulo
//con la funcion split separo por el caracter / y me deja un arreglo de la siguiente
//forma [http:, ,www.dominio.com, sise, modulo] donde la posicion 3 del arreglo
//corresponde al nombre de la aplicacion
function getNombreApp()
{
    var pathLocation = "" + window.location;
    var app = pathLocation.split("/"); 
   
    return app[3];
}

//funcion para redirigir hacia los reportes de archivos dada la ruta
function redirigir(ruta)
{
    var anio = $('#select_anio').val();
    var nombreApp = getNombreApp();
    var url = '/'+nombreApp+'/archivo/'+ruta+anio;
       
    window.location = url;
}
