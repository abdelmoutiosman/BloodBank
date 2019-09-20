@inject('bloodtypes', 'App\Models\BloodType')
@inject('cities', 'App\Models\City')
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
    <title>انشاء حساب جديد</title>
</head>
<body>
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
                <div class="contact">
                    <p class="email">{{$settings->email}}</p>
                    <i class="fas fa-envelope-square email "></i>
                    <p class="phone ">{{$settings->phone}}
                    </p>
                    <i class="fas fa-phone-volume phone hvr-buzz"></i>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- oradaniry nav section -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="nav-logo " href="/"><img class="logo" src="{{asset('imgs/logo.png')}}"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link " href="/">الرئيسية</a>
                <span class="test"></span>
            </li>
            <li class="nav-item">
                <a class="nav-link border-left" href="#app">عن بنك الدم</a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-left" href="/">المقالات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-left" href="{{url(route('orders'))}}">طلبات التبرع</a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-left" href="{{url(route('about'))}}">من نحن</a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-left" href="{{url(route('contacts'))}}">اتصل بنا </a>
            </li>
        </ul>
          <span class="navbar-text">
           <a href="{{url(route('order.create'))}}"><button class="btn login-btn shadow">طلب تبرع</button></a>
          </span>
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
                          <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                        </ol>
                      </nav>
              </div>
          </div>
          <div class="row">
        <div class="col-md-12 signup-form">
            <form class="needs-validation" method="POST" action="{{url(route('create.client'))}}" validate>
                {{csrf_field()}}
                <div class="form-row">
                    <input type="text" class="form-control" id="validationCustom01" placeholder="الاسم" name="name" required>
                    <div class="invalid-feedback">
                        Please provide a valid name.
                    </div>
                    <input type="text" class="form-control" id="validationCustom02" placeholder="البريد الاكتروني" name="email" required>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                </div>
                <div class="form-row">
                    <input type="text" id="BD" class="form-control" id="validationCustom03" placeholder="تاريخ الميلاد" name="birth_of_date" required>
                    <span class="calendar-btn" onclick="pureJSCalendar.open('dd/MM/yyyy',-10, -10, 1, '1800-5-5', '2019-8-20', 'BD', 20)"  >
                        <i class="fas fa-calendar-alt first-icon"></i>
                        <div id="my-calendar"></div>
                    </span>
                    <div class="invalid-feedback">
                      Please provide a valid city.
                    </div>
                    {!! Form::select('blood_type_id',$bloodtypes->pluck('name','id'),null,[
                            'class'=>['custom-select','custom-select-lg','mb-3','mt-3','custom-width'],
                            'placeholder'=>'فصيلة الدم',
                            'selected'=>'selected',
                        ]) !!}
                    {!! Form::select('city_id',$cities->pluck('name','id'),null,[
                            'class'=>['custom-select','custom-select-lg','mb-3','mt-3','custom-width'],
                            'placeholder' =>'اختار المدينه',
                            'selected'=>'selected'
                        ]) !!}
                    <input type="text" class="form-control" id="validationCustom05" placeholder="رقم الهاتف" name="phone" required>
                    <div class="invalid-feedback">
                      Please provide a valid phone number .
                    </div>
                    <input type="password" class="form-control" id="validationCustom06" placeholder="كلمه السر" name="password" required>
                    <div class="invalid-feedback">
                        Please provide a valid  password .
                    </div>
                    <input type="text" id="ddd" class="form-control" id="validationCustom03" placeholder=" اخر تاريخ تبرع" name="last_donation_date" required>
                    <span class="calendar-btn" onclick="pureJSCalendar.open('dd/MM/yyyy',-10, -10, 1, '1800-5-5', '2019-8-20', 'ddd', 20)">
                        <i class="fas fa-calendar-alt second-icon"></i>
                        <div id="my-calendar"></div>
                    </span>
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                      Agree to terms and conditions
                    </label>
                    <div class="invalid-feedback">
                      You must agree before submitting.
                    </div>
                  </div>
                </div>
                <input class="btn btn-create shadow" type="submit" value="انــشاء">
              </form>
              <script>
              // Example starter JavaScript for disabling form submissions if there are invalid fields
              (function() {
                'use strict';
                window.addEventListener('load', function() {
                  // Fetch all the forms we want to apply custom Bootstrap validation styles to
                  var forms = document.getElementsByClassName('needs-validation');
                  // Loop over them and prevent submission
                  var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                      if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                      }
                      form.classList.add('was-validated');
                    }, false);
                  });
                }, false);
              })();
              </script>
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
                    <a href="/"> <li> المقالات </li></a>
                    <a href="{{url(route('orders'))}}"><li> طلبات التبرع </li></a>
                    <a href="{{url(route('about'))}}"> <li> من نحن </li></a>
                    <a href="{{url(route('contacts'))}}">  <li> اتصل بنا </li></a>
                </ul>
            </div>
            <div class="col-md-4 change-position">
                <p class="footer-subtext">مـتــوفر علي </p>
                <img class="footer-android" src="imgs/google1.png">
                <img class="footer-ios" src="imgs/ios1.png">
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
<script src="{{asset('js/pureJSCalendar.js')}}"></script>
</body>
</html>
