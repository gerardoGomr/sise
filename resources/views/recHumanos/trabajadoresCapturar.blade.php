@extends('app')

@section('css')
	<link rel="stylesheet" type="text/css" href="/assets/components/common/gallery/image-crop/assets/lib/css/jquery.JCrop.css">
@stop

@section('contenido')
	<div class="row row-app">
		<div class="col-sm-12">
			<div class="col-separator">
				<div class="row row-app">
					<div class="col-md-5 col-lg-3">
						<div class="col-separator col-unscrollable box col-separator-first">
							<div class="col-table">
								<h4 class="innerAll border-bottom margin-none">Fotografía</h4>
								<div class="col-table-row">
									<div class="col-app col-unscrollable">
										<div class="col-app">
											<div class="innerAll">
												<div class="box-generic">
													<h4>Acciones</h4>
													<a href="javascript:;" id="btnAbrirCamara" class="btn btn-default btn-block"><i class="fa fa-camera"></i> Abrir cámara</a>
													<div class="separator"></div>
					                            	<a href="javascript:;" id="subirFoto" class="btn btn-default btn-block"><i class="fa fa-folder"></i> Buscar una foto en los archivos</a>
												</div>

												<div class="box-generic">
													<h4>Area de edición</h4>
					                            	<div class="dvFoto">
					                            		<input type="hidden" id="urlFotoRecortada" value="{{ url('rHumanos/recortarFoto') }}">
					                            		<span id="fotografia">
					                            			@include('recHumanos.trabajadoresFoto')
					                            		</span>
					                            		<div class="separator"></div>
					                            		{!! Form::open(['url' => url('rHumanos/subirFoto'), 'id' => 'formSubirImagen', 'enctype' => 'multipart/form-data']) !!}
					                            			<input type="file" name="fotoAdjuntada" id="adjuntarFoto" style="display:none;" class="imagenJpg" />
					                            		{!! Form::close() !!}
					                            	</div>
					                            </div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-7 col-lg-9">
						<div class="col-separator col-unscrollable box col-separator-last">
							<div class="col-table">
								<h4 class="innerAll border-bottom margin-none">Datos de usuario</h4>
								<div class="col-table-row">
									<div class="col-app col-unscrollable">
										<div class="col-app">
											<div class="innerAll">
												{!! Form::open(['url' => url('rHumanos/guardarTrabajador'), 'id' => 'formTrabajadores']) !!}
													@if(isset($trabajador))
														@include('recHumanos.trabajadoresEditar')
													@else
														@include('recHumanos.trabajadoresAgregar')
													@endif
												{!! Form::close() !!}
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
	<script type="text/javascript" src="/assets/components/common/forms/validator/assets/lib/jquery-validation/dist/jquery.validate.js"></script>
	<script type="text/javascript" src="/assets/components/common/forms/validator/assets/lib/jquery-validation/dist/additional-methods.js"></script>
	<script type="text/javascript" src="/assets/components/common/forms/validator/assets/lib/jquery-validation/dist/jquery.form.js"></script>
	<script type="text/javascript" src="/assets/components/common/gallery/image-crop/assets/lib/js/jquery.Jcrop.js?v=v1.9.6&sv=v0.0.1"></script>
	<script type="text/javascript" src="/js/validaciones.js"></script>
	<script type="text/javascript" src="/js/ajax.js"></script>
	<script type="text/javascript" src="/js/rHumanos/trabajadoresCapturar.js"></script>
@stop