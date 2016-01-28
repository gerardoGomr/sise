@if(isset($memoEntrega) && !is_null($memoEntrega))
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Elemento</th>
            <th>CURP</th>
            <th>Número de evaluación</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @foreach($memoEntrega->getListaEvaluaciones() as $evaluacion)
                <tr>
                    <td>{{ $evaluacion->getElemento()->getNombreCompleto() }}</td>
                    <td>{{ $evaluacion->getElemento()->getCurp() }}</td>
                    <td>{{ $evaluacion->getNumeroEvaluacion() }}</td>
                    <td>
                        <a href="" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Quitar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <h4>Sin evaluaciones agregadas.- Escanee un expediente</h4>
@endif