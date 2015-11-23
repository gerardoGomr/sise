/**
 * cargar o guardar informacion con ajax - jquery
 * @param  string url
 * @param  string tipo
 * @param  string tipoDeDatos
 * @param  object parametros
 * @param  string modo
 * @param  string idLoading
 * @param  string idElementoALlenar
 * @return bool
 */
function ajax(url, tipo, tipoDeDatos, parametros, modo, idLoading, idElementoALlenar)
{
	if(modo === 'guardar') {
		return $.ajax({
			url:  	  url,
			type: 	  tipo,
			dataType: tipoDeDatos,
			data:     parametros
		});
	}

	if(modo === 'cargar') {
		$.ajax({
			url:  	  url,
			type: 	  tipo,
			dataType: tipoDeDatos,
			data:     parametros,
			beforeSend: function() {
				$('#' + idLoading).show();
			}
		})
		.done(function(resultado) {
			$('#' + idLoading).hide();
			console.log('¡Éxito!');
			$('#' + idElementoALlenar).html(resultado);

			return true;
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(errorThrown);
			$('#' + idLoading).hide();
			bootbox.alert('Imposible realizar la operación solicitada');
		});
	}
}

function doneHtml(resultado)
{

}

function doneJson(resultado)
{

}