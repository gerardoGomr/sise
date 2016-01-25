@extends('app_fusion')

@section('contenido')
	<div class="row row-app">
		<div class="col-md-12">
			<div class="col-separator">
				<div class="row row-app">
					<ul class="breadcrumb">
						<li>
						  	<i class="fa fa-home"></i>
						  	<a id="direccion"  href="#">Dashboard</a>						  
						  	<i class="fa fa-angle-right"></i>
						</li>
						<li>
							Archivo
						</li>									 
					</ul>
					<!--<div class="col-lg-8 col-md-9">-->
					<div>
						<!-- col-table -->
			<div class="col-table">
				
				<!-- heading -->
				<div class="innerTB">
					<!--<h3 class="margin-none pull-left">Archivo</h3>-->
					
					<div class="clearfix"></div>
				</div>
				<!-- // END heading -->

				<div class="col-separator-h"></div>
				
				<!-- col-table-row -->
				<div class="col-table-row">

					<!-- col-app.col-unscrollable -->
					<div class="col-app col-unscrollable">

						<!-- col-app -->
						<div class="col-app">

							<!-- content -->
							<div class="row row-app">
								<input type="hidden" id="urlGraficaProgramadosMensual" value="{{ url('/archivo/expedientesCustodia') }}">
								<input type="hidden" id="urlTotales" value="{{ url('/archivo/getDatosTotales') }}">
								<input  type="hidden" id="_token" name="_token" value="{{csrf_token()}}">

								<div class="form-group">
									<!--<label class="col-sm-3 control-label"></label>-->
									<span style="float:left; padding-right: 5px; padding-top:5px;">Seleccionar a&ntilde;o:</span>
									<div class="col-sm-2">
										{!! Form::select('anio', $anio, $seleccionado, array('class'=>'form-control', 'id'=>'select_anio')); !!}
										
									</div>
									<br/><br/>
								</div>

								<div id="divDatosTotales"></div>
							</div>
							<div class="col-separator-h"/></div>
							
							<!-- // END content -->

						</div>
						<!-- // END col-app -->

					</div>
					<!-- // END col-app.col-unscrollable -->

				</div>
				<!-- // END col-table-row -->

			</div>
			<div class="col-md-8">
				<div class="col-separator col-unscrollable box col-separator-first">
					<div class="col-table">
						<!--<h4 class="innerAll border-bottom margin-none">Expedientes</h4>-->
						
						<div class="col-table-row">

							<div class="col-app col-unscrollable">
								<div class="col-app">											
									<div class="innerAll">												
										<span id="programadosLoading" style="display:none;"><i class="fa fa-spinner fa-spin fa-2x"></i></span>											
										
										
										<div id="dvGraficaExpedientes"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

					
			@include('archivo.menu_reporte')
									
            <div id="dvGraficaExpedientes_script"> </div>

				</div>
			</div>
		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/highcharts/js/highcharts.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/highcharts/js/modules/drilldown.js') }}"></script>

	<script type="text/javascript" src="{{ asset('public/assets/components/library/jquery/jquery-migrate.min.js?v=v1.9.6&sv=v0.0.1') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/charts/flot/assets/lib/jquery.flot.js?v=v1.9.6&sv=v0.0.1') }}"></script>

	<script type="text/javascript" src="{{ asset('public/assets/components/plugins/preload/pace/pace.min.js?v=v1.9.6&sv=v0.0.1') }}"></script> 
	<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/charts/easy-pie/assets/lib/js/jquery.easy-pie-chart.js?v=v1.9.6&sv=v0.0.1') }}"></script> 
	<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/charts/flot/assets/lib/jquery.flot.resize.js?v=v1.9.6&sv=v0.0.1') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/charts/flot/assets/lib/plugins/jquery.flot.tooltip.min.js?v=v1.9.6&sv=v0.0.1') }}"></script> 
	<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/charts/flot/assets/custom/js/flotcharts.common.js?v=v1.9.6&sv=v0.0.1') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/charts/flot/assets/lib/excanvas.js?v=v1.9.6&sv=v0.0.1') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/plugins/browser/ie/ie.prototype.polyfill.js?v=v1.9.6&sv=v0.0.1') }}"></script>

	<script type="text/javascript" src="{{ asset('public/assets/components/core/js/preload.pace.init.js?v=v1.9.6') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/charts/easy-pie/assets/custom/easy-pie.init.js?v=v1.9.6&sv=v0.0.1') }}"></script>
		
	<script type="text/javascript" src="{{ asset('public/js/archivo/graficasHighcharts.js') }}"></script>	
	<script type="text/javascript" src="{{ asset('public/js/archivo/dashboard.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/archivo/reportes.js') }}"></script>

	
	<script type="text/javascript">
        var tituloDrillUp = [];
        var tituloDrillUpText = "";        
  </script>
	
@stop