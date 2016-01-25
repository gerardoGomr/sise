@if (isset($dashboard))
	@foreach ($dashboard as $total)
	
		<div class="col-md-4 ">
			<div class="box-generic padding-none overflow-hidden animated fadeInUp" style="visibility: visible;">
					<h4 class="strong border-bottom innerAll margin-none">Expedientes entregados a custodia</h4>
					<div class="row row-merge">
						<div class="col-md-4 bg-gray">											
							<div class="innerAll inner-2x text-center">
								<div class="sparkline" sparkHeight="65" data-colors="#4a8bc2,#609450,#cacaca,#eb6a5a">
									{{$total['no_entregados_entrego_medico']}},
									{{$total['no_entregados_entrego_psicologia']}},
									{{$total['no_entregados_entrego_socioeconomico']}},
									{{$total['no_entregados_entrego_poligrafia']}}
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<div class="innerAll">
								<ul class="list-unstyled">
									<li class="innerAll half"><i class="fa fa-fw fa-square text-info"></i> <span class="strong">{{$total['no_entregados_entrego_medico']}}</span> Medico</li>
									<li class="innerAll half"><i class="fa fa-fw fa-square text-success"></i> <span class="strong">{{$total['no_entregados_entrego_psicologia']}}</span> Psicologia</li>
									<li class="innerAll half"><i class="fa fa-fw fa-square text-muted"></i> <span class="strong">{{$total['no_entregados_entrego_socioeconomico']}}</span> Socioeconomico</li>
									<li class="innerAll half"><i class="fa fa-fw fa-square text-primary"></i> <span class="strong">{{$total['no_entregados_entrego_poligrafia']}}</span> Poligrafia</li>
								</ul>
							</div>
						</div>
					</div>									
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="box-generic padding-none overflow-hidden">
				<h4 class="strong border-bottom innerAll margin-none">Expedientes no entregados a custodia</h4>
				<div class="row row-merge">
					<div class="col-md-4 bg-gray">										
						<div class="innerAll inner-2x text-center">
							<div class="sparkline" sparkHeight="65" data-colors="#4a8bc2,#609450,#cacaca,#eb6a5a">
								{{$total['no_entregados_falto_medico']}},
								{{$total['no_entregados_falto_psicologia']}},
								{{$total['no_entregados_falto_socioeconomico']}},
								{{$total['no_entregados_falto_poligrafia']}}
							</div>
						</div>
					</div>
					
					<div class="col-md-8">
						<div class="innerAll">
							<ul class="list-unstyled">
								
								<li class="innerAll half"><i class="fa fa-fw fa-square text-info"></i> <span class="strong">{{$total['no_entregados_falto_medico']}}</span> Medico</li>
								<li class="innerAll half"><i class="fa fa-fw fa-square text-success"></i> <span class="strong">{{$total['no_entregados_falto_psicologia']}}</span> Psicologia</li>
								<li class="innerAll half"><i class="fa fa-fw fa-square text-muted"></i> <span class="strong">{{$total['no_entregados_falto_socioeconomico']}}</span> Socioeconomico</li>
								<li class="innerAll half"><i class="fa fa-fw fa-square text-primary"></i> <span class="strong">{{$total['no_entregados_falto_poligrafia']}}</span> Poligrafia</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4 ">
			<div class="box-generic bg-info innerAll inner-2x animated fadeInUp" style="visibility: visible;">
				<div class="text-large pull-right">{{$total['totales_concluyo']}}</div>
				<h4 class="text-white text-medium margin-none">Ingresos Concluidos en el A&ntilde;o {{$total['anio']}}</h4>
				<h5 class="text-white">Faltan <b>{{$total['concluyo_no_entregados']}}</b> por entregar a Custodia</h5>
				<div class="separator"></div>
				<div class="progress progress-mini bg-info-dark margin-none">
					<div class="progress-bar bg-white" style="width: <?php echo ($total['concluyo_entregados']/$total['totales_concluyo'])*100; ?>%;"></div>
				</div>
			</div>
		</div>
	
	@endforeach
@endif