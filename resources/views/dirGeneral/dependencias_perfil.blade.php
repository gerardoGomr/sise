<div class="innerAll">
	<h2>{{ $dependencia["Dependencia"] }}</h2>
	<div class="row">
		<div class="col-md-8">
			<h4 class="innerTB strong border-bottom">{{ $dependencia["Municipio"] }}</h4>
			<div class="row">
				<div class="col-md-4 text-center">
					<div class="animated bounceInDown">
						<a href="" class="inline-block"><img src="{{ asset('public/assets/img/') }}" alt="Profile" width="380" class="img-responsive img-rounded thumb" /></a>
						<div class="separator bottom"></div>

					</div>
				</div>

				<div class="col-md-8">
					<div class="innerLR">
						<h5 class="innerTB strong border-bottom">Acerca de la Dependencia</h5>
						<div class="separator bottom"></div>
						<table border="0" width="100%">
							<tr>
								<td>
									<table border="0" width="100%">
										<tr><td width="30%"><strong>Domicilio:</strong> </td><td>{{ $dependencia["Calle"].' '.$dependencia["NumExt"].' '.$dependencia["NumInt"] }}</td></tr>
										<tr><td width="30%"><strong>Municipio:</strong> </td><td>{{ $dependencia["Municipio"] }}</td></tr>
										<tr><td width="30%"><strong>Padrón:</strong> </td><td>{{ isset($dependencia['Padron']) ? count($dependencia['Padron']) : '-' }}</td></tr>
									</table>
								</td>
							</tr>

						</table>
						<div class="separator bottom"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="bg-primary-light box-generic padding-none">
				<h5 class="strong border-bottom innerAll"><i class="fa fa-user text-primary pull-right"></i> Datos de Contacto</h5>
				<div class="innerAll border-bottom">
					<ul class="list-unstyled fa-ul">
						<li><i class="fa fa-envelope"></i> {{ !empty($dependencia["Correo"]) ? $dependencia["Correo"] : "----" }}</li>
						<li><i class="fa fa-phone"></i> {{ !empty($dependencia["TelContacto"]) ? $dependencia["TelContacto"] : "----" }}</li>

					</ul>
				</div>
			</div>
		</div>
	</div>
	<h4 class="margin-none innerAll">Padrón de Evaluados</h4>
	@if(isset($dependencia['Padron']) && count($dependencia['Padron']) > 0)
		<div class="col-app col-unscrollable">
			<div class="col-app">
				<table class="table table-vertical-center table-striped bg-white margin-none table-bordered">
					<thead>
						<tr>
							<th class="center">CURP</th>
							<th>CUIP</th>
							<th>Fecha Nacimiento</th>
							<th>Nombre</th>
							<th>Sexo</th>
							<th>Ult. Evaluación</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						@foreach($dependencia['Padron'] as $padron)
							<tr>
								<td>{{ $padron["CURP"] }}</td>
								<td>{{ $padron["CUIP"] }}</td>
								<td>{{ $padron["FechaNacimiento"] }}</td>
								<td>{{ $padron["Nombre"] }}</td>
								<td>{{ $padron["Sexo"] }}</td>
								<td>{{ $padron["UltimaEvaluacion"] }}</td>
								<td class="center"><a href="{{ url('dirGeneral/evaluados/'.base64_encode($padron['CURP'])) }}" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Ver perfil</a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	@else
		<h5 class="innerAll">No cuenta con padrón</h5>
	@endif
</div>