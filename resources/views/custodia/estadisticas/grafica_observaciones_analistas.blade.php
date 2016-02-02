@extends('app_full')

@section('contenido')
    <div class="row row-app">
        <div class="col-md-12">
            <div class="col-separator">
                <div class="row row-app">
                    <div class="col-lg-6 col-md-6">
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
                                                <div class="col-md-4">
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

                        <div class="innerAll">
                            <div class="row">
                            <div class="col-md-6">
                                <div class="box-generic bg-info innerAll inner-2x">
                                    <input type="hidden" id="urlTotalProgramados" value="{{ url('/dirGeneral/totalProgramados') }}">
                                    <div class="text-large pull-right" id="totalObservaciones">{{ $totalObservaciones }}</div>
                                    <h4 class="text-white margin-none">Total de observaciones</h4>
                                    <h5 class="text-white fecha">Al día {{ date('Y-m-d') }}</h5>
                                    <div class="separator"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="box-generic bg-success innerAll inner-2x">
                                    <input type="hidden" id="urlTotalEvaluacionesProceso" value="{{ url('/dirGeneral/totalEvaluacionesProceso') }}">
                                    <div class=" pull-right" id="observacionMasRecurrente">{{ $observacionMasRecurrente }}</div>
                                    <h4 class="text-white margin-none">Observación más recurrente:</h4>
                                    <h5 class="text-white fecha">Al día {{ date('Y-m-d') }}</h5>
                                    <div class="separator"></div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="col-separator col-separator-first box">
                            <div class="col-table">
                                <div class="innerAll bg-gray">
                                    {!! Form::open([
                                            'url'   => url('custodia/estadisticas/analistas/observaciones/detalle'),
                                            'id'    => 'formAnalistas',
                                            'class' => 'form-inline'
                                        ])
                                    !!}
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label">Analistas:</label>
                                                <select name="analistas" id="analistas" class="form-control">
                                                    <option value="">Todos</option>
                                                    @foreach($listaAnalistas as $analista)
                                                        <option value="{{ $analista['usuario'] }}">{{ $analista['nombre'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Entre fecha:</label>
                                                <input type="text" name="fecha1" id="fecha1" class="fecha form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Y fecha:</label>
                                                <input type="text" name="fecha2" id="fecha2" class="fecha form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="button" name="btnBuscar" id="btnBuscar" class="btn btn-primary" value="Buscar >>">
                                                <input type="hidden" name="anio" value="{{ date('Y') }}">
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>

                                <div class="col-separator-h"></div>

                                <h4 class="innerAll border-bottom margin-none">Observaciones en redacción de análisis integral.- Por analista</h4>
                                <div class="col-table-row">
                                    <div class="col-app col-unscrollable">
                                        <div class="col-app">
                                            <div class="innerAll">
                                                <div class="separator bottom"></div>
                                                <span id="analistasLoading" style="display:none;"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
                                                <div id="dvGraficaAnalistas"></div>
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
    <script type="text/javascript" src="{{ asset('public/assets/components/common/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/components/common/forms/elements/bootstrap-datepicker/assets/lib/js/locales/bootstrap-datepicker.es.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/ajax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/graficasHighcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/custodia/estadisticas/grafica_observaciones_analistas.js') }}"></script>
@stop