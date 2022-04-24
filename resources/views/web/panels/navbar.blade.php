<nav id="navbar" class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <img class="navbar-logo" width="50" height="50" src="{{asset('/images/logo/alomran.png')}}" alt="Alomran">
        <button class="navbar-toggler shadow-none" id="navbar-submenu" type="button" data-bs-toggle="collapse" data-bs-target="#submenuCollapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @php
                $isIndex = Route::currentRouteName() === 'index';
                @endphp
                <li class="nav-item">
                    <a onclick="
                        @if($isIndex) scrollSection('header')@else window.open('/', '_self') @endif"
                       class="navbar-link">HOME</a>
                </li>
                <li class="nav-item">
                    <a onclick="@if($isIndex) scrollSection('discover')@else window.open('/', '_self') @endif" class="navbar-link">ABOUT US</a>
                </li>
                <li class="nav-item">
                    <a onclick="@if($isIndex) scrollSection('services')@else window.open('/', '_self') @endif" class="navbar-link">OUR SERVICES</a>
                </li>
                <li class="nav-item">
                    <a onclick="@if($isIndex) scrollSection('map')@else window.open('/', '_self') @endif" class="navbar-link">CONTACT US</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="collapse submenu" id="submenuCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a onclick="@if($isIndex) scrollSection('header')@else window.open('/', '_self') @endif" class="navbar-link">HOME</a>
            </li>
            <li class="nav-item">
                <a onclick="@if($isIndex) scrollSection('discover')@else window.open('/', '_self') @endif" class="navbar-link">ABOUT US</a>
            </li>
            <li class="nav-item">
                <a onclick="@if($isIndex) scrollSection('services')@else window.open('/', '_self') @endif" class="navbar-link">OUR SERVICES</a>
            </li>
            <li class="nav-item">
                <a onclick="@if($isIndex) scrollSection('map')@else window.open('/', '_self') @endif" class="navbar-link">CONTACT US</a>
            </li>
        </ul>
    </div>
  </nav>