@if(isset($memoEntrega) && !is_null($memoEntrega))
    <table class="dynamicTable tableTools cell-border hover table" id="listaExpedientes">
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
                <?php
                    $evaluacion->entregoElArea() ? $estiloCss = 'text-success' : $estiloCss = 'text-danger';
                ?>
                <tr class="{{ $estiloCss }}">
                    <td>{{ $evaluacion->getElemento()->getNombreCompleto() }}</td>
                    <td>{{ $evaluacion->getElemento()->getCurp() }}</td>
                    <td>{{ $evaluacion->getNumeroEvaluacion() }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="separator bottom"></div>
    <div class="separator bottom"></div>
    <div class="separator bottom"></div>
    <div class="separator bottom"></div>

@else
    <h4>Sin evaluaciones agregadas.- Escanee un expediente</h4>
@endif