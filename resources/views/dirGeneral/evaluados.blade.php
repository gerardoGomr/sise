@extends('app_full')

@section('contenido')
	<div class="row row-app widget-employees">
		<div class="col-md-12">
			<div class="col-separator">
				<div class="row row-app">
					<div class="col-lg-3 col-md-4">
						<div class="col-separator col-separator-first box">
							<div class="col-table">
								<h4 class="innerAll border-bottom margin-none">Evaluados</h4>
								<div class="col-table-row">
									<div class="col-app col-unscrollable">
										<div class="col-app">
											<div class="innerAll bg-gray border-bottom">
												{!! Form::open(['url' => url('/dirGeneral/buscarEvaluado'), 'id' => 'formBusqueda']) !!}
													<div class="form-group">
														<input type="text" name="txtEvaluadoDato" id="txtEvaluadoDato" value="" placeholder="Escriba nombre, apellidos, RFC o CURP" class="form-control">
													</div>
												{!! Form::close() !!}
											</div>
											<span id="spBusquedaEvaluado" style="display:none"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
											<ul class="list-group list-group-1 borders-none margin-none" id="ulListaEvaluados">

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
								<h4 class="innerAll border-bottom margin-none">Perfil</h4>
								<div class="col-table-row">
									<div class="col-app col-unscrollable">
										<div class="col-app">
											<span id="spPerfilEvaluado" style="display:none"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
											<input type="hidden" id="urlPerfilEvaluado" value="{{ url('/dirGeneral/evaluado/perfil') }}">
											<div id="dvPerfilEvaluado">
												@if(isset($evaluado))
													@include('dirGeneral.evaluados_perfil')
												@endif
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
	<script type="text/javascript" src="{{ asset('public/js/dirGeneral/evaluados.js') }}"></script>
@stop