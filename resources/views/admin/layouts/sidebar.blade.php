<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="{{url('/admin/dashboard')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="/assets2/images/logo.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="/assets2/images/logo.png" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="{{url('/admin/dashboard')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="/assets2/images/logo.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="/assets2/images/logo.png" alt="" height="17">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            @if(admin()->type=='admin')
                @include('admin.layouts.super')
                @elseif(admin()->type=='editor')
                @include('admin.layouts.editor')
            @endif
        </div>
        <!-- Left Sidebar End -->

        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>