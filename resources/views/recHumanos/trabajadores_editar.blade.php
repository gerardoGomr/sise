<!-- form edición -->
<div class="box-generic">
	<div class="row">
		<div class="col-md-6 col-lg-4 ">
			<div class="form-group">
				<label class="control-label">Nombre:</label>
				<input type="text" name="txtNombre" id="txtNombre" value="{{ $trabajador->getNombre() }}" placeholder="" class="required form-control" />
			</div>
		</div>

		<div class="col-md-6 col-lg-4 ">
			<div class="form-group">
				<label class="control-label">A. Paterno:</label>
				<input type="text" name="txtPaterno" id="txtPaterno" value="{{ $trabajador->getPaterno() }}" placeholder="" class="required form-control" />
			</div>
		</div>

		<div class="col-md-6 col-lg-4 ">
			<div class="form-group">
				<label class="control-label">A. Materno:</label>
				<input type="text" name="txtMaterno" id="txtMaterno" value="{{ $trabajador->getMaterno() }}" placeholder="" class="form-control" />
			</div>
		</div>

		<div class="col-md-6 col-lg-4 ">
			<div class="form-group">
				<label class="control-label">Puesto:</label>
				<select name="puesto" id="puesto" class="form-control required">
					<option value="">Seleccione</option>
					@foreach($listaPuestos as $puesto)
						<?php $selectedPuesto = ''; ?>
						@if($trabajador->estaAsignadoElPuesto($puesto))
							<?php $selectedPuesto = 'selected="selected"' ?>
						@endif
						<option value="{{ $puesto->getId() }}" {!! $selectedPuesto !!}>{{ $puesto->getNombre() }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-md-6 col-lg-4 ">
			<div class="form-group">
				<label class="control-label">Área laboral:</label>
				<select name="area" id="area" class="form-control required">
					<option value="">Seleccione</option>
					@foreach($listaAreas as $area)
						<?php $selectedArea = ''; ?>
						@if($trabajador->estaAsignadaElArea($area))
							<?php $selectedArea = 'selected="selected"' ?>
						@endif

						<option value="{{ $area->numero() }}" {!! $selectedArea !!}>{{ $area->getNombre() }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-md-6 col-lg-4 ">
			<div class="form-group">
				<label class="control-label">Celular:</label>
				<input type="text" name="txtCelular" id="txtCelular" value="{{ $trabajador->getCelular() }}" placeholder="" class="numerosEnteros form-control" />
			</div>
		</div>

		<div class="col-md-9 col-lg-4 ">
			<div class="form-group">
				<label class="control-label">E-mail (institucional):</label>
				<div class="row">
					<div class="col-md-6">
						<input type="text" name="txtEmail" id="txtEmail" value="{{ $trabajador->getEmail() }}" placeholder="" class="form-control" />
					</div>
					<div class="col-md-6">
						<input type="text" name="txtDominio" id="txtDominio" value="@ceccc.gob.mx" class="form-control" readonly="readonly" />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@if(!$trabajador->tieneCuenta())
	<div class="box-generic">
		<div class="form-group">
			<div class="checkbox">
				<label>
					<input type="checkbox" name="usuarioSise" id="usuarioSise"> Usuario del Sistema de Seguimiento de Evaluaciones
				</label>
			</div>
		</div>
		<div class="row" style="display: none;" id="capturaUsuario">
			<div class="col-md-6 col-lg-4">
				<div class="form-group">
					<label class="control-label">Nombre de usuario:</label>
					<input type="text" name="txtUsername" id="txtUsername" value="" placeholder="nombre.apellidos" class="form-control" />
				</div>
			</div>

			<div class="col-md-6 col-lg-4 ">
				<div class="form-group">
					<label class="control-label">Contraseña:</label>
					<input type="password" name="txtPassword" id="txtPassword" value="" placeholder="" class="form-control" autocomplete="off" />
				</div>
			</div>
		</div>
	</div>
@endif
<div class="form-group">
	<input type="button" name="btnGuardar" id="btnGuardar" value="Guardar>>" class="btn btn-primary">
	<input type="button" name="btnCancelar" id="btnCancelar" value="Cancelar captura" class="btn btn-default">
	<input type="hidden" name="modo" id="modo" value="2">
	<input type="hidden" name="idTrabajador" value="{{ base64_encode($trabajador->getId()) }}">
	<input type="hidden" name="capturada" id="capturada" value="0">
	<input type="hidden" name="foto" id="foto" value="{{ $trabajador->tieneFoto() ? $trabajador->getFotografia()->getRuta() : '' }}" />
</div>