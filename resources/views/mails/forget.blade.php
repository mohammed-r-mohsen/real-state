<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500&display=swap" rel="stylesheet">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{url('/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('/assets2/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{url('/assets2/css/email.css')}}" rel="stylesheet">
</head>
<style>
.email-container{    width: 100%;
    max-width: 550px;
    margin: 0 auto;}

.email-box{margin-top: 70px;font-family: 'Tajawal', sans-serif !important;}
.greeting{text-align: center;
    background: #f4f4f4;
    padding: 20px;font-size: 15px;
    margin-bottom: 50px;}
.email-card{border: none;}
.email-header{width: 100%;height: 150px;
    background: #2a3386;}

.email-logo{text-align: center;
    position: relative;
    height: 0;}
.email-logo img{width: 75px;
    height: 75px;
    margin: 0 auto;
    border-radius: 50%;
    overflow: hidden;
    position: relative;
    top: -50px;
    background: #fff;
    padding: 20px;}
.email-body{margin: 20px 40px;
    position: relative;
    top: -90px;
    background: #fff;
    padding: 20px;
    border-radius: 11px;
   border: 1px solid #fbfbfb;}
.email-body .subject{text-align: center;}
.email-body .text{text-align: center;text-align: center;
    color: #777474;
    font-size: 16px;}
.email-body .code{text-align: center;
    display: block;
    width: 115px;
    background: #ececec;
    margin: 0 auto;
    padding: 4px;
    letter-spacing: 4px;
    font-size: 16px;}
.email-footer{padding-top: 30px;}
.email-footer p{margin-bottom: 0;
    color: #7c7c7c;
    font-size: 13px;}
.email-footer .below-text{padding-top: 4px;
    border-top: 1px solid #ddd;
    margin-top: 15px;}

.footer-div{padding: 0 20px 20px 20px;
        margin: -70px 25px;}
.footer-div .social{text-align: center;}
 .social .links{}
 .social .icons{}
 .social .icons a{padding-top: 14px;display: inline-block;}
.icons a img{width: 30px;
    height: 30px;
    border-radius: 50%;}
.action-btn,.action-btn:hover{width: 124px;
    margin: 8px auto;
    display: block;
    background: #393535;
    color: #f2f2f2;
    text-align: center;
    padding: 3px 5px;
    margin-bottom: 0;
    border-radius: 4px;
    text-decoration: none;}

@media only screen and (max-width: 500px) {
    .email-body{margin: 20px 15px;}
}
</style>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="email-container">
                <div class="email-box">
                <div class="greeting"> {{trans('lang.hello')}} {{$user->name}} </div>
                <div class="card email-card">
                    <div class="email-logo">
                        <img src="{{url('/assets2/images/favicon.svg')}}"/>
                    </div>
                    <div class="email-header"></div>
                    <div class="email-body">
                        <h3 class="subject"> {{trans('lang.reset_password_request')}} </h3>
                        <p class="text"> {{trans('lang.password_reset_request_mail_body')}} </p>
                        <span class="code"> {{$user->verification_code}} </span>
                        <a target="_blank" href="{{url('/')}}/reset_password" class="action-btn"> {{trans('lang.click_here')}} </a>
                        <div class="email-footer">
                            <p> {{trans('lang.thanks')}}! </p>
                            <p> {{trans('lang.regards')}}, </p>
                            <p> NoComission </p>
                            <p class="below-text">   
                            {{trans('lang.having_trouble')}}
                         <a target="_blank" href="{{url('/')}}/reset_password">{{url('/')}}/reset_password</a>
                            </p>
                        </div>
                    </div>

                    <div class="footer-div">
                    <div class="social">
                        <div class="links"> 
                        <a href="">Help</a> |  <a href="">privacy</a> | <a href="">Terms</a>  
                        </div>
                        <div class="icons">
                            <a href=""> <img src="{{url('/assets2/images/icons/facebook.jpg')}}"> </a>
                            <a href=""> <img src="{{url('/assets2/images/icons/instagram.jpg')}}"> </a>
                            <a href=""> <img src="{{url('/assets2/images/icons/twitter.jpg')}}"> </a>
                            <a href=""> <img src="{{url('/assets2/images/icons/linkedin.jpg')}}"> </a>
                        </div>
                    </div>
                </div>


                </div>

                

            </div>
            </div>
        </div>
    </div>
</body>
</html>