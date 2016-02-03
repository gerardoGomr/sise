@extends('app')

@section('css')
    <link rel="stylesheet" href="{{ asset('public/assets/components/common/tables/datatables/assets/lib/css/jquery.dataTables.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/components/common/tables/datatables/assets/custom/css/DT_bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/components/common/tables/datatables/1.10.10/buttons/buttons.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/components/common/tables/datatables/1.10.10/font-awesome-4.5.0/css/font-awesome.min.css') }}" />

@stop('css')

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
    <script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/1.10.10/js/jquery.dataTables.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/assets/lib/extras/ColVis/media/js/ColVis.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/assets/custom/js/DT_bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/assets/lib/extras/FixedHeader/FixedHeader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/assets/lib/extras/ColReorder/media/js/ColReorder.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/components/common/tables/classic/assets/js/tables-classic.init.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/1.10.10/buttons/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/1.10.10/buttons/buttons.print.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/1.10.10/jszip/jszip.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/1.10.10/pdfmake/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/1.10.10/pdfmake/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/components/common/tables/datatables/1.10.10/buttons/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/util_dataTable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/ajax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/custodia/archivo/archivo_entregas.js') }}"></script>
@stop