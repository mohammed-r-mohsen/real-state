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
.email-container{    width: 100% !important;
    max-width: 550px !important;
    margin: 0 auto !important;}

.email-box{margin-top: 70px !important;font-family: 'Tajawal', sans-serif !important !important;}
.greeting{text-align: center !important;
    background: #f4f4f4 !important;
    padding: 20px !important;font-size: 15px !important;
    margin-bottom: 50px !important;}
.email-card{border: none !important;}
.email-header{width: 100% !important;height: 150px !important;
    background: #2a3386 !important;}

.email-logo{text-align: center !important;
    position: relative !important;
    height: 0 !important;}
.email-logo img{width: 75px !important;
    height: 75px !important;
    margin: 0 auto !important;
    border-radius: 50% !important;
    overflow: hidden !important;
    position: relative !important;
    top: -50px !important;
    background: #fff !important;
    padding: 20px !important;}
.email-body{margin: 20px 40px !important;
    position: relative !important;
    top: -90px !important;
    background: #fff !important;
    padding: 20px !important;
    border-radius: 11px !important;
   border: 1px solid #fbfbfb !important;}
.email-body .subject{text-align: center !important;}
.email-body .text{text-align: center !important;text-align: center !important;
    color: #777474 !important;
    font-size: 16px !important;}
.email-body .code{text-align: center !important;
    display: block !important;
    width: 115px !important;
    background: #ececec !important;
    margin: 0 auto !important;
    padding: 4px !important;
    letter-spacing: 4px !important;
    font-size: 16px !important;}
.email-footer{padding-top: 30px !important;}
.email-footer p{margin-bottom: 0 !important;
    color: #7c7c7c !important;
    font-size: 13px !important;}
.email-footer .below-text{padding-top: 4px !important;
    border-top: 1px solid #ddd !important;
    margin-top: 15px !important;}

.footer-div{padding: 0 20px 20px 20px !important;
        margin: -70px 25px !important;}
.footer-div .social{text-align: center !important;}
 .social .links{}
 .social .icons{}
  .social .icons a{padding-top: 14px !important;display: inline-block !important;}
.icons a img{width: 30px !important;
    height: 30px !important;
    border-radius: 50% !important;}
.action-btn,.action-btn:hover{width: 124px !important;
    margin: 8px auto !important;
    display: block !important;
    background: #393535 !important;
    color: #f2f2f2 !important;
    text-align: center !important;
    padding: 3px 5px !important;
    margin-bottom: 0 !important;
    border-radius: 4px !important;
    text-decoration: none !important;}

@media only screen and (max-width: 500px) {
    .email-body{margin: 20px 15px !important;}
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
                        <h3 class="subject"> {{trans('lang.verify_email_request')}} </h3>
                        <p class="text"> {{trans('lang.password_reset_request_mail_body')}} </p>
                        <span class="code"> {{$user->email_verification_code}} </span>
                        <a target="_blank" href="{{url('/')}}/verify_email/{{$user->id}}/{{$user->email_verification_code}}" class="action-btn"> {{trans('lang.click_here')}} </a>
                        <div class="email-footer">
                            <p> {{trans('lang.thanks')}}! </p>
                            <p> {{trans('lang.regards')}}, </p>
                            <p> NoComission </p>
                            <p class="below-text">   
                            {{trans('lang.having_trouble')}}
                         <a target="_blank" href="{{url('/')}}/verify_email/{{$user->id}}/{{$user->email_verification_code}}">{{url('/')}}/verify_email/{{$user->id}}/{{$user->email_verification_code}}</a>
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