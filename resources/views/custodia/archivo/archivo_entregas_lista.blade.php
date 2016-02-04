@if(isset($memoEntrega) && !is_null($memoEntrega))
    <div class="form-group">
        <?php
            $memoEntrega->entregado() ? $disabled = '' : $disabled = 'disabled="disabled"';
        ?>
        <a class="marcarEntrega btn btn-success btn-lg text-center" href="{{ url('custodia/archivo/entregas/marcar') }}" {{ $disabled }}><i class="fa fa-save"></i> Marcar entrega</a>
    </div>
    <div class="separator border-bottom"></div>
    <table class="dynamicTable tableTools cell-border hover table" id="listaExpedientes">
        <thead>
        <tr>
            <th>Elemento</th>
            <th>CURP</th>
            <th>Número de evaluación</th>
            <th>Serial</th>
        </tr>
        </thead>
        <tbody>
            @foreach($memoEntrega->getListaEvaluaciones() as $evaluacion)
                <?php
                    $evaluacion->entregoElArea() === true ? $estiloCss = 'text-success' : $estiloCss = 'text-danger';
                ?>
                <tr class="{{ $estiloCss }}">
                    <td>{{ $evaluacion->getElemento()->getNombreCompleto() }}</td>
                    <td>{{ $evaluacion->getElemento()->getCurp() }}</td>
                    <td>{{ $evaluacion->getNumeroEvaluacion() }}</td>
                    <td>{{ $evaluacion->getSerial()->getSerialBase() }}</td>
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