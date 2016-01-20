@if(!is_null($listaEvaluados))
	@foreach($listaEvaluados as $evaluado)
		<li class="list-group-item">
			<div class="media innerAll">
				@if($evaluado['Foto'] !== '-')
					<img src="data:image/jpeg; base64, {{ base64_encode($evaluado['Foto']) }}" width="35" class="pull-left thumb">
				@else
					<img src="{{ asset('public/img/50x50.png').'?'.date('ymd') }}" width="35" class="pull-left thumb">
				@endif
			  	<div class="media-body">
			  		<h5 class="media-heading strong"><a class="evaluado" href="javascript:;" title="Ver detalles">{{ $evaluado['Nombre'] }}</a></h5>
			  		<input type="hidden" name="curp" value="{{ $evaluado['CURP'] }}">
			   		<ul class="list-unstyled">
			   	 		<li><i class="fa fa-phone"></i> {{ $evaluado['CURP'] }}</li>
			    		<li><i class="fa fa-map-marker"></i> {{ $evaluado['RFC'] }}</li>
			    	</ul>
			  	</div>
			</div>
		</li>
	@endforeach
@else
	<h4>No se encontraron coincidencias</h4>
@endif