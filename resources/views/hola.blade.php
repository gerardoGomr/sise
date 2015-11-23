@extends('app')

@section('contenido')
	<ul>
		@foreach($listaPuestos as $puesto)
			<li>{{ $puesto->getId(). ' - ' .$puesto->getNombre() }}</li>
		@endforeach
	</ul>
@stop

@section('js')
	<script src="js/shdfjhaskjdf.js"></script>
@stop