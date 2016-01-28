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
                                    {!! Form::open(['id' => 'formBusqueda', 'url' => url('custodia/archivo/entregas')]) !!}
                                        <div class="form-group">
                                            <label class="control-label">Escanee o escriba el folio del memorandum:</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input type="text" name="txtSerialMemo" id="txtSerialMemo" class="form-control" maxlength="24">
                                                </div>

                                            </div>
                                        </div>
                                    {!! Form::close() !!}

                                    <div class="box-generic">
                                        {!! Form::open(['id' => 'formExpediente', 'url' => url('custodia/archivo/entregas/expediente')]) !!}
                                            <div class="form-group">
                                                <label class="control-label">Escanee expedientes:</label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <input type="text" name="txtSerialExp" id="txtSerialExp" class="form-control" maxlength="10" disabled="disabled">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="button" class="btn btn-primary" value="Guardar >>">
                                            </div>
                                        {!! Form::close() !!}

                                        <div class="separator"></div>
                                        <span id="spanLoading" style="display: none;"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
                                        <div id="dvLista">
                                            @include('custodia.archivo.archivo_entregas_lista')
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
    <script type="text/javascript" src="{{ asset('public/js/ajax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/custodia/archivo/archivo_entregas.js') }}"></script>
@stop