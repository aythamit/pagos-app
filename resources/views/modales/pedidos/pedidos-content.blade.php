<div id="card-estado" class="card mb-2 bg-{{strtolower($pedido->estado)}}">
    <div class="card-body">
        <p class="card-text">
            <b>Estado:</b> {{$pedido->estado}}
        </p>
    </div>
</div>

<h4 class="card-title">Productos</h4>

<div id="pedido-productos">
    @if(isset($pedido->pedido) && isset($pedido->pedido->productos) && sizeof($pedido->pedido->productos) > 0)
        <div class="accordion accordion-margin" id="accordionMargin" data-toggle-hover="true">
            @foreach($pedido->pedido->productos as $i=>$producto)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingMarginOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMargin{{$i}}" aria-expanded="false" aria-controls="accordionMargin{{$i}}">
                            <div class="d-flex justify-content-between w-100 me-1">
                                <div>
                                    {{$producto->nombre}}
                                </div>
                                <div>
                                    {{$producto->cantidad}}x <b>{{$producto->precio}} €</b>
                                </div>
                            </div>

                        </button>
                    </h2>
                    <div id="accordionMargin{{$i}}" class="accordion-collapse collapse" aria-labelledby="headingMargin{{$i}}" data-bs-parent="#accordionMargin" style="">
                        <div class="accordion-body">
                            <div>
                                <div><b>Unidades: </b> {{$producto->cantidad}} uds.</div>
                                <div><b>Precio unidad: </b> {{$producto->precio}} €</div>
                                <div><b>Observaciones: </b> {{$pedido->observaciones}}</div>
                                <div class="text-primary font-medium-3"><b>Total: </b> {{$producto->precio * $producto->cantidad}} €</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h4 class="card-title text-primary mt-2">Total: <b>{{$pedido->pedido->precio}} €</b></h4>
    @else
        <p class="text-danger"> <i class="fa-solid fa-circle-exclamation"></i> Parece que hay un error en este pedido. Por favor, contacte con el cliente.</p>
    @endif

</div>
