<ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
    <li class="nav-item" @if(View::hasSection('tab1-disabled')) disabled @endif>
        <a
                class="nav-link active"
                id="home-tab-justified"
                data-toggle="tab"
                href="#home-just"
                role="tab"
                aria-controls="home-just"
                aria-selected="true"
        ><i data-feather="home"></i>@yield('tab1-nombre')</a
        >
    </li>
    @if(View::hasSection('tab2-nombre'))
    <li class="nav-item" @if(View::hasSection('tab2-disabled')) disabled @endif>
        <a
                class="nav-link @if(View::hasSection('tab2-disabled')) disabled @endif"
                id="profile-tab-justified"
                data-toggle="tab"
                href="#profile-just"
                role="tab"
                aria-controls="profile-just"
                aria-selected="true"
        ><i data-feather='file-text'></i>@yield('tab2-nombre')</a
        >
    </li>
    @endif
    @if(View::hasSection('tab3-nombre'))
    <li class="nav-item" >
        <a
                class="nav-link @if(View::hasSection('tab3-disabled')) disabled @endif"
                id="messages-tab-justified"
                data-toggle="tab"
                href="#messages-just"
                role="tab"
                aria-controls="messages-just"
                aria-selected="false"
        ><i data-feather='@yield('tab3-icon')'></i>@yield('tab3-nombre')</a
        >
    </li>
    @endif
    @if(View::hasSection('tab4-nombre'))
    <li class="nav-item">
        <a
                class="nav-link @if(View::hasSection('tab4-disabled')) disabled @endif"
                id="settings-tab-justified"
                data-toggle="tab"
                href="#settings-just"
                role="tab"
                aria-controls="settings-just"
                aria-selected="false"
        ><i data-feather='shopping-bag'></i>@yield('tab4-nombre')</a
        >
    </li>
    @endif
</ul>

<!-- Tab panes | Si no son declarados, no aparecerán en la vista -->
<div class="tab-content pt-1">
    <div class="tab-pane active" id="home-just" role="tabpanel" aria-labelledby="home-tab-justified">
        @yield('tab1')
    </div>
    @if(View::hasSection('tab2'))
    <div class="tab-pane" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-justified">
        @yield('tab2')
    </div>
    @endif
    @if(View::hasSection('tab3'))
    <div class="tab-pane" id="messages-just" role="tabpanel" aria-labelledby="messages-tab-justified">
        @yield('tab3')
    </div>
    @endif

    @if(View::hasSection('tab4'))
    <div class="tab-pane p-0 m-0" id="settings-just" role="tabpanel" aria-labelledby="settings-tab-justified">
        @yield('tab4')
    </div>
    @endif

</div>