function generarDatatables(idTabla){

    $('#'+idTabla).DataTable( {
        "oLanguage": {
            "sLengthMenu" : "Registros por pagina _MENU_ ",
            "sZeroRecords": "No hay registros",
            "sInfo"       : "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty"  : "No hay registros disponibles",
            "sSearch"     : "Buscar:",
            "oPaginate"   : {
                "sFirst"   : "Inicio",
                "sPrevious": "Anterior",
                "sNext"    : "Siguiente",
                "sLast"    : "Fin"
            },
            "sProcessing"  : "Cargando datos ... espere>",
            "sInfoFiltered": "(filtrado desde _MAX_ registros)"
        },
        "sPaginationType": "bootstrap",
        "sDom"           : "B<'row separator bottom'<'col-md-3'T><'col-md-3'l><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
        "bDestroy"       : true,
        "bProcessing"    : true,
        "sServerMethod"  : "POST",
        "bAutoWidth"     : false,
        "fnInitComplete" : function () {
            fnInitCompleteCallback(this);
        }
    });
}

function fnInitCompleteCallback(that)
{
    var p = that.parents('.dataTables_wrapper').first();
    var l = p.find('.row').find('label');

    l.each(function(index, el) {
        var iw = $("<div>").addClass('col-md-12').appendTo($(el).parent());
        $(el).parent().addClass('form-group margin-none').parent().addClass('form-horizontal');
        $(el).find('input, select').addClass('form-control').removeAttr('size').appendTo(iw);
        $(el).addClass('col-md-4 control-label');
    });
}