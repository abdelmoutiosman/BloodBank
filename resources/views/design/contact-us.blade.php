<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
          integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- custom CSS -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel=stylesheet href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/hover-min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- custom font -->
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
    <title>اتصل بنا</title>
</head>
<body id="body-bg2">
<!-- top nav section -->
<section id="top-nav">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="lang">
                    <span><a href="#" id="arabic">عربى</a></span>
                    <span><a href="#" id="en">EN</a></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="social-media">
                    <a href="{{$settings->facebook_url}}"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{$settings->whatsapp_url}}"><i class="fab fa-whatsapp"></i></a>
                    <a href="{{$settings->twitter_url}}"><i class="fab fa-twitter"></i></a>
                    <a href="{{$settings->youtube_url}}"><i class="fab fa-youtube"></i></a>
                    <a href="{{$settings->google_url}}"><i class="fab fa-google"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <span class="navbar-text">
                   <a  class="new-account"href="/register">انشاء حــساب جديد</a>
                   <a href="{{url(route('signin'))}}"><button class="btn login-btn shadow">دخول</button></a>
                  </span>
            </div>
        </div>
    </div>
</section>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="nav-logo " href="/"><img class="logo" src="{{asset('imgs/logo.png')}}"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">الرئيسية</a>
                <span class="test"></span>
            </li>
            <li class="nav-item">
                <a class="nav-link border-left" href="#app">عن بنك الدم</a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-left" href="#">المقالات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-left" href="{{url(route('orders'))}}">طلبات التبرع</a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-left" href="{{url(route('about'))}}">من نحن</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link border-left" href="{{url(route('contacts'))}}">اتصل بنا </a>
            </li>
        </ul>
{{--        <span class="navbar-text">--}}
{{--           <a href="#"><button class="btn login-btn shadow">طلب تبرع</button></a>--}}
{{--          </span>--}}
    </div>
</nav>
<!-- breedcrumb-->
      <section id="breedcrumb">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                              <li class="breadcrumb-item active " aria-current="page">تواصل معنا  </li>
                            </ol>
                          </nav>

              </div>
          </div>
          <div class="row some-breathing-room">
     
            <div class="col-md-6">
                <div class="call-us-div shadow">
                    <div class="div-bg"><p>اتصل بنا </p></div>
                    <img class="logo-in-call" src="{{asset('imgs/logo.png')}}">
                    <hr class="line">
                    <ul class="list-call">
                        <li>الجوال : {{$settings->phone}}</li>
                        <li>البريد الاكتروني : {{$settings->email}}</li>
                    </ul>
                    <p class="call-us-head2">تواصل معنا</p>
                    <div class="social-icons">
                        <a href="{{$settings->facebook_url}}"><i class="fab fa-facebook-square hvr-forward"></i></a>
                        <a href="{{$settings->whatsapp_url}}"><i class="fab fa-whatsapp-square hvr-forward"></i></a>
                        <a href="{{$settings->twitter_url}}"><i class="fab fa-twitter-square hvr-forward"></i></a>
                        <a href="{{$settings->youtube_url}}"><i class="fab fa-youtube-square hvr-forward"></i></a>
                        <a href="{{$settings->google_url}}"><i class="fab fa-google-plus-square hvr-forward"></i></a>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="call-us-div shadow">
                    <div class="div-bg"><p>اتصل بنا </p></div>
                    <form method="POST" action="{{url(route('create.contact'))}}" id="mar">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputEmail1" name="phone" aria-describedby="emailHelp" placeholder="الجوال">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputEmail1" name="title" aria-describedby="emailHelp" placeholder="عنوان الرساله">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="body" placeholder="نص الرساله" rows="3"></textarea>
                        </div>
                        <input type="submit" value="ارسال" class="btn btn-send-call hvr-float">
                    </form>
                </div>
            </div>
          </div>
      </div>
