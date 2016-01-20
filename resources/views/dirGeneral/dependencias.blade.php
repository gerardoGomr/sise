@extends('app')

@section('contenido')
	<div class="row row-app ">
		<div class="col-md-12">
			<div class="col-separator">
				<div class="row row-app widget-employees">
					<div class="col-lg-3 col-md-4">
						<div class="col-separator col-separator-first box">
							<div class="col-table">
								<h4 class="innerAll border-bottom margin-none">Dependencias</h4>
								<div class="innerAll bg-gray border-bottom">
									{!! Form::open(['url' => url('dirGeneral/buscarDependencia'), 'id' => 'formBusqueda']) !!}
										<div class="form-group">
											<input type="text" name="txtDependencia" id="txtDependencia" value="" placeholder="Escriba nombre de dependencia o municipio" class="form-control">
										</div>
									{!! Form::close() !!}
								</div>
								<div class="col-table-row">

									<div class="col-app col-unscrollable">
										<div class="col-app">

											<span id="spBusquedaDependencia" style="display:none"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
											<ul class="list-group list-group-1 borders-none margin-none" id="ulListaDependencias">
												@include('dirGeneral.dependencias_lista')
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-9 col-md-8">
						<div class="col-separator col-separator-last box">
							<div class="col-table">
								<div class="heading-buttons border-bottom innerLR">
									<h4 class="innerAll border-bottom margin-none">Perfil de la dependencia</h4>
									<a href="{{ url('dirGeneral/') }}" class="btn btn-success btn-sm">Volver a Dashboard</a>
									<div class="clearfix"></div>
								</div>

								<div class="col-table-row">
									<div class="col-app col-unscrollable">
										<div class="col-app">
											<span id="spPerfilDependencia" style="display:none"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
											<input type="hidden" id="urlPerfilDependencia" value="{{ url('dirGeneral/dependencia/perfil') }}">
											<div id="dvPerfilDependencia">
												@include('dirGeneral.dependencias_perfil')
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
	<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/employees/assets/js/employees.js?v=v1.9.6&sv=v0.0.1') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/ajax.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/dirGeneral/dependencias.js') }}"></script>
@stop