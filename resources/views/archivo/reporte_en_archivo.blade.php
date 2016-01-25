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
						 <li>Expedientes en archivo</li>
					</ul>
					

					<div id="dvGrafica" class="col-lg-12 ">
						
					</div>				

					<div class="col-lg-12">
						<div class="col-separator col-unscrollable box col-separator-first">
							<div class="col-table">
								<h4 class="innerAll border-bottom margin-none">Reporte de ingresos que estan en archivo por area y a&ntilde;o</h4>
							
								<div class="col-table-row">

									<div class="col-app col-unscrollable">
										<div class="col-app">											
											<div class="innerAll">		
												{!! Form::open(array('id' => 'frmReporteEnArchivo', 'url'=>null)) !!}
													{!! Form::hidden(null,url('/archivo/reporte/getDatosReporteEnArchivo'), array('id' => 'urlReporteEnArchivo')) !!}
													{!! Form::hidden(null,url('/archivo/reporte/getDatosGraficaEnArchivo'), array('id' => 'urlGraficaEnArchivo')) !!}
													{!! Form::hidden(null,csrf_token(), array('id' => '_token')) !!}

													
													<div class="form-group">
														<div class="col-sm-2">
															A&ntilde;o:
												    		{!! Form::select('anio', $anio, $seleccionado, array('class'=>'form-control', 'id'=>'select_anio')); !!}
												    	</div>	
													    <div class="col-sm-3">
													    	Estatus expediente:
													    	{!!Form::select('estatus_expediente',  $estatus, null, array('class'=>'form-control', 'id'=>'estatus_expediente')); !!}
													    </div>
													     <div class="col-sm-3">
													     	Diferenciadas:
													    	{!!Form::select('estatus_diferenciadas',  $es_diferenciada, null, array('class'=>'form-control', 'id'=>'estatus_diferenciadas')); !!}
													    </div>
													    <div id="filtro_para_incompleto" class="col-sm-2" style="display:none">
													     	Filtrar incompletos:
													    	{!! Form::label('lblfiltro_uno', 'No. de areas'); !!}
													    	{!!Form::checkbox('filtro', 'si', false, array("id"=>"filtro_por_area","style"=>"margin-right:10px;")); !!}
													    	
													    </div>												    
													    
												    </div>
												  
												 
												    <div id="filtro" class="form-group" style="display:none;">
												    	<div style="clear: both"></div>
												    	<div class="col-sm-3">
													    	Solo entrego:
													    	{!!Form::select('no_area',  $numero_entregados, null, array('class'=>'form-control', 'id'=>'no_area')); !!}
													    </div>													   
												    </div>												    
												    
												    <div id="sin_filtro" class="form-group" style="display:none;">
												    	<div style="clear: both"></div>
												    	<div class="col-sm-2">
												    		M&eacute;dico:
													    	{!!Form::select('medico', $opciones, null, array('class'=>'form-control', 'id'=>'select_medico')); !!}
													    </div>
													    <div class="col-sm-2">
													    	Psicologia:
													    	{!!Form::select('psicologia',  $opciones, null, array('class'=>'form-control', 'id'=>'select_psicologia')); !!}
													    </div>
													    <div class="col-sm-2">
													    	Socioeconomico:
													    	{!!Form::select('socioeconomico',  $opciones, null, array('class'=>'form-control', 'id'=>'select_socioeconomico')); !!}
													    </div>
													     <div id="ocultar_poligrafia" class="col-sm-2">
													     	Poligrafia:
													    	{!!Form::select('poligrafia',  $opciones, null, array('class'=>'form-control', 'id'=>'select_poligrafia')); !!}
													    </div>													    
												    </div>
												     <div class="col-sm-2">
													    	{!! Form::button('Generar', array('id'=>'btnFrmReporteEnArchivo','name'=>'enviarFrmReporteEnArchivo', 'class'=>'btn btn-primary btn-stroke')) !!}
													 </div>
											    {!! Form::close() !!}
											    											    												
												<!--<h3 class="innerTB">Table Tools</h3>-->
												
												<br/><br/>
												
												<!-- Widget -->
												<div class="widget" style="margin-top:50px;">

													<div id="divDatosEnArchivo" class="widget-body innerAll inner-2x">
														<table id="dtEvaluados" class="dynamicTable tableTools table table-striped margin-none">
															<thead>
																<tr>																	
																	<th>Clave</th>
																	<th>Codigo</th>
																	<th>Nombre</th>
																	<!--<th>Sexo</th>
																	<th>Alta</th>-->
																	<th>Dependencia</th>
																	<th>Puesto</th>
																	<th>Curp</th>
																	<th>Tipo</th>
																	<th>Méd.</th>
																	<th>Psi.</th>
																	<th>Soc.</th>
																	<th>Pol.</th>
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
	<script type="text/javascript" src="{{ asset('public/js/archivo/reporte_en_archivo.js') }}"></script>
	

	<script>
        $(document).ready(function(){ 
        	var nombreApp = getNombreApp();          
        	
        	reiniciarDatatable('dtEvaluados', '/'+nombreApp+'/archivo/reporte/getDatosReporteEnArchivo?'+$('#frmReporteEnArchivo').serialize(),
        	  'expedientes_en_archivo', 'Reporte de expedientes en archivo correspondiente al año ' + $('#select_anio').val());
        });
    </script>
@stop('js')