</section>
<!--  FOOTER -->
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="footer-logo" src="{{asset('imgs/logo.png')}}">
                <p class="footer-text" id="app">{{$settings->about_app}}</p>
            </div>
            <div class="col-md-4">
                <ul class="footer-list">
                    <a href="/"><li> الرئيسيه</li></a>
                    <a href="#app"><li> عن بنك الدم </li></a>
                    <a href="#"> <li> المقالات </li></a>
                    <a href="{{url(route('orders'))}}"><li> طلبات التبرع </li></a>
                    <a href="{{url(route('about'))}}"> <li> من نحن </li></a>
                    <a href="{{url(route('contacts'))}}">  <li> اتصل بنا </li></a>
                </ul>
            </div>
            <div class="col-md-4 change-position">
                <p class="footer-subtext">مـتــوفر علي </p>
                <img class="footer-android" src="{{asset('imgs/google1.png')}}">
                <img class="footer-ios" src="{{asset('imgs/ios1.png')}}">
            </div>
        </div>
    </div>
</footer>
<section id="last-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="social-media">
                    <a href="{{$settings->facebook_url}}"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{$settings->whatsapp_url}}"><i class="fab fa-whatsapp"></i></a>
                    <a href="{{$settings->twitter_url}}"><i class="fab fa-twitter"></i></a>
                    <a href="{{$settings->youtube_url}}"><i class="fab fa-youtube"></i></a>
                    <a href="{{$settings->google_url}}"><i class="fab fa-google"></i></a>
                </div>
            </div>
            <div class="col-md-8">
                <p class="copys"> جميع الحقوق محفوظ ل <span id="website-name"> بنك الدم </span> &copy;2019 </p>
            </div>
        </div>
        <p class="myname">Made with <i class="fas fa-heart"></i> by Abdelmouti Osman</p>
    </div>
</section>
<!-- loader  -->
<section class="overlay">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</section>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js" integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">var scrolltotop={setting:{startline:100,scrollto:0,scrollduration:1e3,fadeduration:[500,100]},controlHTML:'<img src="https://i1155.photobucket.com/albums/p559/scrolltotop/arrow92.png" />',controlattrs:{offsetx:5,offsety:5},anchorkeyword:"#top",state:{isvisible:!1,shouldvisible:!1},scrollup:function(){this.cssfixedsupport||this.$control.css({opacity:0});var t=isNaN(this.setting.scrollto)?this.setting.scrollto:parseInt(this.setting.scrollto);t="string"==typeof t&&1==jQuery("#"+t).length?jQuery("#"+t).offset().top:0,this.$body.animate({scrollTop:t},this.setting.scrollduration)},keepfixed:function(){var t=jQuery(window),o=t.scrollLeft()+t.width()-this.$control.width()-this.controlattrs.offsetx,s=t.scrollTop()+t.height()-this.$control.height()-this.controlattrs.offsety;this.$control.css({left:o+"px",top:s+"px"})},togglecontrol:function(){var t=jQuery(window).scrollTop();this.cssfixedsupport||this.keepfixed(),this.state.shouldvisible=t>=this.setting.startline?!0:!1,this.state.shouldvisible&&!this.state.isvisible?(this.$control.stop().animate({opacity:1},this.setting.fadeduration[0]),this.state.isvisible=!0):0==this.state.shouldvisible&&this.state.isvisible&&(this.$control.stop().animate({opacity:0},this.setting.fadeduration[1]),this.state.isvisible=!1)},init:function(){jQuery(document).ready(function(t){var o=scrolltotop,s=document.all;o.cssfixedsupport=!s||s&&"CSS1Compat"==document.compatMode&&window.XMLHttpRequest,o.$body=t(window.opera?"CSS1Compat"==document.compatMode?"html":"body":"html,body"),o.$control=t('<div id="topcontrol">'+o.controlHTML+"</div>").css({position:o.cssfixedsupport?"fixed":"absolute",bottom:o.controlattrs.offsety,right:o.controlattrs.offsetx,opacity:0,cursor:"pointer"}).attr({title:"Scroll to Top"}).click(function(){return o.scrollup(),!1}).appendTo("body"),document.all&&!window.XMLHttpRequest&&""!=o.$control.text()&&o.$control.css({width:o.$control.width()}),o.togglecontrol(),t('a[href="'+o.anchorkeyword+'"]').click(function(){return o.scrollup(),!1}),t(window).bind("scroll resize",function(t){o.togglecontrol()})})}};scrolltotop.init();</script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
</body>
</html>