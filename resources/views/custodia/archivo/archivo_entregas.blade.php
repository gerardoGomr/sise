@extends('app')

@section('contenido')
    <div class="row row-app">
        <div class="col-sm-12">
            <div class="col-separator col-unscrollable box col-separator-first">
                <div class="col-table">

                    <h4 class="innerAll border-bottom">Entrega de expedientes</h4>
                    <div class="col-table-row">
                        <div class="col-app col-unscrollable">
                            <div class="col-app">
                                <div class="innerAll">
                                    {!! Form::open(['id' => 'formBusqueda', 'url' => url('/')]) !!}
                                        <div class="form-group">
                                            <label class="control-label">Número serial:</label>
                                            <div class="row">
                                                <div class="col-md-3 border-right">
                                                    <input type="text" name="txtSerial" id="txtSerial" class="form-control">
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="button" class="btn btn-primary pull-right" value="Guardar">
                                                </div>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}

                                    <div class="box-generic">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Elemento</th>
                                                    <th>CURP</th>
                                                    <th>Número de evaluación</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Juan Pérez</td>
                                                    <td>Juan Pérez</td>
                                                    <td>Juan Pérez</td>
                                                    <td>
                                                        <a href="" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Quitar</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Juan Pérez</td>
                                                    <td>Juan Pérez</td>
                                                    <td>Juan Pérez</td>
                                                    <td>Juan Pérez</td>
                                                </tr>
                                            </tbody>
                                        </table>
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
    <script type="text/javascript" src="{{ asset('public/js/ajax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/custodia/archivo/archivo_entregas.js') }}"></script>
@stop