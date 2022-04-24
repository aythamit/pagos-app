@php
    $configData = Helper::applClasses();
@endphp
<div class="main-menu menu-fixed {{(($configData['theme'] === 'dark') || ($configData['theme'] === 'semi-dark')) ? 'menu-dark' : 'menu-light'}} menu-accordion menu-shadow"
     data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="/dashboard">
                    <span class="brand-logo">
                        <img src="{{asset('images/logo/logo.png')}}" class="logo-collapse"  width="100%" style="
                           "
                             alt="Alomran">
                    </span>
                    <h2 class="brand-text">Ordery</h2>
                </a>

{{--                <a style="" class="navbar-brand d-flex w-75" href="/{{@$user_auth->tipo}}/dashboard">--}}
{{--                    --}}{{--          <h2 class="brand-text">--}}
{{--                    --}}{{--            ZIEGEL--}}
{{--                    --}}{{--          </h2>--}}


{{--                </a>--}}

            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse" style="margin-top: 1.3rem;"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary"
                        data-feather="disc" data-ticon="disc"></i></a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            {{-- Foreach menu item starts --}}
            @if(isset($menuData[0]))
                @foreach($menuData[0]->menu as $menu)
                    @if(isset($menu->navheader))
                        <li class="navigation-header">
                            <span>{{ $menu->navheader }}</span>
                            <i data-feather="more-horizontal"></i>
                        </li>
                    @else
                        {{-- Add Custom Class with nav-item --}}
                        @php
                            $custom_classes = "";
                            if(isset($menu->classlist)) {
                            $custom_classes = $menu->classlist;
                            }

                            // Revisamos si el usuario tiene permisos en algun hijo para mostrar la categoría
                            $show = false;
                            if(isset($menu->submenu)){
                              foreach ($menu->submenu as $submenu){
                                if (isset($submenu->mostrar_siempre) ||(isset($submenu->permiso_nombre) && $submenu->permiso_nombre!= '' && $user_auth->hasPermiso($submenu->permiso_modulo,$submenu->permiso_nombre))){
                                    $show = true;
                                    break;
                                }

                              }
                            }else{
                              if (isset($menu->mostrar_siempre) ||(isset($menu->permiso_nombre) && $menu->permiso_nombre!= '' && $user_auth->hasPermiso($menu->permiso_modulo,$menu->permiso_nombre))){
                                  $show = true;
                              }
                            }

                        @endphp
                        @if($show)
                            <li class="nav-item {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }} {{ $custom_classes }}">
                                <a href="{{(isset($menu->routeName) && strlen($menu->routeName) > 0) ? route($menu->routeName) : (isset($menu->url)? url($menu->url):'javascript:void(0)')}}"
                                   class="d-flex align-items-center"
                                   target="{{isset($menu->newTab) ? '_blank':'_self'}}">
                                    {{--                                    <i data-feather="{{ $menu->icon }}"></i>--}}
                                    <i data-feather="{{ $menu->icon }}"></i>
                                    <span class="menu-title text-truncate">{{ $menu->name }}</span>
                                    @if (isset($menu->badge))
                                        <?php $badgeClasses = "badge badge-pill badge-light-primary ml-auto mr-1" ?>
                                        <span class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }} ">{{$menu->badge}}</span>
                                    @endif
                                </a>
                                @if(isset($menu->submenu))
                                    @include('panels/submenu', ['menu' => $menu->submenu])
                                @endif
                            </li>
                        @endif
                    @endif
                @endforeach
            @endif
            {{-- Foreach menu item ends --}}
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
