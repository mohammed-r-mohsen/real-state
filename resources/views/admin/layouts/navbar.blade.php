  <header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="/assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="/assets/images/logo-dark.png" alt="" height="17">
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="/assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="/assets/images/logo-light.png" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

               
            </div>

            <div class="d-flex align-items-center">

              
                
                <div class="dropdown ms-1 topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(session('lang')=='en')
                        <img  src="/assets/images/flags/us.jpg"  height="25" class="rounded">
                        @elseif(session('lang')=='tr')
                        <img  src="/assets/images/flags/tr.jpg"  height="25" class="rounded">
                        @else
                        <img  src="/assets/images/flags/ar.jpg"  height="25" class="rounded">
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">

                        <!-- item-->
                        <a href="/lang/en" class="dropdown-item notify-item language py-2" data-lang="en"
                            title="English">
                            <img src="/assets/images/flags/us.jpg" alt="user-image" class="me-2 rounded" height="18">
                            <span class="align-middle">English</span>
                        </a>

                        <!-- item-->
                        <a href="/lang/tr" class="dropdown-item notify-item language" data-lang="tr"
                            title="Spanish">
                            <img src="/assets/images/flags/tr.jpg" alt="user-image" class="me-2 rounded" height="18">
                            <span class="align-middle">Turkish</span>
                        </a>

                        <!-- item-->
                        <a href="/lang/ar" class="dropdown-item notify-item language" data-lang="ar"
                            title="German">
                            <img src="/assets/images/flags/ar.jpg" alt="user-image" class="me-2 rounded"
                                height="18"> <span class="align-middle">العربية</span>
                        </a>

                        
                    </div>
                </div>




                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                {{-- <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div> --}}

                <admin-notifications></admin-notifications>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="/assets/images/users/user-dummy-img.jpg"
                                alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{admin()->name}}</span>
                                @if(admin()->type=='admin')
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{trans('lang.admin')}}</span>
                                @else
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{trans('lang.editor')}}</span>
                                @endif
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">{{trans('lang.welcome')}} {{admin()->name}}!</h6>
                        <a class="dropdown-item" href="{{route('admin.edit_profile')}}"><i
                                class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">{{trans('lang.profile')}}</span></a>
                        
                        <a class="dropdown-item" href="{{route('admin.settings')}}"><i
                                class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">{{trans('lang.settings')}}</span></a>
                        
                        <a class="dropdown-item" href="{{ route('admin.logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> 
                                <span class="align-middle" data-key="t-logout">
                                 {{trans('lang.logout')}}
                              <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                                      @csrf
                                </form>
                              </span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>