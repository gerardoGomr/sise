@extends('app_iframe')

@section('contenido')
	<div class="row row-app">
		<div class="col-md-6 col-sm-6">
			<div class="col-separator col-unscrollable box">
				<h4 class="innerAll border-bottom"><i class="fa fa-key"></i> Modificación de contraseña</h4>
				<div class="col-table">
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<div class="innerAll">
									{!! Form::open([
	                                    'url' => 'recHumanos/password',
	                                    'id'  => 'formPassword'
	                                ]) !!}
										<div class="form-group">
											<label class="control-label">Nueva contraseña:</label>
											<input type="password" name="txtPassword" id="txtPassword" value="" placeholder="" class="required form-control">
										</div>

										<div class="form-group">
											<input type="button" name="btnGuardar" id="btnGuardar" value="Aceptar >>" class="btn btn-primary">
											<input type="hidden" name="idTrabajador" value="{{ base64_encode($trabajador->getId()) }}">
										</div>
	                                {!! Form::close() !!}
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
	<script type="text/javascript" src="{{ asset('public/assets/components/common/forms/validator/assets/lib/jquery-validation/dist/jquery.validate.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/validaciones.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/ajax.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/recHumanos/trabajadores_cambiar_password.js') }}"></script>
@stop