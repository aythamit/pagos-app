<div class="row">
    <div class="col-12">
        @if(@$method!=='Show')
            <button type="submit" class="btn btn-primary mr-1 data-submit">Save</button>
        @endif

        <button type="button" class="btn btn-outline-secondary btn-outline-dark mr-1" onclick="window.location.href='{{route($routeName)}}'">
            @if(@$method==='Show')
                Go back
            @else
                Cancel
            @endif
        </button>
    </div>
</div>