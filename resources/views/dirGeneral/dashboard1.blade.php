@extends('app_full')

@section('contenido')
	<div class="row row-app">
		<div class="col-md-12">
			<div class="col-separator">
				<div class="row row-app">
					<div class="col-lg-12 col-md-12">
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
													'url'   => url('dirGeneral/1'),
													'id'    => 'formDashboard',
													'class' => 'form-inline'
												])
											!!}
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<input type="text" name="fecha1" id="fecha1" class="fecha form-control" placeholder="Entre fecha:">
														</div>
													</div>

													<div class="col-md-3">
														<div class="form-group">
															<input type="text" name="fecha2" id="fecha2" class="fecha form-control" placeholder="y fecha:">
														</div>
													</div>

													<div class="col-md-3">
														<div class="form-group">
															<input type="button" name="btnBuscar" id="btnBuscar" class="btn btn-primary" value="Buscar">
														</div>
													</div>
												</div>
											{!! Form::close() !!}
										</div>
									</div>
								</div>

								<div class="col-separator-h"></div>

								<h4 class="innerAll border-bottom margin-none">Evaluaciones productividad</h4>
								<div class="col-table-row">
									<div class="col-app col-unscrollable">
										<div class="col-app">
											<div class="innerAll">
												<div class="separator bottom"></div>
												<span id="evaluadosLoading" style="display:none;"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
												<input type="hidden" id="urlGraficaEvaluadosProductividad" value="{{ url('dirGeneral/1/graficaEvaluadosProductividad') }}">

												<div id="dvGraficaEvaluadosProductividad">

												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-separator-h box"></div>
							</div>
						</div>
					</div>

					{{--<div class="col-lg-4 col-md-3">--}}
						{{--<div class="innerAll">--}}
							{{--<div class="separator bottom"></div>--}}
							{{--<input type="hidden" id="urlGraficaEvaluacionesPendientes" value="{{ url('/dirGeneral/graficaEvaluacionesPendientes') }}">--}}
							{{--<div id="dvGraficaEvaluacionesPendientes">--}}

							{{--</div>--}}
						{{--</div>--}}

						{{--<div class="row">--}}
							{{--<div class="col-md-6">--}}
								{{--<div class="box-generic bg-info innerAll inner-2x">--}}
									{{--<input type="hidden" id="urlTotalProgramados" value="{{ url('/dirGeneral/totalProgramados') }}">--}}
									{{--<div class="text-large pull-right" id="totalProgramados"></div>--}}
									{{--<h4 class="text-white margin-none">Programados pendientes por evaluar</h4>--}}
									{{--<h5 class="text-white fecha">Al día {{ date('Y-m-d') }}</h5>--}}
									{{--<div class="separator"></div>--}}
								{{--</div>--}}
							{{--</div>--}}

							{{--<div class="col-md-6">--}}
								{{--<div class="box-generic bg-success innerAll inner-2x">--}}
									{{--<input type="hidden" id="urlTotalEvaluacionesProceso" value="{{ url('/dirGeneral/totalEvaluacionesProceso') }}">--}}
									{{--<div class="text-large pull-right" id="totalEvaluacionesProceso"></div>--}}
									{{--<h4 class="text-white margin-none"><a href="{{ url('archivo/') }}" title="Ver detalle">Evaluaciones en proceso</a></h4>--}}
									{{--<h5 class="text-white fecha">Al día {{ date('Y-m-d') }}</h5>--}}
									{{--<div class="separator"></div>--}}
								{{--</div>--}}
							{{--</div>--}}

							{{--<div class="col-md-6">--}}
								{{--<div class="box-generic bg-primary innerAll inner-2x">--}}
									{{--<input type="hidden" id="urlTotalEvaluaciones" value="{{ url('/dirGeneral/totalEvaluaciones') }}">--}}
									{{--<div class="text-large pull-right" id="totalEvaluaciones"></div>--}}
									{{--<h4 class="text-white margin-none">Evaluaciones con resultado integral</h4>--}}
									{{--<h5 class="text-white fecha">Al día {{ date('Y-m-d') }}</h5>--}}
									{{--<div class="separator"></div>--}}
								{{--</div>--}}
							{{--</div>--}}
						{{--</div>--}}

						{{--<div class="box-generic padding-none overflow-hidden">--}}
							{{--<input type="hidden" id="urlResultadosIntegrales" value="{{ url('/dirGeneral/resultados') }}">--}}
							{{--<div class="row row-merge" id="dvResultadosIntegrales">--}}

							{{--</div>--}}
						{{--</div>--}}

						{{--<div class="row">--}}
							{{--<div class="col-md-12 col-lg-6">--}}
								{{--<div class="widget widget-heading-simple widget-body-white">--}}
									{{--<div class="widget-body innerAll inner-2x">--}}
										{{--<div class="innerL">--}}
											{{--<div class="separator bottom"></div>--}}
											{{--<div class="glyphicons glyphicon-large group">--}}
												{{--<i></i>--}}
												{{--<p>Buscar evaluados<br/><a href="{{ url('dirGeneral/evaluados') }}" class="btn btn-primary btn-sm">>> Ir a módulo</a></p>--}}
											{{--</div>--}}

										{{--</div>--}}
									{{--</div>--}}
								{{--</div>--}}
							{{--</div>--}}

							{{--<div class="col-md-12 col-lg-6">--}}
								{{--<div class="widget widget-heading-simple widget-body-white">--}}
									{{--<div class="widget-body innerAll inner-2x">--}}
										{{--<div class="innerL">--}}
											{{--<div class="separator bottom"></div>--}}
											{{--<div class="glyphicons glyphicon-large building">--}}
												{{--<i></i>--}}
												{{--<p>Buscar dependencias<br/><a href="{{ url('dirGeneral/dependencias') }}" class="btn btn-primary btn-sm">>> Ir a módulo</a></p>--}}
											{{--</div>--}}

										{{--</div>--}}
									{{--</div>--}}
								{{--</div>--}}
							{{--</div>--}}
						{{--</div>--}}
					{{--</div>--}}
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
	<script type="text/javascript" src="{{ asset('public/js/dirGeneral/dashboard1.js') }}"></script>
@stop