<div class="col-12">
    <div class="card bg-primary shadow-lg">
        <div class="card-body text-center">
            <h1 class="text-white">Welcome {{ $user_auth->nombre }}!</h1>
            <p class="text-light">Today could be a great day.</p>
{{--            @if ($user_auth->tipo == 'agente')--}}
{{--                <p class="text-light">¡Revisa tus avances!</p>--}}
{{--            @endif--}}
{{--            <button type="button" id="btn-reload-all" class="btn btn-outline-light">--}}
{{--                <span class="mr-1"><i class="fa fa-redo-alt"></i></span>--}}
{{--                Recargar estadisticas--}}
{{--            </button>--}}
        </div>
    </div>
</div>
