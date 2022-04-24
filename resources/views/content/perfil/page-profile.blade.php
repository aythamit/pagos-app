@extends('layouts/contentLayoutMaster')

@section('title', 'Tu perfil')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-profile.css')) }}">
@endsection

@section('content')
    <div id="user-profile">
        <!-- profile header -->
        <div class="row">
            <div class="col-12">
                <div class="card profile-header mb-2">
                    <!-- profile cover photo -->
                    <img
                        class="card-img-top"
                        src="{{asset('images/web/background/header-perfil.svg')}}"
                        alt="User Profile Image"
                    />
                    <!--/ profile cover photo -->

                    <div class="position-relative">
                        <!-- profile picture -->
                        <div class="profile-img-container d-flex align-items-center">
                            <div class="profile-img">
                                <img
                                    src="{{isset($user_auth->imagen) ? $user_auth->imagen : Avatar::create($user_auth->nombre)->setShape('square')->setDimension(120, 120)->toBase64()}}"
                                    class="rounded img-fluid"
                                    alt="Card image"
                                    style="height: 100%;
                                    width: 100%;
                                    object-fit: cover;"
                                />
                            </div>
                            <!-- profile title -->
                            <div class="profile-title ms-3">
                                <h2 class="text-white">{{$user_auth->nombre . ' ' . $user_auth->apellidos}}</h2>
                                <p class="text-white">{{strtoupper($user_auth->rol)}}</p>
                            </div>
                        </div>
                    </div>

                    <!-- tabs pill -->
                    <div class="profile-header-nav">
                        <!-- navbar -->
                        <nav
                            class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
                            <button
                                class="btn btn-icon navbar-toggler"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent"
                                aria-expanded="false"
                                aria-label="Toggle navigation"
                            >
                                <i data-feather="align-justify" class="font-medium-5"></i>
                            </button>

                            <!-- collapse  -->
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
                                    <ul class="nav nav-pills mb-0">
                                        <li class="nav-item">
                                            <a class="nav-link fw-bold active" href="#">
                                                <span class="d-none d-md-block">General</span>
                                                <i data-feather="rss" class="d-block d-md-none"></i>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fw-bold" href="#">
                                                <span class="d-none d-md-block">About</span>
                                                <i data-feather="info" class="d-block d-md-none"></i>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fw-bold" href="#">
                                                <span class="d-none d-md-block">Photos</span>
                                                <i data-feather="image" class="d-block d-md-none"></i>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fw-bold" href="#">
                                                <span class="d-none d-md-block">Friends</span>
                                                <i data-feather="users" class="d-block d-md-none"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- edit button -->
                                    <button class="btn btn-primary">
                                        <i data-feather="edit" class="d-block d-md-none"></i>
                                        <span class="fw-bold d-none d-md-block">Edit</span>
                                    </button>
                                </div>
                            </div>
                            <!--/ collapse  -->
                        </nav>
                        <!--/ navbar -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ profile header -->

        <!-- profile info section -->
        <section id="profile-info">
            <div class="row">
                <!-- left profile info section -->
                <div class="col-lg-3 col-12 order-2 order-lg-1">
                    <!-- about -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-75">Descripción</h5>
                            <p class="card-text">
                                {{$user_auth->descripcion}}
                            </p>
                            <div class="mt-2">
                                <h5 class="mb-75">Te uniste:</h5>
                                <p class="card-text mb-0">{{\Carbon\Carbon::parse($user_auth->created_at)->format('d/m/Y H:i')}}</p>
                                <p class="card-text">¡Nunca lo olvidaremos!</p>
                            </div>
                            <div class="mt-2">
                                <h5 class="mb-75">Teléfono:</h5>
                                <p class="card-text">{{$user_auth->telefono}}</p>
                            </div>
                            <div class="mt-2">
                                <h5 class="mb-75">Email:</h5>
                                <p class="card-text">{{$user_auth->email}}</p>
                            </div>
                            {{--            <div class="mt-2">--}}
                            {{--              <h5 class="mb-50">Website:</h5>--}}
                            {{--              <p class="card-text mb-0">www.pixinvent.com</p>--}}
                            {{--            </div>--}}
                        </div>
                    </div>
                    <!--/ about -->

                {{--        <!-- suggestion pages -->--}}
                {{--        <div class="card">--}}
                {{--          <div class="card-body profile-suggestion">--}}
                {{--            <h5 class="mb-2">Suggested Pages</h5>--}}
                {{--            <!-- user suggestions -->--}}
                {{--            <div class="d-flex justify-content-start align-items-center mb-1">--}}
                {{--              <div class="avatar me-1">--}}
                {{--                <img src="{{asset('images/avatars/12-small.png')}}" alt="avatar img" height="40" width="40" />--}}
                {{--              </div>--}}
                {{--              <div class="profile-user-info">--}}
                {{--                <h6 class="mb-0">Peter Reed</h6>--}}
                {{--                <small class="text-muted">Company</small>--}}
                {{--              </div>--}}
                {{--              <div class="profile-star ms-auto"><i data-feather="star" class="font-medium-3"></i></div>--}}
                {{--            </div>--}}
                {{--            <!-- user suggestions -->--}}
                {{--            <div class="d-flex justify-content-start align-items-center mb-1">--}}
                {{--              <div class="avatar me-1">--}}
                {{--                <img src="{{asset('images/avatars/1-small.png')}}" alt="avatar" height="40" width="40" />--}}
                {{--              </div>--}}
                {{--              <div class="profile-user-info">--}}
                {{--                <h6 class="mb-0">Harriett Adkins</h6>--}}
                {{--                <small class="text-muted">Company</small>--}}
                {{--              </div>--}}
                {{--              <div class="profile-star ms-auto"><i data-feather="star" class="font-medium-3"></i></div>--}}
                {{--            </div>--}}
                {{--            <!-- user suggestions -->--}}
                {{--            <div class="d-flex justify-content-start align-items-center mb-1">--}}
                {{--              <div class="avatar me-1">--}}
                {{--                <img src="{{asset('images/avatars/10-small.png')}}" alt="avatar" height="40" width="40" />--}}
                {{--              </div>--}}
                {{--              <div class="profile-user-info">--}}
                {{--                <h6 class="mb-0">Juan Weaver</h6>--}}
                {{--                <small class="text-muted">Company</small>--}}
                {{--              </div>--}}
                {{--              <div class="profile-star ms-auto"><i data-feather="star" class="font-medium-3"></i></div>--}}
                {{--            </div>--}}
                {{--            <!-- user suggestions -->--}}
                {{--            <div class="d-flex justify-content-start align-items-center mb-1">--}}
                {{--              <div class="avatar me-1">--}}
                {{--                <img src="{{asset('images/avatars/3-small.png')}}" alt="avatar img" height="40" width="40" />--}}
                {{--              </div>--}}
                {{--              <div class="profile-user-info">--}}
                {{--                <h6 class="mb-0">Claudia Chandler</h6>--}}
                {{--                <small class="text-muted">Company</small>--}}
                {{--              </div>--}}
                {{--              <div class="profile-star ms-auto"><i data-feather="star" class="font-medium-3"></i></div>--}}
                {{--            </div>--}}
                {{--            <!-- user suggestions -->--}}
                {{--            <div class="d-flex justify-content-start align-items-center mb-1">--}}
                {{--              <div class="avatar me-1">--}}
                {{--                <img src="{{asset('images/avatars/5-small.png')}}" alt="avatar img" height="40" width="40" />--}}
                {{--              </div>--}}
                {{--              <div class="profile-user-info">--}}
                {{--                <h6 class="mb-0">Earl Briggs</h6>--}}
                {{--                <small class="text-muted">Company</small>--}}
                {{--              </div>--}}
                {{--              <div class="profile-star ms-auto">--}}
                {{--                <i data-feather="star" class="profile-favorite font-medium-3"></i>--}}
                {{--              </div>--}}
                {{--            </div>--}}
                {{--            <!-- user suggestions -->--}}
                {{--            <div class="d-flex justify-content-start align-items-center">--}}
                {{--              <div class="avatar me-1">--}}
                {{--                <img src="{{asset('images/avatars/6-small.png')}}" alt="avatar img" height="40" width="40" />--}}
                {{--              </div>--}}
                {{--              <div class="profile-user-info">--}}
                {{--                <h6 class="mb-0">Jonathan Lyons</h6>--}}
                {{--                <small class="text-muted">Beauty Store</small>--}}
                {{--              </div>--}}
                {{--              <div class="profile-star ms-auto"><i data-feather="star" class="font-medium-3"></i></div>--}}
                {{--            </div>--}}
                {{--          </div>--}}
                {{--        </div>--}}
                <!--/ suggestion pages -->

                    <!-- twitter feed card -->
                {{--        <div class="card">--}}
                {{--          <div class="card-body">--}}
                {{--            <h5>Twitter Feeds</h5>--}}
                {{--            <!-- twitter feed -->--}}
                {{--            <div class="profile-twitter-feed mt-1">--}}
                {{--              <div class="d-flex justify-content-start align-items-center mb-1">--}}
                {{--                <div class="avatar me-1">--}}
                {{--                  <img src="{{asset('images/avatars/5-small.png')}}" alt="avatar img" height="40" width="40" />--}}
                {{--                </div>--}}
                {{--                <div class="profile-user-info">--}}
                {{--                  <h6 class="mb-0">Gertrude Stevens</h6>--}}
                {{--                  <a href="#">--}}
                {{--                    <small class="text-muted">@tiana59</small>--}}
                {{--                    <i data-feather="check-circle"></i>--}}
                {{--                  </a>--}}
                {{--                </div>--}}
                {{--                <div class="profile-star ms-auto">--}}
                {{--                  <i data-feather="star" class="font-medium-3"></i>--}}
                {{--                </div>--}}
                {{--              </div>--}}
                {{--              <p class="card-text mb-50">I love cookie chupa chups sweet tart apple pie ⭐️ chocolate bar.</p>--}}
                {{--              <a href="#">--}}
                {{--                <small>#design #fasion</small>--}}
                {{--              </a>--}}
                {{--            </div>--}}
                {{--            <!-- twitter feed -->--}}
                {{--            <div class="profile-twitter-feed mt-2">--}}
                {{--              <div class="d-flex justify-content-start align-items-center mb-1">--}}
                {{--                <div class="avatar me-1">--}}
                {{--                  <img src="{{asset('images/avatars/12-small.png')}}" alt="avatar img" height="40" width="40" />--}}
                {{--                </div>--}}
                {{--                <div class="profile-user-info">--}}
                {{--                  <h6 class="mb-0">Lura Jones</h6>--}}
                {{--                  <a href="#">--}}
                {{--                    <small class="text-muted">@tiana59</small>--}}
                {{--                    <i data-feather="check-circle"></i>--}}
                {{--                  </a>--}}
                {{--                </div>--}}
                {{--                <div class="profile-star ms-auto">--}}
                {{--                  <i data-feather="star" class="font-medium-3 profile-favorite"></i>--}}
                {{--                </div>--}}
                {{--              </div>--}}
                {{--              <p class="card-text mb-50">Halvah I love powder jelly I love cheesecake cotton candy. 😍</p>--}}
                {{--              <a href="#">--}}
                {{--                <small>#vuejs #code #coffeez</small>--}}
                {{--              </a>--}}
                {{--            </div>--}}
                {{--            <!-- twitter feed -->--}}
                {{--            <div class="profile-twitter-feed mt-2">--}}
                {{--              <div class="d-flex justify-content-start align-items-center mb-1">--}}
                {{--                <div class="avatar me-1">--}}
                {{--                  <img src="{{asset('images/avatars/1-small.png')}}" alt="avatar img" height="40" width="40" />--}}
                {{--                </div>--}}
                {{--                <div class="profile-user-info">--}}
                {{--                  <h6 class="mb-0">Norman Gross</h6>--}}
                {{--                  <a href="#">--}}
                {{--                    <small class="text-muted">@tiana59</small>--}}
                {{--                    <i data-feather="check-circle"></i>--}}
                {{--                  </a>--}}
                {{--                </div>--}}
                {{--                <div class="profile-star ms-auto">--}}
                {{--                  <i data-feather="star" class="font-medium-3"></i>--}}
                {{--                </div>--}}
                {{--              </div>--}}
                {{--              <p class="card-text mb-50">Candy jelly beans powder brownie biscuit. Jelly marzipan oat cake cake.</p>--}}
                {{--              <a href="#">--}}
                {{--                <small>#sketch #uiux #figma</small>--}}
                {{--              </a>--}}
                {{--            </div>--}}
                {{--          </div>--}}
                {{--        </div>--}}
                <!--/ twitter feed card -->
                </div>
                <!--/ left profile info section -->

                <!-- center profile info section -->
                <div class="col-lg-6 col-12 order-1 order-lg-2">
                    <!-- post 1 -->
                    <div class="card">
                        <div class="card-body">
                            <h5>Aquí habrán pedidos recientes ??</h5>
                        </div>
                    </div>
                    <!--/ post 1 -->
                </div>
                <!--/ center profile info section -->

                <!-- right profile info section -->
                <div class="col-lg-3 col-12 order-3">
                    <!-- latest profile pictures -->
                    <div class="card">
                        <div class="card-body">
                            <h5>¡Wow!</h5>
                            ¿Qué planearemos?
                        </div>
                    </div>
                    <!--/ latest profile pictures -->

                    <!-- suggestion -->
                    <div class="card">
                        <div class="card-body">
                            <h5>¡Wow!</h5>
                            ¿Qué planearemos?
                        </div>
                    </div>
                    <!--/ suggestion -->

                    <!-- polls card -->
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="mb-1">Polls</h5>--}}
{{--                            <p class="card-text mb-0">Who is the best actor in Marvel Cinematic Universe?</p>--}}

{{--                            <!-- polls -->--}}
{{--                            <div class="profile-polls-info mt-2">--}}
{{--                                <!-- custom radio -->--}}
{{--                                <div class="d-flex justify-content-between">--}}
{{--                                    <div class="form-check">--}}
{{--                                        <input type="radio" id="bestActorPoll1" name="bestActorPoll"--}}
{{--                                               class="form-check-input"/>--}}
{{--                                        <label class="form-check-label" for="bestActorPoll1">RDJ</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="text-end">82%</div>--}}
{{--                                </div>--}}
{{--                                <!--/ custom radio -->--}}

{{--                                <!-- progressbar -->--}}
{{--                                <div class="progress progress-bar-primary my-50">--}}
{{--                                    <div--}}
{{--                                        class="progress-bar"--}}
{{--                                        role="progressbar"--}}
{{--                                        aria-valuenow="58"--}}
{{--                                        aria-valuemin="58"--}}
{{--                                        aria-valuemax="100"--}}
{{--                                    "--}}
{{--                                    >--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!--/ progressbar -->--}}

{{--                            <!-- avatar group with tooltip -->--}}
{{--                            <div class="avatar-group my-1">--}}
{{--                                <div--}}
{{--                                    data-bs-toggle="tooltip"--}}
{{--                                    data-popup="tooltip-custom"--}}
{{--                                    data-bs-placement="bottom"--}}
{{--                                    title="Tonia Seabold"--}}
{{--                                    class="avatar pull-up"--}}
{{--                                >--}}
{{--                                    <img--}}
{{--                                        src="{{asset('images/portrait/small/avatar-s-12.jpg')}}"--}}
{{--                                        alt="Avatar"--}}
{{--                                        height="26"--}}
{{--                                        width="26"--}}
{{--                                    />--}}
{{--                                </div>--}}
{{--                                <div--}}
{{--                                    data-bs-toggle="tooltip"--}}
{{--                                    data-popup="tooltip-custom"--}}
{{--                                    data-bs-placement="bottom"--}}
{{--                                    title="Carissa Dolle"--}}
{{--                                    class="avatar pull-up"--}}
{{--                                >--}}
{{--                                    <img--}}
{{--                                        src="{{asset('images/portrait/small/avatar-s-5.jpg')}}"--}}
{{--                                        alt="Avatar"--}}
{{--                                        height="26"--}}
{{--                                        width="26"--}}
{{--                                    />--}}
{{--                                </div>--}}
{{--                                <div--}}
{{--                                    data-bs-toggle="tooltip"--}}
{{--                                    data-popup="tooltip-custom"--}}
{{--                                    data-bs-placement="bottom"--}}
{{--                                    title="Kelle Herrick"--}}
{{--                                    class="avatar pull-up"--}}
{{--                                >--}}
{{--                                    <img--}}
{{--                                        src="{{asset('images/portrait/small/avatar-s-9.jpg')}}"--}}
{{--                                        alt="Avatar"--}}
{{--                                        height="26"--}}
{{--                                        width="26"--}}
{{--                                    />--}}
{{--                                </div>--}}
{{--                                <div--}}
{{--                                    data-bs-toggle="tooltip"--}}
{{--                                    data-popup="tooltip-custom"--}}
{{--                                    data-bs-placement="bottom"--}}
{{--                                    title="Len Bregantini"--}}
{{--                                    class="avatar pull-up"--}}
{{--                                >--}}
{{--                                    <img--}}
{{--                                        src="{{asset('images/portrait/small/avatar-s-10.jpg')}}"--}}
{{--                                        alt="Avatar"--}}
{{--                                        height="26"--}}
{{--                                        width="26"--}}
{{--                                    />--}}
{{--                                </div>--}}
{{--                                <div--}}
{{--                                    data-bs-toggle="tooltip"--}}
{{--                                    data-popup="tooltip-custom"--}}
{{--                                    data-bs-placement="bottom"--}}
{{--                                    title="John Doe"--}}
{{--                                    class="avatar pull-up"--}}
{{--                                >--}}
{{--                                    <img--}}
{{--                                        src="{{asset('images/portrait/small/avatar-s-11.jpg')}}"--}}
{{--                                        alt="Avatar"--}}
{{--                                        height="26"--}}
{{--                                        width="26"--}}
{{--                                    />--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!--/ avatar group with tooltip -->--}}
{{--                        </div>--}}

{{--                        <div class="profile-polls-info mt-2">--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <!-- custom radio -->--}}
{{--                                <div class="form-check">--}}
{{--                                    <input type="radio" id="bestActorPoll2" name="bestActorPoll"--}}
{{--                                           class="form-check-input"/>--}}
{{--                                    <label class="form-check-label" for="bestActorPoll2">Chris Hemswort</label>--}}
{{--                                </div>--}}
{{--                                <!--/ custom radio -->--}}
{{--                                <div class="text-end">67%</div>--}}
{{--                            </div>--}}
{{--                            <!-- progressbar -->--}}
{{--                            <div class="progress progress-bar-primary my-50">--}}
{{--                                <div--}}
{{--                                    class="progress-bar"--}}
{{--                                    role="progressbar"--}}
{{--                                    aria-valuenow="16"--}}
{{--                                    aria-valuemin="16"--}}
{{--                                    aria-valuemax="100"--}}
{{--                                "--}}
{{--                                >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!--/ progressbar -->--}}

{{--                        <!-- avatar group with tooltips -->--}}
{{--                        <div class="avatar-group mt-1">--}}
{{--                            <div--}}
{{--                                data-bs-toggle="tooltip"--}}
{{--                                data-popup="tooltip-custom"--}}
{{--                                data-bs-placement="bottom"--}}
{{--                                title="Liliana Pecor"--}}
{{--                                class="avatar pull-up"--}}
{{--                            >--}}
{{--                                <img--}}
{{--                                    src="{{asset('images/portrait/small/avatar-s-9.jpg')}}"--}}
{{--                                    alt="Avatar"--}}
{{--                                    height="26"--}}
{{--                                    width="26"--}}
{{--                                />--}}
{{--                            </div>--}}
{{--                            <div--}}
{{--                                data-bs-toggle="tooltip"--}}
{{--                                data-popup="tooltip-custom"--}}
{{--                                data-bs-placement="bottom"--}}
{{--                                title="Kasandra NaleVanko"--}}
{{--                                class="avatar pull-up"--}}
{{--                            >--}}
{{--                                <img--}}
{{--                                    src="{{asset('images/portrait/small/avatar-s-1.jpg')}}"--}}
{{--                                    alt="Avatar"--}}
{{--                                    height="26"--}}
{{--                                    width="26"--}}
{{--                                />--}}
{{--                            </div>--}}
{{--                            <div--}}
{{--                                data-bs-toggle="tooltip"--}}
{{--                                data-popup="tooltip-custom"--}}
{{--                                data-bs-placement="bottom"--}}
{{--                                title="Jonathan Lyons"--}}
{{--                                class="avatar pull-up"--}}
{{--                            >--}}
{{--                                <img--}}
{{--                                    src="{{asset('images/portrait/small/avatar-s-8.jpg')}}"--}}
{{--                                    alt="Avatar"--}}
{{--                                    height="26"--}}
{{--                                    width="26"--}}
{{--                                />--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!--/ avatar group with tooltips-->--}}
{{--                    </div>--}}
                    <!--/ polls -->
                </div>
            </div>
            <!--/ polls card -->
    </div>
    <!--/ right profile info section -->
    </div>

{{--    <!-- reload button -->--}}
    <div class="row">
        <div class="col-12 text-center">
            <button type="button" class="btn btn-sm btn-primary block-element border-0 mb-1">Load More</button>
        </div>
    </div>
    <!--/ reload button -->
    </section>
    <!--/ profile info section -->
    </div>
@endsection

@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/page-profile.js')) }}"></script>
@endsection
