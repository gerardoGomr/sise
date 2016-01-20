<div class="innerAll">
	<h2>{{ $evaluado['Nombre'] }}</h2>

	<h3 class="text-muted"><a href="#">{{ isset($evaluado['evaluaciones']) && count($evaluado['evaluaciones']) > 0 ? count($evaluado['evaluaciones']) : 0 }} Evaluaciones &nbsp;<i class="fa fa-suitcase text-primary"></i></a></h3>
	<p class="margin-none innerTB half"><i class="fa fa-certificate text-primary"></i>&nbsp; {!! $evaluado["Puesto"].', '.$evaluado["Municipio"]; !!}</p>
	<div class="separator"></div>

	<div class="row">
		<div class="col-md-12 col-lg-5">
			<div class="box-generic text-center">
				<a href="" class="inline-block">
					@if(isset($evaluado['Foto']))
						<img src="data:image/jpeg; base64, {{ base64_encode($evaluado['Foto']) }}" width="100">
					@else
						<img src="{{ asset('public/img/50x50.png').'?'.date('ymd') }}" width="100">
					@endif
				</a>
				<div class="separator bottom"></div>
				<table border="0" width="70%" align="center">
					<tr><td><strong>Sangre</strong></td><td><strong>Estatura</strong></td><td><strong>Peso</strong></td></tr>
					<tr><td><?php echo $evaluado["Sangre"]; ?></td><td><?php echo $evaluado["Altura"]; ?> cm</td><td><?php echo $evaluado["Peso"]; ?> kg</td></tr>
				</table>
				<div class="separator bottom"></div>
				<h5 class="strong">Evaluaciones</h5>
				<div class="btn-group btn-group-vertical btn-group-block">
					@if(isset($evaluado['evaluaciones']) && count($evaluado['evaluaciones']) > 0)
						@foreach($evaluado['evaluaciones'] as $evaluacion)
							<a href="{{ url('dirGeneral/evaluado/perfil/') }}" class="btn btn-success btn-block evaluacion border-bottom"><i class="fa fa-search"></i>  Evaluación {{ $evaluacion["FechaEvaluacion"] }}</a>
							<input type="hidden" name="idEvaluacion" value="{{ base64_encode($evaluacion['idEvaluacion']) }}">
						@endforeach
					@endif
				</div>
			</div>
			<div class="bg-primary-light box-generic padding-none">
				<h5 class="strong border-bottom innerAll"><i class="fa fa-certificate text-primary pull-right"></i>Última Evaluacion: {{ $evaluado['Examenes'][0]['FechaEvaluacion'] }}</h5>

				<div class="innerAll">
					<dl class="dl-horizontal">
						<dt>RESULTADO INTEGRAL:</dt>
						<dd>{{ $evaluado['Examenes'][0]['ResultadoIntegral'] }}</dd>
						<dt>&nbsp;</dt>
						<dd>&nbsp;</dd>
						@if(count($evaluado['Examenes']) > 0)
							@foreach($evaluado['Examenes'] as $examen)
								<dt>{{ $examen['TipoExamen'] }}:</dt>
						  		<dd>{{ $examen['ResultadoExamen'] }}</dd>
							@endforeach
						@endif
					</dl>
				</div>
			</div>

			<div class="bg-primary-light box-generic padding-none">
				<h5 class="strong border-bottom innerAll"><i class="fa fa-user text-primary pull-right"></i> Datos de Contacto</h5>
				<div class="innerAll border-bottom">
					<ul class="list-unstyled fa-ul">
						<li><i class="fa fa-envelope"></i> ----</li>
						<li><i class="fa fa-phone"></i><?php echo $evaluado["TelCasa"]." / ".$evaluado["TelOficina"]." ".$evaluado["Extension"];?></li>
						<li><i class="fa fa-skype"></i> ----</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-12 col-lg-7">
			<div class="innerLR">
				<div class="box-generic">
					<h5 class="innerTB strong border-bottom">Acerca de</h5>
					<div class="separator bottom"></div>
					<p>
						<i class="fa fa-male fa-4x text-faded pull-left"></i>
						<table border="0" width="70%">
							<tr><td><strong>CUIP:</strong></td><td><?php echo $evaluado["CUIP"]; ?></td></tr>
							<tr><td><strong>CURP:</strong></td><td><?php echo $evaluado["CURP"]; ?></td></tr>
							<tr><td><strong>RFC:</strong></td><td><?php echo $evaluado["RFC"]; ?></td></tr>
							<tr><td><strong>Fecha nacimiento:</strong></td><td><?php echo $evaluado["FechaNacimiento"]; ?></td></tr>
							<tr><td><strong>Nacimiento:</strong></td><td><?php echo $evaluado["LugarNacimiento"]; ?></td></tr>
							<tr><td><strong>Sexo:</strong></td><td><?php echo $evaluado["Sexo"]; ?></td></tr>
							<tr><td><strong>Estado civil:</strong></td><td><?php echo $evaluado["EstadoCivil"]; ?></td></tr>
							<tr><td><strong>Escolaridad:</strong></td><td><?php echo $evaluado["Escolaridad"]; ?></td></tr>

						</table>

						<span class="clearfix"></span>
					</p>

					<h5 class="innerTB strong border-bottom">Trabajo Actual</h5>
					<div class="separator bottom"></div>
					<p>
						<i class="fa fa-suitcase fa-4x text-faded pull-left"></i>

						<table width="70%">
							<tr><td><strong>Municipio:</strong></td><td><?php echo $evaluado["Municipio"]; ?></td></tr>
							<tr><td><strong>Dependencia:</strong></td><td><a href="index.php?act=dependencias&uic=<?php //echo base64_encode($evaluado["idDependencia"]) ?>" class="no-ajaxify"><?php echo $evaluado["Dependencia"]; ?></a></td></tr>
							<tr><td><strong>Corporación:</strong></td><td><?php //echo $evaluado["Corporacion"]; ?></td></tr>
							<tr><td><strong>Puesto:</strong></td><td><?php echo $evaluado["Puesto"]; ?></td></tr>

							<tr><td><strong>Mando:</strong></td><td><?php echo $evaluado["Mando"]; ?></td></tr>
							<tr><td><strong>Rango:</strong></td><td><?php echo $evaluado["Rango"]; ?></td></tr>
							<tr><td><strong>Especialidad:</strong></td><td><?php echo $evaluado["Especialidad"]; ?></td></tr>

						</table>

						 <span class="clearfix"></span>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-separator-h box"></div>

<div class="innerAll">
	<div class="innerAll">
		<h5 class="strong">Seguimiento de Evaluaciones</h5>
		@if(isset($evaluado['evaluaciones']) && count($evaluado['evaluaciones']) > 0)
			<ul class="team">
			@foreach($evaluado['evaluaciones'] as $evaluacion)
				<li class="bg-primary-light">
					<a href="{{ url('dirGeneral/evaluado/perfil/pdf/'.base64_encode($evaluacion['idEvaluacion'])) }}" target="_blank" title="Ver PDF">
						<span class="crt bg-primary"><i class="fa fa-download"></i></span>
						<span class="strong">{{ $evaluacion['FechaEvaluacion'] }}</span><span class="muted">&nbsp;</span>
					</a>
				</li>
			@endforeach
			</ul>
			<div class="clearfix"></div>
		@endif
	</div>
</div>