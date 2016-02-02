function reiniciarDatatable(idTable, url, filename, message_print ){
		
	$('#'+idTable).DataTable( {	
		"oLanguage": {
			"sLengthMenu": "Registros por pagina _MENU_ ",
		    "sZeroRecords": "No hay registros",
		    "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
		    "sInfoEmpty": "No hay registros disponibles",
		    "sSearch": "Buscar:",
		    "oPaginate": {
		    	"sFirst": "Inicio",
		    	"sPrevious": "Anterior",
		    	"sNext": "Siguiente",
		    	"sLast": "Fin"
		    },
		    "sProcessing": "Cargando dato ... espere>",
		    "sInfoFiltered": "(filtrado desde _MAX_ registros)",
		    "buttons": {
                "copyTitle": 'Copiado a portapapeles',
                "copySuccess": {
			        1: "Copiado una fila al portapapeles",
			        _: "Copiado %d filas al portapapeles"
			    }
            }
		},
		"sPaginationType": "bootstrap",	   
		"sDom": "B<'row separator bottom'<'col-md-3'T><'col-md-3'l><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",	   
	    "buttons": [	    	
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Exportar a excel',
                title: 	   filename
            },
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copiar'
            },
            {
                extend:    'print',
                text:      '<i class="fa fa-print"></i>',
                titleAttr: 'Imprimir',              
                message: message_print,
                /*customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            '<img src="{{ asset("public/img/logo_255.png") }}" style="position:absolute; top:0; left:0;" />'
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }*/
            }
	    ], 
	    "bDestroy": true,    	
	    "bProcessing": true,	
		"sAjaxSource":url,
		"sServerMethod": "POST",
		"bAutoWidth": false,
		"fnInitComplete": function () {	fnInitCompleteCallback(this);  }
		
	});
}

function fnInitCompleteCallback(that)
{
	var p = that.parents('.dataTables_wrapper').first();
		var l = p.find('.row').find('label');

    	l.each(function(index, el) {
    		var iw = $("<div>").addClass('col-md-8').appendTo($(el).parent());
    		$(el).parent().addClass('form-group margin-none').parent().addClass('form-horizontal');
		$(el).find('input, select').addClass('form-control').removeAttr('size').appendTo(iw);
		$(el).addClass('col-md-4 control-label');
    	});

    	var s = p.find('select');
    	s.addClass('.selectpicker').selectpicker();
}