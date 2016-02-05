@extends('app_iframe')

@section('contenido')
    <div class="row row-app">
        <div class="col-md-6 col-sm-6">
            <div class="col-separator col-unscrollable box">
                <h4 class="innerAll border-bottom"><i class="fa fa-search"></i> Observaciones realizadas</h4>
                <div class="col-table">
                    <div class="col-table-row">
                        <div class="col-app col-unscrollable">
                            <div class="col-app">
                                <div class="innerAll">
                                    <a href="javascript:;" class="btn btn-info btn-small" id="btnImprimir"><i class="fa fa-print"></i> Imprimir</a>

                                    <div class="pull-right">
                                        <p>Analista: <span class="strong">{{ $listaObservaciones['Analista'] }}</span></p>
                                        <p>Total Observaciones: <span class="strong">{{ count($listaObservaciones['Detalle']) }}</span></p>
                                        <p>Periodo: <span class="strong">{{ $listaObservaciones['Periodo'] }}</span></p>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="separator bottom"></div>
                                    <p>Fecha de generación: {{ date('Y-m-d H:m:i') }}</p>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Observación</th>
                                                <th>Análisis Observado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($listaObservaciones['Detalle'] as $observacion)
                                                <tr>
                                                    <td>{{ $observacion['FechaObservacion'] }}</td>
                                                    <td>{{ $observacion['Observacion'] }}</td>
                                                    <td>{{ $observacion['Texto'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('public/js/custodia/estadisticas/observaciones_analista_detalle.js') }}"></script>
@stop