@extends('app_full')

@section('contenido')
	<div class="row row-app">
		<div class="col-md-12">
			<div class="col-separator">
				<div class="row row-app">
					<div class="col-lg-8 col-md-9">
						<div class="col-separator col-separator-first box">
							<div class="col-table">
								<h4 class="innerAll border-bottom margin-none">Programados</h4>
								<div class="col-table-row">
									<div class="col-app col-unscrollable">
										<div class="col-app">
											<div class="innerAll">
												<div class="row">
													<div class="col-md-3 col-lg-3">
														<label class="control-label">Año:</label>
														<select class="form-control">
															<option value="">2015</option>}

														</select>
													</div>
												</div>
												<div class="separator bottom"></div>
												<span id="programadosLoading" style="display:none;"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
												<input type="hidden" id="urlGraficaProgramadosMensual" value="{{ url('/dirGeneral/graficaProgramadosMensual') }}">
												<input type="hidden" id="_token" value="{{ csrf_token() }}">
												<div id="dvGraficaProgramadosMensual">

												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-separator-h box"></div>

								<h4 class="innerAll border-bottom margin-none">Evaluaciones</h4>
								<div class="col-table-row">
									<div class="col-app col-unscrollable">
										<div class="col-app">
											<div class="innerAll">
												<div class="row">
													<div class="col-md-3 col-lg-3">
														<label class="control-label">Año:</label>
														<select class="form-control">
															<option value="">2015</option>}

														</select>
													</div>
												</div>
												<div class="separator bottom"></div>
												<span id="evaluadosLoading" style="display:none;"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
												<input type="hidden" id="urlGraficaEvaluadosMensual" value="{{ url('/dirGeneral/graficaEvaluadosMensual') }}">

												<div id="dvGraficaEvaluadosMensual">

												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-md-3">
						<div class="box-generic bg-info innerAll inner-2x">
							<input type="hidden" id="urlTotalProgramados" value="{{ url('/dirGeneral/totalProgramados') }}">
							<div class="text-large pull-right" id="totalProgramados">{{ $totalProgramados }}</div>
							<h4 class="text-white text-medium margin-none">Programados</h4>
							<h5 class="text-white">Al día {{ date('Y-m-d') }}</h5>
							<div class="separator"></div>
							<!-- <div class="progress progress-mini bg-info-dark margin-none">
								<div class="progress-bar bg-white" style="width: 70%;"></div>
							</div> -->
						</div>

						<div class="box-generic bg-success innerAll inner-2x">
							<input type="hidden" id="urlTotalEvaluacionesProceso" value="{{ url('/dirGeneral/totalEvaluacionesProceso') }}">
							<div class="text-large pull-right" id="totalEvaluacionesProceso">{{ $totalEvaluacionesProceso }}</div>
							<h4 class="text-white text-medium margin-none">Evaluaciones en proceso</h4>
							<h5 class="text-white">Al día {{ date('Y-m-d') }}</h5>
							<div class="separator"></div>
							<!-- <div class="progress progress-mini bg-info-dark margin-none">
								<div class="progress-bar bg-white" style="width: 70%;"></div>
							</div> -->
						</div>

						<div class="box-generic bg-primary innerAll inner-2x">
							<input type="hidden" id="urlTotalEvaluaciones" value="{{ url('/dirGeneral/totalEvaluaciones') }}">
							<div class="text-large pull-right" id="totalEvaluaciones">{{ $totalEvaluaciones }}</div>
							<h4 class="text-white text-medium margin-none">Evaluaciones concluídas</h4>
							<h5 class="text-white">Al día {{ date('Y-m-d') }}</h5>
							<div class="separator"></div>
							<!-- <div class="progress progress-mini bg-info-dark margin-none">
								<div class="progress-bar bg-white" style="width: 70%;"></div>
							</div> -->
						</div>

						<div class="box-generic padding-none overflow-hidden">
							<div class="row row-merge">
							<div class="col-lg-3 col-md-3 bg-gray">
								<div class="innerAll inner-2x text-center">
									<?php
										$i = 1;
										$dataColors = implode(',', $coloresRGB);
									?>
									<div class="sparkline" data-colors="{{ $dataColors }}" sparkHeight="65">
										@foreach($listaResultados as $resultado)
											{{ round(($resultado['TotalEvaluaciones'] * 10) / $totalEvaluaciones).',' }}
										@endforeach
									</div>
								</div>
							</div>

							<div class="col-lg-9 col-md-8">
								<div class="innerAll">
									<ul class="list-unstyled">
										<?php $i = 0 ?>
										@foreach($listaResultados as $resultado)
											<li class="innerAll half">
												<i class="fa fa-fw fa-square {{ $colores[$i] }}"></i>
												<span class="strong">{{ $resultado['TotalEvaluaciones'] }}</span> {{ $resultado['cResultadoint'] }}
											</li>
											<?php $i++; ?>
										@endforeach
									</ul>
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
	<script type="text/javascript" src="/assets/components/modules/admin/charts/sparkline/jquery.sparkline.min.js?v=v1.9.6&sv=v0.0.1"></script>
	<script type="text/javascript" src="/assets/components/modules/admin/charts/sparkline/sparkline.init.js?v=v1.9.6&sv=v0.0.1"></script>
	<script type="text/javascript" src="/assets/components/modules/admin/highcharts/js/highcharts.js"></script>
	<script type="text/javascript" src="/js/ajax.js"></script>
	<script type="text/javascript" src="/js/graficasHighcharts.js"></script>
	<script type="text/javascript" src="/js/dirGeneral/dashboard.js"></script>
@stop