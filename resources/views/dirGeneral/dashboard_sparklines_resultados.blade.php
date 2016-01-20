<div class="col-lg-3 col-md-3 bg-gray">
	<div class="innerAll inner-2x text-center">
		@if(count($listaResultados) > 0)
			<?php
				$total     = count($listaResultados);
				$dataColor = '';
			?>
			@for($i = 0; $i < $total; $i++)
				@if($i < ($total - 1))
					<?php $dataColor .= $coloresRGB[$i].','?>
				@else
					<?php $dataColor .= $coloresRGB[$i]?>
				@endif
			@endfor
			<div id="sparkline" data-colors="{{ $dataColor }}" sparkHeight="65">
				<?php
					$i = 0;

				?>
				@foreach($listaResultados as $resultado)
					@if($i < ($total-1))
						{{ round(($resultado['TotalEvaluaciones'] * 100) / $totalEvaluaciones, 2).',' }}
					@else
						{{ round(($resultado['TotalEvaluaciones'] * 100) / $totalEvaluaciones, 2) }}
					@endif

					<?php $i++; ?>
				@endforeach
			@endif
		</div>
	</div>
</div>

<div class="col-lg-9 col-md-8">
	<div class="innerAll">
		<ul class="list-unstyled">

			@for($i = 0; $i < count($listaResultados); $i++)
				<li class="innerAll half">
					<i class="fa fa-fw fa-square {{ $colores[$i] }}"></i>
					<span class="strong">{{ $listaResultados[$i]['TotalEvaluaciones'] }}</span> {{ $listaResultados[$i]['cResultadoint'] }}
				</li>

			@endfor
		</ul>
	</div>
</div>