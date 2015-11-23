@if(isset($trabajador) && $trabajador->tieneFoto())
	<img src="{{ url($trabajador->getFotografia()->getRuta()) }}?{{ rand() }}" id="fotoCapturada" class="text-center" />
	<input type="hidden" name="x" id="x" value="" />
	<input type="hidden" name="y" id="y" value="" />
	<input type="hidden" name="w" id="w" value="{{ $trabajador->getFotografia()->getAncho() }}" />
	<input type="hidden" name="h" id="h" value="{{ $trabajador->getFotografia()->getAlto() }}" />
	<input type="hidden" id="imagenRecortada" value="{{ $trabajador->getFotografia()->recortada() }}" />
	<input type="hidden" name="urlFoto" id="urlFoto" value="{{ $trabajador->getFotografia()->getRuta() }}">
	<div class="separator"></div>
	<a href="javascript:;" id="btnRecortarImagen" class="btn btn-default recortar"><i class="fa fa-scissors"></i> Recortar Imagen</a>
	<a href="javascript:;" id="btnAceptarRecorte" class="btn btn-default aceptarRecorte" style="display:none"><i class="fa fa-check-square"></i> Aceptar</a>
	<a href="javascript:;" id="btnCancelarRecorte" class="btn btn-default cancelarRecorte" style="display:none"><i class="fa fa-times"></i> Cancelar recorte</a>
@else
	<img src="/img/default_user.png" id="fotoCapturada" class="text-center" />
	<input type="hidden" name="x" id="x" value="" />
	<input type="hidden" name="y" id="y" value="" />
	<input type="hidden" name="w" id="w" value="" />
	<input type="hidden" name="h" id="h" value="" />
	<input type="hidden" id="imagenRecortada" value="0" />
	<div class="separator"></div>
	<a href="javascript:;" id="btnRecortarImagen" class="btn btn-default recortar" style="display:none"><i class="fa fa-scissors"></i> Recortar Imagen</a>
	<a href="javascript:;" id="btnAceptarRecorte" class="btn btn-default aceptarRecorte" style="display:none"><i class="fa fa-check-square"></i> Aceptar</a>
	<a href="javascript:;" id="btnCancelarRecorte" class="btn btn-default cancelarRecorte" style="display:none"><i class="fa fa-times"></i> Cancelar recorte</a>
@endif