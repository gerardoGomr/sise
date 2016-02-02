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
						 <li>Totales evaluaciones</li>
					</ul>
					
					<br/>
					<div class="col-lg-12" >
						<div class="col-separator col-unscrollable box col-separator-first">
							<div class="col-table">
								<h4 class="innerAll border-bottom margin-none">Reporte de Expedientes Totales</h4>
							
								<div class="col-table-row">

									<div class="col-app col-unscrollable">
										<div class="col-app">											
											<div class="innerAll">		
												{!! Form::open(array('id' => 'frmReporteTotales', 'url'=>null)) !!}
													{!! Form::hidden(null,url('/archivo/reporte/getDatosReporteTotales'), array('id' => 'urlReporteTotales')) !!}
													
													{!! Form::hidden(null,csrf_token(), array('id' => '_token')) !!}

													
													<div class="form-group">
														<div class="col-sm-2">
															A&ntilde;o:
												    		{!! Form::select('anio', $anio, $seleccionado, array('class'=>'form-control', 'id'=>'select_anio')); !!}
												    	</div>	

												    	<div class="col-sm-2">
													    	Estatus:
													    	{!!Form::select('estatus',  $estatus, null, array('class'=>'form-control', 'id'=>'estatus')); !!}
													    </div>
													    <div class="col-sm-2">
													     	Concluyo:
													    	{!!Form::select('concluyo',  $concluyo, null, array('class'=>'form-control', 'id'=>'concluyo')); !!}
													    </div>
													     <div class="col-sm-2">
													     	Diferenciadas:
													    	{!!Form::select('diferenciada',  $diferenciada, null, array('class'=>'form-control', 'id'=>'diferenciada')); !!}
													    </div>
													     <div class="col-sm-2">
													     	Tipo:
													    	{!!Form::select('tipo',  $tipo, null, array('class'=>'form-control', 'id'=>'tipo')); !!}
													    </div>
													 </div>

													<div class="form-group" >
												    	<!--<div style="clear: both"></div>-->
												    	<div class="col-sm-3">
												    		M&eacute;dico:
													    	{!!Form::select('medico', $opciones, null, array('class'=>'form-control', 'id'=>'select_medico')); !!}
													    </div>
													    <div class="col-sm-3">
													     	Poligrafia:
													    	{!!Form::select('poligrafia',  $opciones, null, array('class'=>'form-control', 'id'=>'select_poligrafia')); !!}
													    </div>		
													    <div class="col-sm-3">
													    	Psicologia:
													    	{!!Form::select('psicologia',  $opciones, null, array('class'=>'form-control', 'id'=>'select_psicologia')); !!}
													    </div>
													    <div class="col-sm-3">
													    	Socioeconomico:
													    	{!!Form::select('socioeconomico',  $opciones, null, array('class'=>'form-control', 'id'=>'select_socioeconomico')); !!}
													    </div>
													     											    
												    </div>

												    <div class="form-group" >
												    	<!--<div style="clear: both"></div>-->
												    	<div class="col-sm-3" >
												    	Resultado Integral:
													    	{!!Form::select('resultado', $resultado, null, array('class'=>'form-control', 'id'=>'resultado')); !!}
													    </div>
													    <div class="col-sm-3">
													     	Procedencia:
													    	{!!Form::select('procedencia',  $procedencia, null, array('class'=>'form-control', 
													    	'id'=>'procedencia')); !!}
													    </div>		
													    <div class="col-sm-3">
													    	Supervisor:
													    	{!!Form::select('supervisor',  $supervisor, null, array('class'=>'form-control', 
													    	'id'=>'supervisor')); !!}
													    </div>
													    <div class="col-sm-3">
													    	Analista:
													    	{!!Form::select('analista',  $analista, null, array('class'=>'form-control',											    
													    	'id'=>'analista')); !!}
													    </div>
													     											    
												    </div>

												    <div id="btnFormulario" class="col-sm-2">
												    	{!! Form::button('Generar', array('id'=>'btnFrmReporteTotales','name'=>'enviarFrmReporteTotales', 'class'=>'btn btn-primary btn-stroke', 'style'=>'margin-top:20px')) !!}
												    </div>
													    
												   
												    
											    {!! Form::close() !!}
											    											    												
												<!--<h3 class="innerTB">Table Tools</h3>-->
												
												<br/><br/>
												<div style="clear: both; "></div>
												<!-- Widget -->
												<div class="widget" style="margin-top:50px;">

													<div id="divDatosEnProceso" class="widget-body innerAll inner-2x" style="overflow: auto;">
														<table id="dtEvaluados" class="dynamicTable tableTools table table-striped margin-none">
															<thead>
																<tr>
																	<th>Clave Archivo</th>
																	<th>Clave CECCC</th>
																	<th>Procedencia</th>
																																		
																	<th>Nombre</th>
																	<th>Curp</th>
																	<th>Medico</th>
																	<th>Poligrafia</th>
																	<th>Psicologia</th>
																	<th>Socioeconomico</th>																
																	<th>Fecha Alta</th>
																	<th>Tipo</th>
																	<th>Resultado Integral</th>

																	<th>Supervisor</th>
																	<th>Analista</th>

																	<th>Estatus</th>

																	<th>Diferenciada</th>
																	<th>Concluyo</th>
																	
																	
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

	
	<script type="text/javascript" src="{{ asset('public/js/archivo/reportes.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/archivo/reporte_totales.js') }}"></script>
	

	<script>
        $(document).ready(function(){          
        	 var nombreApp = getNombreApp(); 

        	 reiniciarDatatable('dtEvaluados', '/'+nombreApp+'/archivo/reporte/getDatosReporteTotales?'+$('#frmReporteTotales').serialize(),
              'expedientes_totales', 'Reporte de expedientes totales al año ' + $('#select_anio').val());
        });
    </script>

@stop('js')