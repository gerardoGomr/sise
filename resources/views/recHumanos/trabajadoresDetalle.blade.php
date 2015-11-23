<div class="innerAll">
	<div class="media border-bottom">
		@if($trabajador->tieneFoto())
			<img src="{{ url($trabajador->getFotografia()->getRuta()).'?'.rand() }}" class="thumb pull-left" alt="">
		@else
			<img src="/img/default_user.png" class="thumb pull-left" alt="" width="100">
		@endif
		<div class="media-body innerAll half">
			<h4 class="media-heading text-large">{{ $trabajador->getNombreCompleto() }}</h4>
			<dl class="dl-horizontal">
				<dt>Área laboral:</dt>
				<dd>{{ $trabajador->getArea()->getNombre() }}</dd>
				<dt>Puesto:</dt>
				<dd>{{ $trabajador->getPuesto()->getNombre() }}</dd>
				<dt>E-mail:</dt>
				<dd><?php echo !is_null($trabajador->getEmail()) || !empty($trabajador->getEmail()) ? $trabajador->getEmail() : '-' ?></dd>
				<dt>Celular:</dt>
				<dd><?php echo !is_null($trabajador->getCelular()) || !empty($trabajador->getCelular()) ? $trabajador->getCelular() : '-' ?></dd>
				@if($trabajador->tieneCuenta())
					<dt>Username:</dt>
					<dd>{{ $trabajador->getUsuario()->getUsername() }}</dd>
				@endif
			</dl>
		</div>

		<a href="{{ url('rHumanos/edicion/'.base64_encode($trabajador->getId())) }}" class="btn btn-info btn-sm"><i class="fa fa-fw fa-edit"></i> Editar datos</a>

		@if($trabajador->tieneCuenta())
			@if($trabajador->activo())
				<a href="{{ url('rHumanos/password/'.base64_encode($trabajador->getId())) }}" class="btn btn-info btn-sm cambiarPassword" data-fancybox-type="iframe"><i class="fa fa-fw fa-key"></i> Cambiar contraseña</a>

				<a href="{{ url('rHumanos/desactivar') }}" class="btn btn-info btn-sm desactivar"><i class="fa fa-fw fa-ban"></i> Desactivar usuario</a>
			@else
				<a href="{{ url('rHumanos/activar') }}" class="btn btn-info btn-sm activar"><i class="fa fa-fw fa-check-circle"></i> Activar usuario</a>
			@endif

			<input type="hidden" name="idTrabajador" value="{{ base64_encode($trabajador->getId()) }}">
		@endif

	</div>
</div>

<div class="col-separator-h"></div>

<h4 class="innerAll border-bottom">Privilegios</h4>
<div class="innerAll">

</div>