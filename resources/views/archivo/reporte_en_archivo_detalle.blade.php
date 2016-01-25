@if (isset($dashboard))
	@foreach ($dashboard as $total)
		<div class="box-generic padding-none overflow-hidden">
			<div class="row row-merge border-bottom">
				<div class="col-md-4">
					<div class="innerAll inner-2x text-center">
						<h5>Completos sin analizar</h5>
						<h4 class="text-medium text-primary text-condensed">{{$total['en_archivo_completos_sin_analizar']}}</h4>
					</div>
				</div>
				<div class="col-md-4">
					<div class="innerAll inner-2x text-center">
						<h5>Completos diferenciados sin analizar</h5>
						<h4 class="text-medium text-primary text-condensed">{{$total['en_archivo_completos_sin_analizar_diferenciados']}}</h4>
					</div>
				</div>
				<div class="col-md-4">
					<div class="innerAll inner-2x text-center">
						<h5>Incompletos</h5>
						<h4 class="text-medium text-primary text-condensed">{{$total['en_archivo_entrego_un_area']}}</h4>
					</div>
				</div>
			</div>
			
		</div>
	@endforeach
@endif