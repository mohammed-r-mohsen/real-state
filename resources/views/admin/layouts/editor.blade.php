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
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-team-line"></i> <span data-key="t-dashboards">{{trans('lang.users')}}</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">
                                    
                                    <li class="nav-item">
                                        <a href="{{route('admin.providers')}}" class="nav-link"> {{trans('lang.providers')}} </a>
                                    </li>
                                   
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

                                </ul>
                            </div>
                        </li> <!-- end Dashboard Menu -->
                      
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#packages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="packages">
                                <i class="ri-red-packet-line"></i> <span data-key="packages">{{trans('lang.packages')}} </span>
                            </a>
                            <div class="collapse menu-dropdown" id="packages">
                                <ul class="nav nav-sm flex-column">
                                
                                    <li class="nav-item">
                                         <a class="nav-link" href="{{route('admin.orders')}}" > {{trans('lang.orders')}} </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>