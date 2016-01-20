@extends('app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/components/modules/admin/modals/assets/js/source/jquery.fancybox.css') }}">
@stop

@section('contenido')
    <div class="row row-app">
        <div class="col-sm-12">
            <div class="col-separator">
                <div class="row row-app">
                    <div class="col-md-4 col-lg-3">
                        <div class="col-separator col-unscrollable box col-separator-first">
                            <div class="heading-buttons border-bottom innerLR">
                                <h4 class="margin-none innerTB pull-left">Trabajadores registrados</h4>
                                <a href="{{ url('recHumanos/captura') }}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i> Agregar trabajador<i class="fa fa-user fa-fw"></i></a>
                                <div class="clearfix"></div>
                            </div>

                            <div class="innerAll bg-gray">

                                {!! Form::open([
                                    'url' => 'recHumanos/buscarTrabajador',
                                    'id'  => 'formTrabajadores'
                                ]) !!}
                                    <div class="form-group">
                                        <input type="text" name="txtDato" id="txtDato" value="" placeholder="Ingrese nombre, apellidos, RFC, CURP o username" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="tipo" value="" checked="checked"> Todos
                                            </label>
                                        </div>

                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="tipo" value=""> Sin usuario registrado
                                            </label>
                                        </div>

                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="tipo" value=""> Con usuario registrado
                                            </label>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="col-table">
                                <div class="col-table-row">
                                    <div class="col-app col-unscrollable">
                                        <div class="col-app">
                                            <span id="busquedaTrabajadores" style="display:none;" class="innerAll"><i class="fa fa-spinner fa-spin"></i></span>
                                            <input type="hidden" id="urlClickTrabajador" value="{{ url('recHumanos/detalle') }}">
                                            <ul id="listaTrabajadores" class="list-group list-group-1 borders-none">
                                                @include('recHumanos.trabajadores_lista')
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-lg-9">
                        <div class="col-separator col-separator-last box">
                            <div class="col-table">
                                <h4 class="innerAll margin-none border-bottom">Información de trabajador</h4>
                                <div class="col-table-row">
                                    <div class="col-app col-unscrollable">
                                        <div class="col-app">
                                            <span id="resultadoTrabajadores" style="display:none;" class="innerAll"><i class="fa fa-spinner fa-spin"></i></span>
                                            <div id="dvDatosTrabajador">
                                                <!-- datos del usuario seleccionado -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/modals/assets/js/source/jquery.fancybox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/ajax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/recHumanos/trabajadores.js') }}"></script>
@stop