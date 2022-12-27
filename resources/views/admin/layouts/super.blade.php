<div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">{{trans('lang.menu')}}</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="/admin/dashboard" >
                                <i class="ri-apps-2-line"></i> <span>{{trans('lang.dashboard')}}</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebaradmins" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebaradmins">
                                <i class="ri-team-line"></i> <span data-key="t-dashboards">{{trans('lang.admins')}}</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebaradmins">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.editors')}}" >{{trans('lang.editors')}}</a>
                                    </li>
                                   
                                    {{-- <li class="nav-item">
                                        <a href="index.html" class="nav-link"> Company Providers </a>
                                    </li> --}}
                                    
                                </ul>
                            </div>
                        </li> <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-team-line"></i> <span data-key="t-dashboards">Users</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.all_users')}}" >{{trans('lang.all_users')}}</a>
                                    </li>
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.users')}}" >{{trans('lang.ordinary_users')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.providers')}}" class="nav-link"> {{trans('lang.providers')}} </a>
                                    </li>
                                    
                                    {{-- <li class="nav-item">
                                        <a href="index.html" class="nav-link"> Company Providers </a>
                                    </li> --}}
                                    
                                </ul>
                            </div>
                        </li> <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#ads" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="ads">
                                <i class="ri-advertisement-line"></i> <span data-key="ads">{{trans('lang.advertisements')}} </a>
                            </a>
                            <div class="collapse menu-dropdown" id="ads">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.advertisements')}}" >{{trans('lang.advertisements')}} </a>
                                    </li>
                                  
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.categories')}}" >{{trans('lang.categories')}} </a>
                                    </li>
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.currencies')}}" >{{trans('lang.currencies')}} </a>
                                    </li>
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.appart_models')}}" >{{trans('lang.appart_model')}} </a>
                                    </li>
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.building_ages')}}" >{{trans('lang.building_ages')}} </a>
                                    </li>
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.floor_numbers')}}" >{{trans('lang.floor_numbers')}} </a>
                                    </li>
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.heatings')}}" >{{trans('lang.heatings')}} </a>
                                    </li>
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.title_deeds')}}" >{{trans('lang.title_deeds')}} </a>
                                    </li>
                                    
                                    </li>
                                    
                                </ul>
                            </div>
                        </li> <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#address" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="address">
                                <i class="ri-map-pin-line"></i> <span data-key="address">{{trans('lang.locations')}} </span>
                            </a>
                            <div class="collapse menu-dropdown" id="address">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('admin.countries')}}" class="nav-link"> {{trans('lang.countries')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.states')}}" class="nav-link"> {{trans('lang.cities')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.cities')}}" class="nav-link"> {{trans('lang.states')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.regions')}}" class="nav-link"> {{trans('lang.regions')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.neighbors')}}" class="nav-link"> {{trans('lang.neighbors')}} </a>

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#packages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="packages">
                                <i class="ri-red-packet-line"></i> <span data-key="packages">{{trans('lang.packages')}} </span>
                            </a>
                            <div class="collapse menu-dropdown" id="packages">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.ads_numbers')}}" > {{trans('lang.ads_numbers')}} </a>
                                    </li>
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.packages')}}" > {{trans('lang.packages')}} </a>
                                    </li>
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.orders')}}" > {{trans('lang.orders')}} </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#Pages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Pages">
                                <i class="ri-pages-line"></i> <span data-key="Pages">{{trans('lang.pages')}}</span>
                            </a>
                            <div class="collapse menu-dropdown" id="Pages">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.faqs')}}" >{{trans('lang.faqs')}} </a>
                                    </li>
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.pages')}}" >{{trans('lang.pages_content')}} </a>
                                    </li>
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.sliders')}}" >{{trans('lang.home_sliders')}} </a>
                                    </li>
                                 

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('admin.settings')}}" >
                                <i class="ri-settings-2-line"></i> <span>{{trans('lang.settings')}}</span>
                            </a>
                        </li> 
               

                    
                     
                    

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>