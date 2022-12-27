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
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets2/css/bootstrap.css" rel="stylesheet">
    <link href="/assets2/css/email.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="email-container">
                <div class="email-box">
                <div class="greeting"> Hello Ahmed Khamees </div>
                <div class="card email-card">
                    <div class="email-logo">
                        <img src="{{url('/assets2/images/favicon.svg')}}"/>
                    </div>
                    <div class="email-header"></div>
                    <div class="email-body">
                        <h3 class="subject"> Email Verification Code Request</h3>
                        <p class="text"> you have send a password reset resquest , and this is your code</p>
                        <span class="code"> 804571 </span>
                        <a target="_blank" href="" class="action-btn"> click to verify </a>
                        <div class="email-footer">
                            <p> Thank you for using our application! </p>
                            <p> Regards, </p>
                            <p> NoComission </p>
                            <p class="below-text">   
                        If you’re having trouble clicking the "click here" button,
                         copy and paste the URL below into your web browser: 
                         <a target="_blank" href="http://localhost:8000/reset_password">http://localhost:8000/reset_password</a>
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