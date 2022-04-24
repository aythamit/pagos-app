{{-- For submenu --}}
<ul class="menu-content">
    @if(isset($menu))

        @foreach($menu as $submenu)

            @if (isset($submenu->mostrar_siempre) ||(isset($submenu->permiso_nombre) && $submenu->permiso_nombre!= '' && $user_auth->hasPermiso($submenu->permiso_modulo,$submenu->permiso_nombre)))

                <li class="{{ $submenu->slug === Route::currentRouteName() ? 'active' : '' }}">
                    <a href="{{(isset($submenu->routeName) && strlen($submenu->routeName) > 0) ? route($submenu->routeName) : (isset($submenu->url) ? url($submenu->url):'javascript:void(0)')}}" class="d-flex align-items-center" target="{{isset($submenu->newTab) && $submenu->newTab === true  ? '_blank':'_self'}}">
                        @if(isset($submenu->icon))
{{--                            <i class="{{$submenu->icon}} fa-2x"></i>--}}
                            <i data-feather="{{$submenu->icon}}"></i>
                        @endif
                        <span class="menu-item">{{ __('locale.'.$submenu->name) }}</span>
                    </a>
                    @if (isset($submenu->submenu))
                        @include('panels/submenu', ['menu' => $submenu->submenu])
                    @endif
                </li>
            @endif
        @endforeach
    @endif
</ul>
