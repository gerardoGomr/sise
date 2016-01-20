@if(!is_null($listaTrabajadores))
	@foreach($listaTrabajadores as $trabajador)
		<li class="list-group-item animated">
			<div class="media innerAll">
				<div class="media-body innerT half">
					<a class="strong margin-none text-primary trabajador" href="javascript:;">{{ $trabajador->getNombreCompleto() }}</a>
					<input type="hidden" class="idTrabajador" value="{{ base64_encode($trabajador->getId()) }}">
					<ul class="list-unstyled margin-none">
						<li><i class="fa fa-dot-circle-o"></i> {{ $trabajador->getArea()->getNombre() }}</li>
						@if($trabajador->tieneCuenta())
						<li class="text-primary"><i class="fa fa-dot-circle-o"></i> Usuario Sise</li>
						@endif
					</ul>
				</div>
			</div>
		</li>
	@endforeach
@else
	<h4>Sin resultados</h4>
@endif