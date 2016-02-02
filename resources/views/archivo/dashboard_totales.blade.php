@if (isset($totales))
	@foreach ($totales as $total)
	<?php 
		//Calculo los porcentajes
		$porcentaje_total = (($total['totales_no_concluyo']+$total['entregados_concluidos'])/$total['expedientes_totales'])*100;

		$porcentaje_ingresos = ($total['concluyo_entregados']/$total['totales_concluyo'])*100;

		$porcentaje_concluidos = ($total['entregados_concluidos']/$total['totales_concluyo'])*100;

		$porcentaje_no_concluyo = ($total['totales_no_concluyo']/$total['expedientes_totales'])*100;
	?>


	<div class="col-md-3">
		<a  id="reporteTotales"  href="#" onclick="redirigir('reporte/reporte-totales/');">
			<div class="col-separator">
				<div class="text-center innerAll inner-2x border-bottom">
				<div class="innerTB">
					<div data-percent="{{ $porcentaje_total }}" data-size="100" class="easy-pie inline-block easy-pie-gender primary" data-scale-color="false" data-track-color="#efefef" data-line-width="5">
						<div class="value text-center"  style="margin-top: -30px;">
							<span class="strong"><i class="icon-graph-up-1 fa-3x text-primary"></i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="text-center innerAll inner-2x bg-gray">			
				<p class="lead margin-none"><span class="text-large text-regular">{{$total['expedientes_totales']}}</span><span class="clearfix"></span> <span class="text-primary">Total evaluaciones</span></p>
			</div>		
		</a>

		</div>
	</div>
	<div class="col-md-3">
		<div class="col-separator">
			<div class="text-center innerAll inner-2x border-bottom">
				<div class="innerTB">
					<div data-percent="{{ $porcentaje_ingresos }}" data-size="100" class="easy-pie inline-block easy-pie-gender info" data-scale-color="false" data-track-color="#efefef" data-line-width="5">
						<div class="value text-center" style="margin-top: -30px;">
							<span class="strong"><i class="icon-graph-up-1 fa-3x text-info"></i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="text-center innerAll inner-2x bg-gray">
				<p class="lead margin-none"><span class="text-large text-regular">{{$total['totales_concluyo']}}</span><span class="clearfix"></span> <span class="text-info">Ingresos</span></p>
			</div>

		</div>
	</div>
	<div class="col-md-3">
		<div class="col-separator">
			<div class="text-center innerAll inner-2x border-bottom">
				<div class="innerTB">
					<div data-percent="{{ $porcentaje_concluidos }}" data-size="100" class="easy-pie inline-block easy-pie-gender success" data-scale-color="false" data-track-color="#efefef" data-line-width="5">
						<div class="value text-center"  style="margin-top: -30px;">
							<span class="strong" ><i class="icon-graph-up-1 fa-3x text-success"></i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="text-center innerAll inner-2x bg-gray">
				<p class="lead margin-none"><span class="text-large text-regular">{{$total['entregados_concluidos']}}</span> <span class="clearfix"></span> <span class="text-success">Con Resultado Integral</span></p>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="col-separator col-separator-last">
			<div class="text-center innerAll inner-2x border-bottom">
				<div class="innerTB">
					<div data-percent="0" data-size="100" class="easy-pie inline-block easy-pie-gender inverse" data-scale-color="false" data-track-color="#efefef" data-line-width="5">
						<div class="value text-center"  style="margin-top: -30px;">
							<span class="strong"><i class="icon-graph-up-1 fa-3x text-faded"></i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="text-center innerAll inner-2x bg-gray">
				<p class="lead margin-none"><span class="text-large text-regular">{{ $total['entregados_en_archivo'] + $total['entregados_en_proceso']}}</span> <span class="clearfix"></span><span>Sin Resultado Integral</span></p>
			</div>
		</div>
	</div>
	@endforeach
@endif