@extends('app_full')

@section('contenido')
    <div class="row row-app">
        <div class="col-md-12">
            <div class="col-separator">
                <div class="row row-app">
                    <div class="col-lg-8 col-md-9">
                        <div class="col-separator col-separator-first box">
                            <div class="col-table">
                                <div class="innerAll bg-gray">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <span class="text-primary strong">Año actual: </span>
                                            <span class="strong" id="anioActual">{{ date('Y') }}</span> &nbsp;
                                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                        </div>

                                        <div class="col-md-10">
                                            {!! Form::open([
                                                    'url'   => url('custodia/estadisticas/analistas/observaciones'),
                                                    'id'    => 'formCustodia',
                                                    'class' => 'form-inline'
                                                ])
                                            !!}
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Cambiar:</label>
                                                        <select name="anio" id="anio" class="form-control">
                                                            <option value="">Seleccione</option>
                                                            @foreach($listaAnios as $anio)
                                                                <option value="{{ $anio }}">{{ $anio }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-separator-h"></div>

                                <h4 class="innerAll border-bottom margin-none">Observaciones en redacción de análisis integral.- General, mensual</h4>
                                <div class="col-table-row">
                                    <div class="col-app col-unscrollable">
                                        <div class="col-app">
                                            <div class="innerAll">
                                                <div class="separator bottom"></div>
                                                <span id="evaluadosLoading" style="display:none;"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
                                                <input type="hidden" id="urlGraficaObservaciones" value="{{ url('custodia/estadisticas/analistas/grafica/observaciones/general') }}">

                                                <div id="dvGraficaObservacionesGeneral">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/charts/sparkline/jquery.sparkline.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/charts/sparkline/sparkline.init.js?v=v1.9.6&sv=v0.0.1') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/highcharts/js/highcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/highcharts/js/modules/drilldown.src.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/ajax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/graficasHighcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/custodia/estadisticas/grafica_observaciones_analistas.js') }}"></script>
@stop