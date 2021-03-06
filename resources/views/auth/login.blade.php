<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('public/assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('public/assets/img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <title>{{ __('Login') }}</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="{{asset('public/assets/fonts/font-awesome/css/font-awesome.min.css')}}"/>
    <!-- CSS Files -->
    <link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('public/assets/css/now-ui-kit.css')}}" rel="stylesheet"/>
    <link href="{{asset('public/assets/css/plugins/owl.carousel.css')}}" rel="stylesheet"/>
    <link href="{{asset('public/assets/css/plugins/owl.theme.default.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('public/assets/css/main.css')}}" rel="stylesheet"/>
</head>

<body>
<div class="wrapper default">
    <div class="container">
        <div class="row">
            <div class="main-content col-12 col-md-7 col-lg-5 mx-auto">
                <div class="account-box">
                    <a href="{{route('urlMain')}}" class="logo">
                        <img src="{{asset('public/assets/img/logo.png')}}" alt="">
                    </a>
                    <div class="account-box-title text-right">ورود به تاپ کالا</div>
                    <div class="account-box-content">
                        <form class="form-account" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-account-title">{{ __('E-Mail Address') }}</div>
                            <div class="form-account-row">
                                <label class="input-label"><i class="now-ui-icons users_single-02"></i></label>
                                <input class="input-field" type="text" value="{{ old('email') }}"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="ایمیل یا شماره موبایل خود را وارد نمایید">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-account-title">{{ __('Password') }}
                                @if (Route::has('password.request'))
                                    <a class="btn-link-border form-account-link" href="{{ route('password.request') }}">
                                        {{ __('رمز عبور خود را فراموش کرده ام') }}
                                    </a>
                                @endif
                            </div>
                            <div class="form-account-row">
                                <label class="input-label"><i
                                            class="now-ui-icons ui-1_lock-circle-open"></i></label>
                                <input class="input-field" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       placeholder="رمز عبور خود را وارد نمایید">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-account-row form-account-submit">
                                <div class="parent-btn">
                                    <button class="dk-btn dk-btn-info" type="submit">
                                        ورود به تاپ کالا
                                        <i class="fa fa-sign-in"></i>
                                    </button>

                                </div>
                            </div>
                            <div class="form-account-agree">
                                <label class="checkbox-form checkbox-primary">
                                    <input type="checkbox" checked="checked"
                                           name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="checkbox-check"></span>
                                </label>
                                <label for="remember">مرا به خاطر داشته باش</label>
                            </div>
                        </form>
                    </div>
                    <div class="account-box-footer">
                        <span>کاربر جدید هستید؟</span>
                        <a href="{{route('register')}}" class="btn-link-border">ثبت‌نام در
                            تاپ کالا</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="mini-footer">
        <nav>
            <div class="container">
                <ul class="menu">
                    <li>
                        <a href="#">درباره تاپ کالا</a>
                    </li>
                    <li>
                        <a href="#">فرصت‌های شغلی</a>
                    </li>
                    <li>
                        <a href="#">تماس با ما</a>
                    </li>
                    <li>
                        <a href="#">همکاری با سازمان‌ها</a>
                    </li>

                </ul>
            </div>
        </nav>
        <div class="copyright-bar">
            <div class="container">
                <p>
                    استفاده از مطالب فروشگاه اینترنتی تاپ کالا فقط برای مقاصد غیرتجاری و با ذکر منبع بلامانع است.
                    کلیه حقوق این سایت متعلق
                    به شرکت نوآوران فن آوازه (فروشگاه آنلاین تاپ کالا) می‌باشد.
                </p>
            </div>
        </div>
    </footer>
</div>
</body>
<!--   Core JS Files   -->
<script src="{{asset('public/assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{asset('public/assets/js/plugins/bootstrap-switch.js')}}"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{asset('public/assets/js/plugins/nouislider.min.js')}}" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="{{asset('public/assets/js/plugins/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<!-- Share Library etc -->
<script src="{{asset('public/assets/js/plugins/jquery.sharrre.js')}}" type="text/javascript"></script>
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src="{{asset('public/assets/js/now-ui-kit.js')}}" type="text/javascript"></script>
<!--  CountDown -->
<script src="{{asset('public/assets/js/plugins/countdown.min.js')}}" type="text/javascript"></script>
<!--  Plugin for Sliders -->
<script src="{{asset('public/assets/js/plugins/owl.carousel.min.js')}}" type="text/javascript"></script>
<!--  Jquery easing -->
<script src="{{asset('public/assets/js/plugins/jquery.easing.1.3.min.js')}}" type="text/javascript"></script>
<!-- Main Js -->
<script src="{{asset('public/assets/js/main.js')}}" type="text/javascript"></script>

</html>

