@if(count($listaDependencias) > 0)
	@foreach($listaDependencias as $dependencias)
		<li class="list-group-item" onclick='$("li", $(this).parent()).removeClass("active");$(this).addClass("active");'>
			<div class="innerAll media">
				<a href="javascript:;" class="pull-left padding-none"><img src="{{ asset('public/assets/images/marker.png') }}" ></a>
				<div class="media-body innerT half">
					<p class="strong margin-none">
						<a class="padding-none dependencia" href="javascript:;">{{ $dependencias["Dependencia"] }}</a>
						<input type="hidden" name="idDependencia" value="{{ base64_encode($dependencias['idDependencia']) }}">
					</p>
					<p class="text-muted margin-none">{{ $dependencias["Municipio"] }}</p>
					{{ !empty($dependencias["Correo"]) ? '<i class="fa fa-envelope"></i>' : '' }}
					{{ !empty($dependencias["TelContacto"]) ? '<i class="fa fa-phone"></i>' : '' }}
				</div>
			</div>
		</li>
	@endforeach
@else
	<h4>No se encontraron resultados</h4>
@endif