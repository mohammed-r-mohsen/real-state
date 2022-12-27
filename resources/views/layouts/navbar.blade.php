    
    
    <nav class="navbar navbar-icon-top navbar-expand-lg navbar-light fixed-top bg-light main-header">
        <div class="container-fluid">
        <router-link to="/" class="navbar-brand">
        <div class="logo-box">
            <figure class="logo"><img src="/assets2/images/logo.png" alt=""></figure>
        </div>
        </router-link>
        
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto main-links">
             <li @click="collapse">
        <router-link  to="/add_advertisement/4" class="theme-btn link-btn btn-one"><span>+</span> {{trans('lang.create_ad')}} </router-link>
            </li>
            
        <li @click="collapse" class="nav-item first_link ">
            <router-link  to="/"  class="nav-link first" href="#">
           <i class="ri-home-4-line"></i> {{trans('lang.home')}}
            <span class="sr-only">(current)</span>
            </router-link>
        </li>
        
        <li @click="collapse" class="nav-item">
            <router-link  to="/about"  class="nav-link" href="#">
           <i class="ri-shield-user-line"></i> {{trans('lang.about')}}
            </router-link>
        </li>
        <li @click="collapse" class="nav-item">
            <router-link  class="nav-link" to="/services">
            <i class="ri-community-line"></i> {{trans('lang.services')}}
            </router-link>
        </li>
        <li @click="collapse" class="nav-item">
            <router-link  to="/contact"  class="nav-link" href="#">
            <i class="ri-customer-service-2-line"></i> {{trans('lang.contact')}}
            </a>
        </li>
        <li @click="collapse" class="nav-item">
            <router-link  to="/providers"  class="nav-link" href="#">
            <i class="ri-group-line"></i> {{trans('lang.providers')}}
            </router-link>
        </li>
        
        
        
        
        </ul>
        <ul class="navbar-nav icons">
        
        <li class="nav-item">
             <router-link to="/home" class="nav-link"> <i class="ri-user-3-line"></i>  </router-link>
        </li>
        <user-nots></user-nots>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ri-earth-line"></i>
        </a>
        <div class="dropdown-menu dropdown-languages dropdown-menu-right" aria-labelledby="navbarDropdown2" >

        <div class="comments-area v2 languages">
            <div class="comment-box language">
                <a href="/lang/en" class="single-not">
                <div class="comment" >
                    <figure class="thumb-box">
                        <img src="/assets/images/flags/us.jpg" alt="">
                    </figure>
                    <div class="comment-inner">
                        <div class="comment-info clearfix">
                            <h5> English </h5>
                        </div>
                        
                    </div>
                </div>
             </a>
                <a href="/lang/tr" class="single-not">
                <div class="comment" >
                    <figure class="thumb-box">
                        <img src="/assets/images/flags/tr.jpg" alt="">
                    </figure>
                    <div class="comment-inner">
                        <div class="comment-info clearfix">
                            <h5> Turkish </h5>
                        </div> 
                    </div>
                </div>
                </a>
                <a href="/lang/ar" class="single-not">
                <div class="comment" >
                    <figure class="thumb-box">
                        <img src="/assets/images/flags/ar.jpg" alt="">
                    </figure>
                    <div class="comment-inner">
                        <div class="comment-info clearfix">
                            <h5> العربية </h5>
                        </div> 
                    </div>
                </div>
                </a>
                </div>

        </div>
      

        </div>
    </li>
        <li class="nav-item">
            <router-link class="nav-link" to="/favorites">
            <i class="ri-heart-line">
            </i>
            
            </router-link>
        </li>
        </ul>

    </div>
    </div>
    </nav>
