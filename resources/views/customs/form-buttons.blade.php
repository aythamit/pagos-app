<div class="row mt-1">
    <div class="col-12">
        @if(@$method!=='Ver')
            <button type="submit" class="btn btn-primary mr-1 data-submit">Guardar</button>
        @endif

        <button type="button" class="btn btn-outline-secondary btn-outline-dark mr-1" onclick="window.location.href='{{route($routeName)}}'">
            @if(@$method==='Ver')
                Volver
            @else
                Cancelar
            @endif
        </button>
    </div>
</div>
