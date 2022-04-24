@extends('customs.empty')

@section('content')

    <input type="hidden" id="metodos_pago" value="{{json_encode($metodos)}}">
    <div id="main-metodos">
        <div class="row match-height">
            @foreach($metodos as $metodo)
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="w-100 text-center d-flex align-items-center" style="height: 12rem;">
                                <img class="img-fluid m-auto" src="{{asset('images/pages/metodos-pago/'.strtolower($metodo->nombre).'.png')}}" style="width: auto; height: 100%;" alt="Card image cap" />
                            </div>
                            <div class="d-flex justify-content-between mt-3 align-items-center">
                                <h6 class="card-text font-weight-bold">{{$metodo->nombre}}</h6>
                                <div class="d-flex flex-row align-items-center" style="height: 2em">
                                    @if($metodo->nombre != 'Efectivo')
                                        <button type="button"
                                                class="btn btn-flat-primary waves-effect cursor-pointer me-50"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-{{strtolower($metodo->nombre)}}"
                                                onclick="editarMetodo('{{$metodo->id}}')">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    @endif
                                    <div class="custom-control custom-control-primary custom-switch">
                                        <div class="form-check form-check-primary form-switch">
                                            <input type="checkbox" class="form-check-input cursor-pointer metodo-pago-switch" data-id="{{@$metodo->id}}" id="metodo-{{$metodo->id}}" @if($metodo->estado === 1) checked="" @endif>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>

@endsection

@section('crud-styles')
@endsection

@section('crud-scripts')
    <script src="{{ asset(mix('js/scripts/pages/metodospago/metodospago.js')). '?v='.$APP_VERSION }}"></script>
@endsection

@section('form')
@endsection

@section('modales')
    @include('modales.metodospago.modal-paypal')
    @include('modales.metodospago.modal-tarjeta')
@endsection
