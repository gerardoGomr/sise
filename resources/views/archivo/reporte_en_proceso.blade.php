@extends('app_fusion')

@section('css')
	<link rel="stylesheet" href="{{ asset('public/assets/components/common/tables/datatables/assets/lib/css/jquery.dataTables.css') }}" />	
	<link rel="stylesheet" href="{{ asset('public/assets/components/common/tables/datatables/assets/custom/css/DT_bootstrap.css') }}" />
	
	<link rel="stylesheet" href="{{ asset('public/assets/components/common/tables/datatables/1.10.10/buttons/buttons.dataTables.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/components/common/tables/datatables/1.10.10/font-awesome-4.5.0/css/font-awesome.min.css') }}" />
	
@stop('css')

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
							<a id="graficas"  href="#">Archivo</a>						  
							<i class="fa fa-angle-right"></i>
						</li>
						 <li>Expedientes en proceso de dictaminaci&oacute;n</li>
					</ul>
					<div class="box-generic padding-none overflow-hidden">
						<!--<h4 class="bg-gray innerAll border-bottom margin-none"><i class="fa fa-fw icon-wallet"></i> Sales Volume</h4>-->
						<div class="innerAll inner-2x">
							<!-- Horizontal Bars Chart -->
							<div id="chart_horizontal_bars" class="flotchart-holder"></div>
						</div>
					</div>


					<div class="col-lg-12">
						<div class="col-separator col-unscrollable box col-separator-first">
							<div class="col-table">
								<h4 class="innerAll border-bottom margin-none">Reporte de ingresos que estan en proceso de dictaminaci&oacute;n por a&ntilde;o</h4>
							
								<div class="col-table-row">

									<div class="col-app col-unscrollable">
										<div class="col-app">											
											<div class="innerAll">		
												{!! Form::open(array('id' => 'frmReporteEnProceso', 'url'=>null)) !!}
													{!! Form::hidden(null,url('/archivo/reporte/getDatosReporteEnProceso'), array('id' => 'urlReporteEnProceso')) !!}
													{!! Form::hidden(null,url('/archivo/reporte/getDatosGraficaEnProceso'), array('id' => 'urlGraficaEnProceso')) !!}
													{!! Form::hidden(null,csrf_token(), array('id' => '_token')) !!}

													
													<div class="form-group">
														<div class="col-sm-2">
															A&ntilde;o:
												    		{!! Form::select('anio', $anio, $seleccionado, array('class'=>'form-control', 'id'=>'select_anio')); !!}
												    	</div>	

													    <div class="col-sm-3">
													    	Estatus expediente:
													    	{!!Form::select('estatus',  $estatus, null, array('class'=>'form-control', 'id'=>'estatus')); !!}
													    </div>

													    <div id="btnFormulario" class="col-sm-2">
													    	{!! Form::button('Generar', array('id'=>'btnFrmReporteEnProceso','name'=>'enviarFrmReporteEnProceso', 'class'=>'btn btn-primary btn-stroke', 'style'=>'margin-top:20px')) !!}
													    </div>
													    
												    </div>
												    
											    {!! Form::close() !!}
											    											    												
												<!--<h3 class="innerTB">Table Tools</h3>-->
												
												<br/><br/>
												
												<!-- Widget -->
												<div class="widget" style="margin-top:50px;">

													<div id="divDatosEnProceso" class="widget-body innerAll inner-2x">
														<table id="dtEvaluados" class="dynamicTable tableTools table table-striped margin-none">
															<thead>
																<tr>
																	<th>Clave</th>
																	<th>Codigo</th>
																	<th>Nombre</th>
																	<th>Supervisor</th>
																	<th>Analista</th>
																	<th>Dependencia</th>
																	<th>Puesto</th>
																	<th>Curp</th>
																	<th>Estatus</th>
																	
																</tr>
															</thead>
															<tbody>
															</tbody>
														</table>
													</div>
												</div>
												<!-- // Widget END -->

											</div>
										</div>
									</div>
							</div>
						</div>
					</div>
				</div>
		</div>
	</div>


@stop('contenido')


@section('js')
	<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/highcharts/js/highcharts.js') }}"></script>	
		
	<script type="text/javascript" src="{{ asset('public/assets/components/common/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v1.9.6&sv=v0.0.1') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/common/forms/elements/select2/assets/lib/js/select2.js?v=v1.9.6&sv=v0.0.1') }}"></script>

	<script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/1.10.10/js/jquery.dataTables.min.js') }}"></script>
	
	<script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/assets/lib/extras/ColVis/media/js/ColVis.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/assets/custom/js/DT_bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/assets/lib/extras/FixedHeader/FixedHeader.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/assets/lib/extras/ColReorder/media/js/ColReorder.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/common/tables/classic/assets/js/tables-classic.init.js') }}"></script>

	
	<script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/1.10.10/buttons/dataTables.buttons.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/1.10.10/buttons/buttons.print.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/1.10.10/jszip/jszip.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/1.10.10/pdfmake/pdfmake.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/1.10.10/pdfmake/vfs_fonts.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/1.10.10/buttons/buttons.html5.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('public/js/util_dataTable.js') }}"></script>	

	<script type="text/javascript" src="{{ asset('public/js/archivo/graficasHighcharts.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/archivo/reportes.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/archivo/reporte_en_proceso.js') }}"></script>
	

	<script>
        $(document).ready(function(){          
        	 var nombreApp = getNombreApp(); 

        	 reiniciarDatatable('dtEvaluados', '/'+nombreApp+'/archivo/reporte/getDatosReporteEnProceso?'+$('#frmReporteEnProceso').serialize(),
              'expedientes_en_proceso', 'Reporte de expedientes en proceso de dictaminación correspondiente al año ' + $('#select_anio').val());
        });
    </script>

@stop('js')