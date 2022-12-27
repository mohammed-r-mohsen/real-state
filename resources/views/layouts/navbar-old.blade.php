
        <!-- main header -->
        <header class="main-header">
          
            <!-- header-lower -->
            <div class="header-lower">
                <div class="outer-box">
                    <div class="main-box">
                        <div class="logo-box">
                            <figure class="logo"><router-link to="/"><img src="/assets2/images/logo.png" alt=""></router-link></figure>
                        </div>
                        <div class="menu-area clearfix">
                            <!--Mobile Navigation Toggler-->
                            <div class="mobile-nav-toggler">
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                            </div>
                            <nav class="main-menu navbar-expand-md navbar-light">
                                <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                         {{-- <li class="ad-add"><router-link to="/add_advertisement/4" class="theme-btn btn-one"><span>+</span>{{trans('lang.create_ad')}} </router-link></li> --}}
                                        <li><router-link to="/"><span>{{trans('lang.home')}}</span></router-link>
                                           
                                        </li>
                                        <li><a href="contact.html"><span>{{trans('lang.about')}}</span></a></li>   
                                        <li class="dropdown"><a href="/"><span>{{trans('lang.services')}}</span></a>
                                            <ul>
                                                <li><a href="/">Service1</a></li>
                                                <li><a href="/">Service2</a></li>
                                                <li><a href="/">Service1 </a></li>
                                            </ul>
                                        </li>

                                        <li><a href="contact.html"><span>{{trans('lang.contact')}}</span></a></li>   
                                        <li><a href="contact.html"><span>{{trans('lang.services_providers')}}</span></a></li>   
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="btn-box">
                            <router-link to="/add_advertisement/4" class="theme-btn link-btn"><span>+</span> {{trans('lang.create_ad')}} </router-link>
                            <div class="icons"> 
                                <li class="item-link"><router-link to="/home"> <i class="ri-user-line"></i> </router-link>  </li>
                                <li class="item-link"><a href="#" > <i class="ri-heart-line"></i> </a>  </li>  
                               <li class="item-link dropdown"> <a href="#"> <i class="ri-notification-line"></i> </a> 
                                <div class="icon-dropdown nots">           
                                <ul class="list-unstyled">
                                    <li><a href="agency-details.html">For Rent <span>(200)</span></a></li>
                                    <li><a href="agency-details.html">For Sale <span>(700)</span></a></li>
                                </ul>
                                </div>
                               </li>
                                <li class="item-link"><a href="#"> <i class=" ri-global-line"></i> </a>   </li> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--sticky Header-->
            <div class="sticky-header">
                <div class="outer-box">
                    <div class="main-box">
                        <div class="logo-box">
                            <figure class="logo"><router-link to="/"><img src="/assets2/images/logo.png" alt=""></router-link></figure>
                        </div>
                        <div class="menu-area clearfix">
                                <nav class="main-menu navbar-expand-md navbar-light">
                                <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                        {{-- <li class="ad-add"><router-link to="/add_advertisement/4" class="theme-btn btn-one"><span>+</span>{{trans('lang.create_ad')}} </router-link></li> --}}

                                        <li><router-link to="/"><span>{{trans('lang.home')}}</span></router-link>
                                           
                                        </li>
                                        <li><a href="contact.html"><span>{{trans('lang.about')}}</span></a></li>   
                                        <li class="dropdown"><a href="/"><span>{{trans('lang.services')}}</span></a>
                                            <ul>
                                                <li><a href="/">Service1</a></li>
                                                <li><a href="/">Service2</a></li>
                                                <li><a href="/">Service1 </a></li>
                                            </ul>
                                        </li>

                                        <li><a href="contact.html"><span>{{trans('lang.contact')}}</span></a></li>   
                                        <li><a href="contact.html"><span>{{trans('lang.services_providers')}}</span></a></li>   
                                    </ul>
                                </div>
                         
                            </nav>
                        </div>
                        <div class="btn-box">
                            <router-link to="/add_advertisement/4" class="theme-btn link-btn"><span>+</span> {{trans('lang.create_ad')}} </router-link>
                            <div class="icons"> 
                                <router-link to="/home" class="item-link"> <i class="ri-user-line"></i> </router-link>    
                                <a href="#" class="item-link"> <i class="ri-heart-line"></i> </a>    
                                <a href="#" class="item-link"> <i class="ri-notification-line"></i> </a>    
                                <a href="#" class="item-link dropdown"> <i class=" ri-global-line"></i> </a>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- main-header end -->

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><i class="fas fa-times"></i></div>
            
            <nav class="menu-box">
                <div class="nav-logo"><a href="/"><img src="/assets2/images/logo.png" alt="" title=""></a></div>
                <div class="menu-outer"><div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                        <li><router-link to="/"><span>{{trans('lang.home')}}</span></router-link>
                                           
                                        </li>
                                        <li><a href="contact.html"><span>{{trans('lang.about')}}</span></a></li>   
                                        <li class="dropdown"><a href="/"><span>{{trans('lang.services')}}</span></a>
                                            <ul>
                                                <li><a href="/">Service1</a></li>
                                                <li><a href="/">Service2</a></li>
                                                <li><a href="/">Service1 </a></li>
                                            </ul>
                                        </li>

                                        <li><a href="contact.html"><span>{{trans('lang.contact')}}</span></a></li>   
                                        <li><a href="contact.html"><span>{{trans('lang.services_providers')}}</span></a></li>   
                                    </ul>
                                </div>
                                <div class="btn-box">
                            <router-link to="/add_advertisement/4" class="theme-btn link-btn"><span>+</span> {{trans('lang.create_ad')}} </router-link>
                            <div class="icons"> 
                                <router-link to="/home" class="item-link"> <i class="ri-user-line"></i> </router-link>    
                                <a href="#" class="item-link"> <i class="ri-heart-line"></i> </a>    
                                <a href="#" class="item-link"> <i class="ri-notification-line"></i> </a>    
                                <a href="#" class="item-link dropdown"> <i class=" ri-global-line"></i> </a>    
                            </div>
                        </div>
                            </div>
                <div class="contact-info">
                    <h4>Contact Info</h4>
                    <ul>
                        <li>Chicago 12, Melborne City, USA</li>
                        <li><a href="tel:+8801682648101">+88 01682648101</a></li>
                        <li><a href="mailto:info@example.com">info@example.com</a></li>
                    </ul>
                </div>
                <div class="social-links">
                    <ul class="clearfix">
                        <li><a href="/"><span class="fab fa-twitter"></span></a></li>
                        <li><a href="/"><span class="fab fa-facebook-square"></span></a></li>
                        <li><a href="/"><span class="fab fa-pinterest-p"></span></a></li>
                        <li><a href="/"><span class="fab fa-instagram"></span></a></li>
                        <li><a href="/"><span class="fab fa-youtube"></span></a></li>
                    </ul>
                </div>
            </nav>
        </div><!-- End Mobile Menu -->