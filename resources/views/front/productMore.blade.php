@extends('layouts.app')
@section('meta')
    <meta name="description" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">


@endsection

@section('title')
    جزییات محصول
@endsection

@section('CSS')
    <style>
        /*for input number*/

        .cart-product-quantity {
            width: 75%;
        }

        input[type=number] {
            float: left;
            width: 30px;
            font-size: 1.5vw;
            font-weight: bold;
            padding: 0;
            text-align: center;
            border-radius: 50%;
            outline: none;
        }

        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .buttonNumber {
            margin: 0 0 0 1%;
            text-indent: -9999px;
            cursor: pointer;
            width: 29px;
            height: 29px;
            float: left;
            text-align: center;
            background: transparent url({{asset('public/img/buttonss.png')}}) no-repeat;
        }

        .dec {
            background-position: 0 -29px;
        }

        .buttons {
            padding: 20px 0 0 140px;
        }

        /*end of for input number*/


        /*select box color*/

        .styled-select {
            background: url(http://i62.tinypic.com/15xvbd5.png) no-repeat 96% 0;
            height: 29px;
            overflow: hidden;
            width: 240px;
        }

        .styled-select select {
            background: transparent;
            border: none;
            font-size: 14px;
            height: 29px;
            padding: 5px; /* If you add too much padding here, the options won't show in IE */
            width: 100px;
        }

        .styled-select.slate {
            background: url(http://i62.tinypic.com/2e3ybe1.jpg) no-repeat right center;
            height: 34px;
            width: 100px;
        }

        .styled-select.slate select {
            border: 1px solid #ccc;
            font-size: 16px;
            height: 34px;
            width: 100px;
        }

        /* -------------------- Rounded Corners */
        .rounded {
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
        }

        .semi-square {
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }

        /* -------------------- Colors: Background */
        .slate {
            background-color: #ddd;
        }

        .green {
            background-color: #779126;
        }

        .blue {
            background-color: #3b8ec2;
        }

        .yellow {
            background-color: #eec111;
        }

        .black {
            background-color: #000;
        }

        /* -------------------- Colors: Text */
        .slate select {
            color: #000;
        }

        .green select {
            color: #fff;
        }

        .blue select {
            color: #fff;
        }

        .yellow select {
            color: #000;
        }

        .black select {
            color: #fff;
        }


        /* -------------------- Select Box Styles: danielneumann.com Method */
        /* -------------------- Source: http://danielneumann.com/blog/how-to-style-dropdown-with-css-only/ */
        #mainselection select {
            direction: ltr;
            border: 0;
            color: #EEE;
            background: transparent;
            font-size: 20px;
            font-weight: bold;
            padding: 2px 10px;
            width: 100px;
            *width: 85px;
            *background: #58B14C;
            -webkit-appearance: none;
        }

        #mainselection {
            overflow: hidden;
            width: 100px;
            -moz-border-radius: 9px 9px 9px 9px;
            -webkit-border-radius: 9px 9px 9px 9px;
            border-radius: 9px 9px 9px 9px;
            box-shadow: 1px 1px 11px #330033;
            background: #58B14C url("http://i62.tinypic.com/15xvbd5.png") no-repeat scroll 319px center;
        }


        /* -------------------- Select Box Styles: stackoverflow.com Method */
        /* -------------------- Source: http://stackoverflow.com/a/5809186 */
        select#soflow, select#soflow-color {
            direction: ltr !important;
            -webkit-appearance: button;
            -webkit-border-radius: 2px;
            -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
            -webkit-padding-end: 20px;
            -webkit-padding-start: 2px;
            -webkit-user-select: none;
            background-image: url(http://i62.tinypic.com/15xvbd5.png), -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
            background-position: 97% center;
            background-repeat: no-repeat;
            border: 1px solid #AAA;
            color: #555;
            font-size: inherit;
            margin: 5%;
            overflow: hidden;
            padding: 5px 10px;
            text-overflow: ellipsis;
            white-space: nowrap;
            width: 100px;
        }

        select#soflow-color {
            color: #fff;
            background-image: url(http://i62.tinypic.com/15xvbd5.png), -webkit-linear-gradient(#D0215F, #D0215F 40%, #D0215F);
            background-color: #D0215F;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
            padding-left: 15px;
        }

        /*end of select box color*/
        .strikethrough {
            position: relative;
        }

        .strikethrough:before {
            position: absolute;
            content: "";
            left: 0;
            top: 50%;
            right: 0;
            border-top: 2px solid;
            border-color: black;

            -webkit-transform: rotate(-5deg);
            -moz-transform: rotate(-5deg);
            -ms-transform: rotate(-5deg);
            -o-transform: rotate(-5deg);
            transform: rotate(-5deg);
        }

        .lnk:hover {
            transition: all 400ms ease-in;
            background-color: #008d00 !important;
        }
    </style>
@endsection

@section('content')


    <!-- main -->
    <main class="single-product default">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <ul class="breadcrumb">
                            <li>
                                <a href="#"><span>فروشگاه اینترنتی تاپ کالا</span></a>
                            </li>
                            <li>
                                <a href="#"><span>کالای دیجیتال</span></a>
                            </li>
                            <li>
                                <a href="#"><span>موبایل</span></a>
                            </li>
                            <li>
                                <a href="#"><span>گوشی موبایل</span></a>
                            </li>
                            <li>
                                <span>{{$product->name}}</span>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <article class="product">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="product-gallery default">

                                    <img class="zoom-img" id="img-product-zoom"
                                         src="{{$product->image}}"
                                         data-zoom-image="{{$product->image}}"
                                         width="411"/>
                                    {{--<img class="zoom-img" id="img-product-zoom"--}}
                                    {{--src="{{asset('public/assets/img/product/1335154.jpg')}}"--}}
                                    {{--data-zoom-image="{{asset('public/assets/img/product/13351544.jpg')}}"--}}
                                    {{--width="411"/>--}}

                                    <div id="gallery_01f" style="width:500px;float:left;">
                                        <ul class="gallery-items owl-carousel owl-theme" id="gallery-slider">
                                            <li class="item">
                                                <a href="#" class="elevatezoom-gallery active" data-update=""
                                                   data-image="{{asset('public/assets/img/product/2114766.jpg')}}"
                                                   data-zoom-image="{{asset('public/assets/img/product/2114766.jpg')}}">
                                                    <img src="{{asset('public/assets/img/product/2114766.jpg')}}"
                                                         width="100"/></a>
                                            </li>
                                            <li class="item">
                                                <a href="tester" class="elevatezoom-gallery"
                                                   data-image="{{asset('public/assets/img/product/1335154.jpg')}}"
                                                   data-zoom-image="{{asset('public/assets/img/product/1335154.jpg')}}">
                                                    <img src="{{asset('public/assets/img/product/1335154.jpg')}}"
                                                         width="100"/>
                                                </a>
                                            </li>
                                            <li class="item">
                                                <a href="#" class="elevatezoom-gallery"
                                                   data-image="{{asset('public/assets/img/product/3694075.jpg')}}"
                                                   data-zoom-image="{{asset('public/assets/img/product/3694075.jpg')}}"><img
                                                            src="{{asset('public/assets/img/product/3694075.jpg')}}"
                                                            width="100"/></a>
                                            </li>
                                            <li class="item">
                                                <a href="tester" class="elevatezoom-gallery"
                                                   data-image="{{asset('public/assets/img/product/1335154.jpg')}}"
                                                   data-zoom-image="{{asset('public/assets/img/product/1335154.jpg')}}">
                                                    <img src="{{asset('public/assets/img/product/1335154.jpg')}}"
                                                         width="100"/>
                                                </a>
                                            </li>
                                            <li class="item">
                                                <a href="tester" class="elevatezoom-gallery"
                                                   data-image="{{asset('public/assets/img/product/110197298.jpg')}}"
                                                   data-zoom-image="{{asset('public/assets/img/product/110197298.jpg')}}"
                                                   class="slide-content"><img
                                                            src="{{asset('public/assets/img/product/110197298.jpg')}}"
                                                            height="68"/></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <ul class="gallery-options">
                                    <li>
                                        <button class="add-favorites"><i class="fa fa-heart"></i></button>
                                        <span class="tooltip-option">افزودن به علاقمندی</span>
                                    </li>
                                    <li>
                                        <button data-toggle="modal" data-target="#myModal"><i
                                                    class="fa fa-share-alt"></i></button>
                                        <span class="tooltip-option">اشتراک گذاری</span>
                                    </li>
                                </ul>
                                <!-- Modal Core -->
                                <div class="modal-share modal fade" id="myModal" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">&times;
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">اشتراک گذاری</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-share">
                                                    <div class="form-share-title">اشتراک گذاری در شبکه های اجتماعی
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <ul class="btn-group-share">
                                                                <li><a href="#" class="btn-share btn-share-twitter"
                                                                       target="_blank"><i
                                                                                class="fa fa-twitter"></i></a></li>
                                                                <li><a href="#" class="btn-share btn-share-facebook"
                                                                       target="_blank"><i
                                                                                class="fa fa-facebook"></i></a></li>
                                                                <li><a href="#"
                                                                       class="btn-share btn-share-google-plus"
                                                                       target="_blank"><i
                                                                                class="fa fa-google-plus"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="form-share-title">ارسال به ایمیل</div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label class="ui-input ui-input-send-to-email">
                                                                <input class="ui-input-field" type="email"
                                                                       placeholder="آدرس ایمیل را وارد نمایید.">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <button class="btn-primary">ارسال</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <form class="form-share-url default">
                                                    <div class="form-share-url-title">آدرس صفحه</div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label class="ui-url">
                                                                <input class="ui-url-field"
                                                                       value="https://www.digikala.com">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Core -->
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="product-title default">
                                    <h1>
                                        {{$product->name}}
                                        <span>Apple iPhone X 256GB Mobile Phone</span></h1>
                                </div>
                                <div class="product-directory default">
                                    <ul>
                                        <li>
                                            <span>برند</span> :
                                            <span class="product-brand-title">متفرقه</span>
                                        </li>
                                        <li>
                                            <span>دسته‌بندی</span> :
                                            <a href="#" class="btn-link-border">
                                                ساعت هوشمند
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-variants default">
                                    <span>انتخاب رنگ: </span>
                                    <div class="radio">
                                        <input type="radio" name="radio1" id="radio1" value="option1">
                                        <label for="radio1">
                                            خاکستری
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <input type="radio" name="radio1" id="radio2" value="option2" checked="">
                                        <label for="radio2">
                                            نقره ای
                                        </label>
                                    </div>

                                </div>
                                <div class="product-guarantee default">
                                    <i class="fa fa-check-circle"></i>
                                    <p class="product-guarantee-text">گارانتی اصالت و سلامت فیزیکی کالا</p>
                                </div>
                                <div class="product-delivery-seller default">
                                    <p>
                                        <i class="now-ui-icons shopping_shop"></i>
                                        <span>فروشنده:‌</span>
                                        <a href="#" class="btn-link-border">ناسا</a>
                                    </p>
                                </div>
                                <div class="price-product defualt">
                                    <div class="price-value">
                                        <span> {{$product->price_main}} </span>
                                        <span class="price-currency">ریال</span>
                                    </div>
                                    <div class="price-discount" data-title="تخفیف">
                                                <span>
                                                    @if ($product->price_main > 0)
                                                        {{Illuminate\Support\Str::limit(($product->price_main-$product->price_off)/$product->price_main*100,3,'')}}
                                                    @else
                                                        0
                                                    @endif
                                                </span>
                                        <span>%</span>
                                    </div>
                                </div>
                                <div class="product-add default">
                                    <div class="parent-btn">
                                        <a id="addProductToCart" class="dk-btn dk-btn-info" href=""
                                           {{--data-Id="{{$product->id}}"--}}
                                           data-url="{{route('addcart',$product->id)}}">
                                            افزودن به سبد خرید
                                            <i class="now-ui-icons shopping_cart-simple"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 center-breakpoint">
                                <div class="product-guaranteed default">
                                    بیش از ۱۸۰ نفر از خریداران این محصول را پیشنهاد داده‌اند
                                </div>
                                <div class="product-params default">
                                    <ul data-title="ویژگی‌های محصول">
                                        <li>
                                            <span>حافظه داخلی: </span>
                                            <span> 256 گیگابایت </span>
                                        </li>
                                        <li>
                                            <span>شبکه های ارتباطی: </span>
                                            <span> 2G,3G,4G </span>
                                        </li>
                                        <li>
                                            <span>رزولوشن عکس: </span>
                                            <span> 12.0 مگاپیکسل</span>
                                        </li>
                                        <li>
                                            <span>تعداد سیم کارت: </span>
                                            <span> تک </span>
                                        </li>
                                        <li>
                                            <span>ویژگی‌های خاص: </span>
                                            <span> مقاوم در برابر آب
                                                        مناسب عکاسی
                                                        مناسب عکاسی سلفی
                                                        مناسب بازی
                                                        مجهز به حس‌گر تشخیص چهره
                                                    </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="col-12 default no-padding">
                        <div class="product-tabs default">
                            <div class="box-tabs default">
                                <ul class="nav" role="tablist">
                                    <li class="box-tabs-tab">
                                        <a class="active" data-toggle="tab" href="#desc" role="tab"
                                           aria-expanded="true">
                                            <i class="now-ui-icons objects_umbrella-13"></i> نقد و بررسی
                                        </a>
                                    </li>
                                    <li class="box-tabs-tab">
                                        <a data-toggle="tab" href="#params" role="tab" aria-expanded="false">
                                            <i class="now-ui-icons shopping_cart-simple"></i> مشخصات
                                        </a>
                                    </li>
                                    <li class="box-tabs-tab">
                                        <a data-toggle="tab" href="#comments" role="tab" aria-expanded="false">
                                            <i class="now-ui-icons shopping_shop"></i> نظرات کاربران
                                        </a>
                                    </li>
                                    <li class="box-tabs-tab">
                                        <a data-toggle="tab" href="#questions" role="tab" aria-expanded="false">
                                            <i class="now-ui-icons ui-2_settings-90"></i> پرسش و پاسخ
                                        </a>
                                    </li>
                                </ul>
                                <div class="card-body default">
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="desc" role="tabpanel"
                                             aria-expanded="true">
                                            <article>
                                                <h2 class="param-title">
                                                    نقد و بررسی تخصصی
                                                    <span>{{$product->name}}</span>
                                                </h2>
                                                <div class="parent-expert default">
                                                    <div class="content-expert">
                                                        <p>
                                                            اپل پس از شایعات فراوان از جدیدترین آیپد خود رونمایی کرد
                                                            تا
                                                            به پرسش‌های فراوان علاقه‌مندان به محصولاتش
                                                            پاسخ دهد. این آیپد با شباهت‌های فراوان به نسخه قبلی
                                                            تولید
                                                            شده، اما از نظر برخی مشخصات فنی در رده
                                                            پایین‌تری قرار گرفته تا کاهش قیمتش توجیه منطقی داشته
                                                            باشد.
                                                            اندازه و دقت نمایشگر آیپد جدید کاملا مشابه با
                                                            نمایشگر نسخه قبلی این محصول است. اما در همین ابتدای کار
                                                            لازم
                                                            می‌دانیم که بگوییم این دو تبلت هیچ ارتباطی
                                                            با یکدیگر ندارند و از دو خانواده‌ی متفاوت و با قیمت‌های
                                                            مختلف هستند. صفحه‌نمایش آیپد جدید 9.7 اینچی
                                                            دارای وضوح تصویر 1536 × 2048 پیکسل است و تراکم پیکسلی
                                                            266
                                                            پیکسل را ارائه می‌دهد. این تبلت به تراشه به
                                                            روزتر A9 و پردازنده‌ی کمکی M9 مجهز است. اما میزان
                                                            حافظه‌ی رم
                                                            آن از آیپد پروی 12.9 کمتر است. پردازنده‌ی
                                                            دو هسته‌ای این تبلت سرعتی برابر با 1.84گیگاهرتز دارد و
                                                            دو
                                                            گیگابایت حافظه‌ی رم این پردازنده را همراهی
                                                            می‌کند. در زمینه‌ی دوربین، آیپد جدید 9.7 اینچی نه‌تنها
                                                            پیشرفتی نداشته بلکه به سنسورهای ضعیف‌تری هم مجهز
                                                            است. اپل، یک حسگر 8 مگاپیکسلی برای دوربین اصلی تبلت 9.7
                                                            اینچی به کار برده که می‌تواند با حداکثر کیفیت
                                                            FullHD فیلم‌برداری کند. شاید بد نباشد بدانید که هیچ‌گونه
                                                            فلشی این سنسور را همراهی نمی‌کند و عکاسی در
                                                            محیط‌های بسته توسط این سنسور چندان رضایت‌بخش نخواهد بود.
                                                            دوربین دوم این تبلت را یک حسگر 1.2 مگاپیکسلی
                                                            تشکیل می‌دهد که از ویژگی قابلیت تشخیص چهره (Face
                                                            Detection)
                                                            بهره می‌برد. پرو 9.7 علاوه بر حافظه‌ی داخلی
                                                            128 گیگابایتی، در نسخه‌ی 32 گیگابایتی هم عرضه شده است.
                                                            همچنین این تبلت در دو نسخه‌ی LTE و WiFi تولید شده
                                                            که مجموعا چهار انتخاب پیش روی کاربران قرار خواهد داشت.
                                                            اما
                                                            مهم‌ترین تغییر ظاهری آیپد 9.7 اینچی مربوط به
                                                            حذف رنگ صورتی از رنگ‌های آن است. بنابراین، آیپد جدید 9.7
                                                            اینچی در سه رنگ نقره‌ای، خاکستری و طلایی عرضه
                                                            خواهد شد. درنهایت باید بگوییم که اپل تغییرات انقلابی و
                                                            رادیکال محوری در جدیدترین تبلت خود ایجاد نکرده
                                                            است. اما بااین‌وجود باید گفت که آیپد 9.7 اینچی
                                                            ارزان‌ترین
                                                            تبلت 10 اینچی تولیدشده‌ی تاریخ اپل تاکنون است.
                                                            آیپد 9.7 بهترین تبلت برای افرادی است که می‌خواهند درازای
                                                            پرداخت هزینه‌ی کمتر صاحب یک آیپد از شرکت مطرح
                                                            اپل شوند.
                                                        </p>
                                                    </div>
                                                    <div class="sum-more">
                                                                <span class="show-more btn-link-border">
                                                                    نمایش بیشتر
                                                                </span>
                                                        <span class="show-less btn-link-border">
                                                                    بستن
                                                                </span>
                                                    </div>
                                                    <div class="shadow-box"></div>
                                                </div>

                                                <div class="accordion default" id="accordionExample">
                                                    <div class="card">
                                                        <div class="card-header" id="headingOne">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link" type="button"
                                                                        data-toggle="collapse"
                                                                        data-target="#collapseOne" aria-expanded="true"
                                                                        aria-controls="collapseOne">
                                                                    Face ID (کسی به‌غیراز تو را نمی‌شناسم)
                                                                </button>
                                                            </h5>
                                                        </div>

                                                        <div id="collapseOne" class="collapse show"
                                                             aria-labelledby="headingOne"
                                                             data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <img src="assets/img/single-product/1406986.jpg"
                                                                     alt="">
                                                                <p>
                                                                    در فناوری تشخیص چهره‌ی اپل، یک دوربین و
                                                                    فرستنده‌ی مادون‌قرمز در بالای نمایشگر قرار داده
                                                                    ‌شده‌ است؛ هنگامی‌که آیفون
                                                                    می‌خواهد چهره‌ی شما را تشخیص دهد، فرستنده‌ی نوری
                                                                    نامرئی را به ‌صورت شما می‌تاباند. دوربین
                                                                    مادون‌قرمز، این نور را تشخیص
                                                                    داده و با الگویی که قبلا از صورت شما ثبت کرده،
                                                                    مطابقت می‌دهد و در صورت یکی‌بودن، قفل گوشی را
                                                                    باز می‌کند. اپل ادعا کرده،
                                                                    الگوی صورت را با استفاده از سی هزار نقطه ذخیره
                                                                    می‌کند که دورزدن آن اصلا کار ساده‌ای نیست.
                                                                    استفاده از ماسک، عکس یا موارد
                                                                    مشابه نمی‌تواند امنیت اطلاعات شما را به خطر
                                                                    اندازد؛ اما اگر برادر یا خواهر دوقلو دارید، باید
                                                                    برای امنیت اطلاعاتتان نگران
                                                                    باشید.
                                                                </p>
                                                                <img src="assets/img/single-product/1431842.jpg"
                                                                     alt="">
                                                                <p>
                                                                    فقط یک نکته‌ی مثبت در مورد Face ID وجود ندارد؛
                                                                    بلکه موارد زیادی هستند که دانستن آن‌ها ضروری به
                                                                    نظر می‌رسد. آیفون 10 فقط
                                                                    چهره‌ی یک نفر را می‌شناسد و نمی‌توانید مثل
                                                                    اثرانگشت، چند چهره را به آیفون معرفی کنید تا از
                                                                    آن‌ها برای بازکردنش استفاده
                                                                    کنید. اگر آیفون در تلاش اول، صورت شما را نشناسد،
                                                                    باید نمایشگر را برای شناختن مجدد خاموش و روشن
                                                                    کنید یا اینکه آن را پایین
                                                                    ببرید و دوباره روبه‌روی صورتتان قرار دهید. این
                                                                    تمام ماجرا نیست؛ اگر آیفون 10 بین افراد زیادی که
                                                                    چهره‌شان را نمی‌شناسد
                                                                    دست‌به‌دست شود، دیگر به شناخت چهره عکس‌العمل
                                                                    نشان نمی‌دهد و حتما باید از پین یا پسوورد برای
                                                                    بازکردن آن استفاده کنید تا
                                                                    دوباره صورتتان را بشناسد.
                                                                </p>
                                                                <img src="{{asset('assets/img/single-product/1439653.jpg')}}"
                                                                     alt="">
                                                                <p>
                                                                    اپل سعی کرده نهایت استفاده را از این فناوری جدید
                                                                    بکند؛ استفاده از آن برای ثبت تصاویر پرتره با
                                                                    دوربین سلفی، استفاده برای
                                                                    ساختن شکلک‌های بامزه که آن‌ها را Animoji نامیده
                                                                    است و همچنین استفاده برای روشن نگه‌داشتن گوشی
                                                                    زمانی که کاربر به آن نگاه
                                                                    می‌کند، مواردی هستند که iPhone X به کمک حسگر
                                                                    اینفرارد، بدون نقص آن‌ها را انجام می‌دهد.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" id="headingTwo">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link collapsed" type="button"
                                                                        data-toggle="collapse"
                                                                        data-target="#collapseTwo" aria-expanded="false"
                                                                        aria-controls="collapseTwo">
                                                                    نمایش‌گر (رنگی‌تر از همیشه)
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseTwo" class="collapse"
                                                             aria-labelledby="headingTwo"
                                                             data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <img src="{{asset('assets/img/single-product/1429172.jpg')}}"
                                                                     alt="">
                                                                <p>
                                                                    اولین تجربه‌ی استفاده از پنل‌های اولد سامسونگ
                                                                    روی گوشی‌های اپل، نتیجه‌ای جذاب برای همه به
                                                                    همراه آورده است. مهندسی
                                                                    افزوده‌ی اپل روی این پنل‌ها باعث شده تا غلظت
                                                                    رنگ‌ها کاملا متعادل باشد، نه مثل آیفون 8 کم باشد
                                                                    و نه مثل گلکسی S8 اشباع
                                                                    باشد تا از حد تعادل خارج شود. اپل این نمایشگر را
                                                                    Super Retina نامیده تا ثابت کند، بهترین نمایشگر
                                                                    موجود در دنیا را طراحی
                                                                    کرده و از آن روی iPhone X استفاده کرده است.
                                                                </p>
                                                                <img src="{{asset('assets/img/single-product/1436228.jpg')}}"
                                                                     alt="">
                                                                <p>
                                                                    این نمایشگر در مقایسه با پنل‌های معمولی، مصرف
                                                                    انرژی کمتری دارد و این به خاطر استفاده از
                                                                    پنل‌های اولد است؛ اما این مشخصه
                                                                    باعث نشده تا نور نمایشگر مثل محصولات دیگری که
                                                                    پنل اولد دارند کم باشد؛ بلکه این پنل در هر
                                                                    شرایطی بهترین بازده‌ی ممکن را
                                                                    دارد. استفاده زیر نور شدید خورشید یا تاریکی مطلق
                                                                    فرقی ندارد، آیفون 10 خود را با شرایط تطبیق
                                                                    می‌دهد. این تمام ماجرا نیست.
                                                                    در نمایشگر آیفون 10 نقطه‌ی حساس به تراز سفیدی
                                                                    نور محیط قرار داده ‌شده‌اند تا آیفون 10 را با
                                                                    شرایط نوری محیطی که از آن
                                                                    استفاده می‌کنید، هماهنگ کند و تراز سفیدی نمایشگر
                                                                    را به‌صورت خودکار تغییر دهد. این فناوری که با
                                                                    نام True-Tone نام‌گذاری
                                                                    شده، کمک می‌کند رنگ‌های نمایشگر در هر نوری
                                                                    نزدیک‌ترین غلظت و تراز سفیدی ممکن را به رنگ‌های
                                                                    طبیعی داشته باشد.
                                                                </p>
                                                                <img src="{{asset('assets/img/single-product/1406339.jpg')}}"
                                                                     alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" id="headingThree">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link collapsed" type="button"
                                                                        data-toggle="collapse"
                                                                        data-target="#collapseThree"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapseThree">
                                                                    طراحی و ساخت (قربانی کردن سنت برای امروزی شدن)
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseThree" class="collapse"
                                                             aria-labelledby="headingThree"
                                                             data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <img src="{{asset('assets/img/single-product/1398679.jpg')}}"
                                                                     alt="">
                                                                <p>
                                                                    اپل پا جای پای سامسونگ گذاشته و برای داشتن ظاهری
                                                                    امروزی و استفاده از جدیدترین فناوری‌های روز، سنت
                                                                    ده‌ساله‌ی طراحی
                                                                    گوشی‌هایش را شکسته است. دیگر کلید خانه‌ای وجود
                                                                    ندارد و تمام قاب جلویی را نمایشگر پر کرده است.
                                                                    حتی نمایشگر هم برای
                                                                    استفاده از فناوری تشخیص چهره قربانی شده و قسمت
                                                                    بالایی آن بریده ‌شده است و لبه‌ی بالایی آن در
                                                                    مقایسه با هر گوشی دیگری که
                                                                    تا به امروز دیده بودیم، حالت متفاوتی دارد. ابعاد
                                                                    iPhone X کمی بزرگ‌تر از ابعاد آیفون 6 است؛ اما
                                                                    نمایشگرش حدود یک اینچ
                                                                    بزرگ‌تر از آیفون 6 است. این نشان می‌دهد، فاصله‌ی
                                                                    لبه‌ها تا نمایشگر تا جای ممکن از طراحی جدیدترین
                                                                    آیفون اپل حذف‌ شده‌
                                                                    است.
                                                                </p>
                                                                <img src="{{asset('assets/img/single-product/1441226.jpg')}}"
                                                                     alt="">
                                                                <p>
                                                                    زبان طراحی جدید، آیفون 10 را به‌طور عجیبی به سمت
                                                                    تبدیل‌شدنش به یک کالای لوکس پیش برده است. نگاه
                                                                    کلی به طراحی این گوشی
                                                                    نشان می‌دهد، اپل سنت‌شکنی کرده و کالایی تولید
                                                                    کرده تا از هر نظر با نسخه‌های قبلی آیفون متفاوت
                                                                    باشد. استفاده از شیشه برای
                                                                    قاب پشتی، فلزی براق برای قاب اصلی، حذف کلید خانه
                                                                    و در انتها استفاده از نمایشگری بزرگ مواردی هستند
                                                                    که نشان‌دهنده‌ی تفاوت
                                                                    iPhone X با نسخه‌های قبلی آیفون است. تمام سطوح
                                                                    آیفون براق و صیقلی طراحی ‌شده‌اند و تنها برآمدگی
                                                                    آیفون جدید مربوط به
                                                                    مجموعه‌ی دوربین آن می‌شود که حدود یک میلی‌متری
                                                                    از قاب پشتی بیرون زده است. برخلاف آیفون 8پلاس،
                                                                    دوربین‌های روی قاب پشتی به
                                                                    حالت عمودی روی قاب پشتی قرار گرفته‌اند.
                                                                </p>
                                                                <img src="{{asset('assets/img/single-product/1418947.jpg')}}"
                                                                     alt="">
                                                                <p>
                                                                    آیفون جدید در دو رنگ خاکستری و نقره‌ای راهی
                                                                    بازار شده که در هر دو مدل قاب جلویی به رنگ مشکی
                                                                    است و این بابت استفاده از
                                                                    سنسورهای متعدد در بخش بالایی نمایشگر است. برخلاف
                                                                    تمام آیفون‌های فلزی که تا امروز ساخته‌ شده‌اند،
                                                                    قاب اصلی از فلزی براق
                                                                    ساخته ‌شده تا زیر نور خودنمایی کند.

                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </article>
                                        </div>
                                        <div class="tab-pane fade params" id="params" role="tabpanel"
                                             aria-expanded="false">
                                            <article>
                                                <h2 class="param-title">
                                                    مشخصات فنی
                                                    <span>Apple iPhone X 256GB Mobile Phone</span>
                                                </h2>
                                                <section>
                                                    <h3 class="params-title">مشخصات کلی</h3>
                                                    <ul class="params-list">
                                                        <li>
                                                            <div class="params-list-key">
                                                                <span class="block">ابعاد</span>
                                                            </div>
                                                            <div class="params-list-value">
                                                                        <span class="block">
                                                                            7.7 × 70.9 × 143.6 میلی‌متر
                                                                        </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="params-list-key">
                                                                <span class="block">توضیحات سیم کارت</span>
                                                            </div>
                                                            <div class="params-list-value">
                                                                        <span class="block">
                                                                            سایز نانو (8.8 × 12.3 میلی‌متر)
                                                                        </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="params-list-key">
                                                                <span class="block">وزن</span>
                                                            </div>
                                                            <div class="params-list-value">
                                                                        <span class="block">
                                                                            174 گرم
                                                                        </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="params-list-key">
                                                                <span class="block">ویژگی‌های خاص</span>
                                                            </div>
                                                            <div class="params-list-value">
                                                                        <span class="block">
                                                                            مقاوم در برابر آب , مناسب عکاسی , مناسب عکاسی
                                                                            سلفی , مناسب بازی , مجهز به حس‌گر تشخیص چهره
                                                                        </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="params-list-key">
                                                                <span class="block">تعداد سیم کارت</span>
                                                            </div>
                                                            <div class="params-list-value">
                                                                        <span class="block">
                                                                            تک سیم کارت
                                                                        </span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </section>
                                                <section>
                                                    <h3 class="params-title">پردازنده</h3>
                                                    <ul class="params-list">
                                                        <li>
                                                            <div class="params-list-key">
                                                                <span class="block">تراشه</span>
                                                            </div>
                                                            <div class="params-list-value">
                                                                        <span class="block">
                                                                            Apple A11 Bionic Chipset
                                                                        </span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="params-list-key">
                                                                <span class="block">نوع پردازنده</span>
                                                            </div>
                                                            <div class="params-list-value">
                                                                        <span class="block">
                                                                            64 بیت
                                                                        </span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </section>
                                            </article>
                                        </div>
                                        <div class="tab-pane fade" id="comments" role="tabpanel" aria-expanded="false">
                                            <article>
                                                <h2 class="param-title">
                                                    نظرات کاربران
                                                    <span>۱۲۳ نظر</span>
                                                </h2>
                                                <div class="comments-area default">
                                                    <ol class="comment-list">
                                                        <!-- #comment-## -->
                                                        <li>
                                                            <div class="comment-body">
                                                                <div class="comment-author">
                                                                    <img alt=""
                                                                         src="{{asset('assets/img/default-avatar.png')}}"
                                                                         class="avatar"><cite class="fn">حسن</cite>
                                                                    <span class="says">گفت:</span></div>

                                                                <div class="commentmetadata"><a href="#">
                                                                        اسفند ۲۰, ۱۳۹۶ در ۹:۴۱ ب.ظ</a></div>

                                                                <p>لورم ایپسوم متن ساختگی</p>

                                                                <div class="reply"><a class="comment-reply-link"
                                                                                      href="#">پاسخ</a></div>
                                                            </div>
                                                        </li>
                                                        <!-- #comment-## -->
                                                        <li>
                                                            <div class="comment-body">
                                                                <div class="comment-author">
                                                                    <img alt=""
                                                                         src="{{asset('assets/img/default-avatar.png')}}"
                                                                         class="avatar"><cite class="fn">رضا</cite>
                                                                    <span class="says">گفت:</span></div>

                                                                <div class="commentmetadata"><a href="#">
                                                                        اسفند ۲۰, ۱۳۹۶ در ۹:۴۲ ب.ظ</a></div>

                                                                <p>
                                                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                                    صنعت چاپ و با استفاده از طراحان گرافیک است.
                                                                </p>

                                                                <div class="reply"><a class="comment-reply-link"
                                                                                      href="#">پاسخ</a></div>
                                                            </div>
                                                            <ol class="children">
                                                                <li>
                                                                    <div class="comment-body">
                                                                        <div class="comment-author">
                                                                            <img alt=""
                                                                                 src=""
                                                                                 class="avatar"><cite
                                                                                    class="fn">بهرامی راد</cite> <span
                                                                                    class="says">گفت:</span></div>

                                                                        <div class="commentmetadata"><a href="#">
                                                                                اسفند ۲۰, ۱۳۹۶ در ۹:۴۷ ب.ظ</a>
                                                                        </div>

                                                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی
                                                                            نامفهوم از صنعت چاپ و با استفاده از
                                                                            طراحان گرافیک است.
                                                                            چاپگرها و متون بلکه روزنامه و مجله در
                                                                            ستون و سطرآنچنان که لازم است و برای
                                                                            شرایط فعلی تکنولوژی
                                                                            مورد نیاز و کاربردهای متنوع با هدف بهبود
                                                                            ابزارهای کاربردی می باشد.</p>

                                                                        <div class="reply"><a
                                                                                    class="comment-reply-link"
                                                                                    href="#">پاسخ</a></div>
                                                                    </div>
                                                                    <ol class="children">
                                                                        <li>
                                                                            <div class="comment-body">
                                                                                <div class="comment-author">
                                                                                    <img alt=""
                                                                                         src="assets/img/default-avatar.png"
                                                                                         class="avatar"> <cite
                                                                                            class="fn">محمد</cite>
                                                                                    <span class="says">گفت:</span>
                                                                                </div>

                                                                                <div class="commentmetadata">
                                                                                    <a href="#">
                                                                                        خرداد ۳۰, ۱۳۹۷ در ۸:۵۳
                                                                                        ق.ظ</a></div>

                                                                                <p>عالیه</p>

                                                                                <div class="reply"><a
                                                                                            class="comment-reply-link"
                                                                                            href="#">پاسخ</a></div>
                                                                            </div>
                                                                            <ol class="children">
                                                                                <li>
                                                                                    <div class="comment-body">
                                                                                        <div class="comment-author">
                                                                                            <img alt=""
                                                                                                 src="assets/img/default-avatar.png"
                                                                                                 class="avatar">
                                                                                            <cite
                                                                                                    class="fn">اشکان</cite>
                                                                                            <span
                                                                                                    class="says">گفت:</span>
                                                                                        </div>

                                                                                        <div
                                                                                                class="commentmetadata">
                                                                                            <a href="#">
                                                                                                خرداد ۳۰, ۱۳۹۷ در
                                                                                                ۸:۵۳ ق.ظ</a></div>

                                                                                        <p>لورم ایپسوم متن ساختگی با
                                                                                            تولید سادگی نامفهوم از
                                                                                            صنعت چاپ و با استفاده از
                                                                                            طراحان
                                                                                            گرافیک است. چاپگرها و
                                                                                            متون بلکه روزنامه و مجله
                                                                                            در ستون و سطرآنچنان که
                                                                                            لازم است و
                                                                                            برای شرایط فعلی تکنولوژی
                                                                                            مورد نیاز و کاربردهای
                                                                                            متنوع با هدف بهبود
                                                                                            ابزارهای
                                                                                            کاربردی می باشد.</p>

                                                                                        <div class="reply"><a
                                                                                                    class="comment-reply-link"
                                                                                                    href="#">پاسخ</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <!-- #comment-## -->
                                                                            </ol>
                                                                            <!-- .children -->
                                                                        </li>
                                                                        <!-- #comment-## -->
                                                                    </ol>
                                                                    <!-- .children -->
                                                                </li>
                                                                <!-- #comment-## -->
                                                            </ol>
                                                            <!-- .children -->
                                                        </li>
                                                        <!-- #comment-## -->
                                                        <li>
                                                            <div class="comment-body">
                                                                <div class="comment-author">
                                                                    <img alt="" src="assets/img/default-avatar.png"
                                                                         class="avatar"> <cite class="fn">جلال</cite>
                                                                    <span class="says">گفت:</span></div>

                                                                <div class="commentmetadata"><a href="#">
                                                                        اسفند ۲۱, ۱۳۹۶ در ۱:۱۰ ب.ظ</a></div>

                                                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                                    صنعت چاپ و با استفاده از طراحان گرافیک است.
                                                                    چاپگرها و
                                                                    متون بلکه روزنامه و مجله در ستون و سطرآنچنان که
                                                                    لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و
                                                                    کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می
                                                                    باشد.</p>

                                                                <div class="reply"><a class="comment-reply-link"
                                                                                      href="">پاسخ</a></div>
                                                            </div>
                                                        </li>
                                                        <!-- #comment-## -->
                                                    </ol>
                                                </div>
                                            </article>
                                        </div>
                                        <div class="tab-pane fade form-comment" id="questions" role="tabpanel"
                                             aria-expanded="false">
                                            <article>
                                                <h2 class="param-title">
                                                    افزودن نظر
                                                    <span>نظر خود را در مورد محصول مطرح نمایید</span>
                                                </h2>
                                                <form action="" class="comment">
                                                            <textarea class="form-control" placeholder="نظر"
                                                                      rows="5"></textarea>
                                                    <button class="btn btn-default">ارسال نظر</button>
                                                </form>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- main -->


@endsection



@section('js')
    <script type="text/javascript">
        $(document).ready(function () {

            $('#addProductToCart').on('click', function (e) {
                e.preventDefault();
                var url = $(this).attr('data-url');
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (data) {

                        $("#numberOfCarts").fadeIn(200, function () {
                            $(this).text(data.length);
                        });

                        let priceOfCarts = 0;
                        let rowCart = '';
                        console.table((data));
                        for (let i = 0; i < data.length; i++) {
                            priceOfCarts += (parseFloat(data[i]['product_price']) * parseFloat(data[i]['product_number']));

                            rowCart += "<li><a href='./" + data[i]['product_slug'] + "' class=\"basket-item\">" +
                                "<button class=\"basket-item-remove\"></button>" +
                                "<div class=\"basket-item-content\">" +
                                    "<div class=\"basket-item-image\"><img alt='"+data[i]['product_name']+"' src='"+data[i]['product_image']+"'> " +
                                    "</div>" +
                                    "<div class=\"basket-item-details\">" +
                                        "<div class=\"basket-item-title\">"+data[i]['product_name']+
                                        "</div>"+
                                        "<div class=\"basket-item-params\">" +
                                            "<div class=\"basket-item-props\">" +
                                                "<span>"+data[i]['product_number']+"</span><span>رنگ مشکی</span>" +
                                            "</div>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>" +
                                "</a></li>";
                        }

                        $("ul.basket-list").html('');
                        $("ul.basket-list").append(rowCart)
                        $("#priceOfCarts").fadeIn(200, function () {
                            $(this).text(priceOfCarts);
                        });
                        // console.table(data.cartSend);
                        Swal.fire({
                            type: 'success',
                            title: 'موفقیت آمیز',
                            text: 'محصول با موفقیت، به سبد خرید اضافه گردید!',
                        });
                        // =====================================================
                        /*
                        $('.product-summary').remove();
                        $('.SeparatorCart').remove();
                        var i;
                        var rowCart = '';
                        // console.log(JSON.stringify(data.productsCart[0], null, 4));
                        if (data.userHasMiliRevenu === true) {
                            for (i = 0; i < data.productsCart.length; i++) {
                                rowCart += '<div class="cart-item product-summary"><div class="row">' +
                                    '<div class="col-xs-4"><div class="image"><a href="detail.html">' +
                                    '<img src="' + data.photos[i] + '" alt=""></a></div></div><div class="col-xs-7"><h3 class="name">' +
                                    '<a href="index.php?page-detail">' + data.productsCart[i]["name"] + '</a></h3>' +
                                    '<div class="price">تومان' + data.productsCart[i]["price_off"] + '</div>' +
                                    '</div><div class="col-xs-1 action"><a data-id="' + data.idCarts[i] + '"' +
                                    ' class="deleteCart" href="" data-url="' + data.urlsForDeleteItemCart[i] + '">' +
                                    '<i class="fa fa-trash"></i></a></div></div> </div> <div class="SeparatorCart"></div>';
                            }
                        } else {
                            for (i = 0; i < data.productsCart.length; i++) {
                                rowCart += '<div class="cart-item product-summary"><div class="row">' +
                                    '<div class="col-xs-4"><div class="image"><a href="detail.html">' +
                                    '<img src="' + data.photos[i] + '" alt=""></a></div></div><div class="col-xs-7"><h3 class="name">' +
                                    '<a href="index.php?page-detail">' + data.productsCart[i]["name"] + '</a></h3>' +
                                    '<div class="price">تومان' + data.productsCart[i]["price_main"] + '</div>' +
                                    '</div><div class="col-xs-1 action"><a data-id="' + data.idCarts[i] + '"' +
                                    ' class="deleteCart" href="" data-url="' + data.urlsForDeleteItemCart[i] + '">' +
                                    '<i class="fa fa-trash"></i></a></div></div> </div> <div class="SeparatorCart"></div>';
                            }
                        }

                        $(rowCart).insertBefore('#nextForInsertCart');
                        $('#countCart').text(data.totalNumberCart);
                        $("span#cost").fadeOut(200, function () {
                            $(this).text(data.totalPriceCart).fadeIn();
                        });
                        $("span#totalPrice").fadeOut(200, function () {
                            $(this).text('تومان ' + data.totalPriceCart).fadeIn();
                        });

                        $('#showbtncheckout > a.btn-upper').attr('disabled', false);

                        // console.table(data);
                        swal("موفق", "محصول با موفقیت به سبد خرید اضافه شد", "success");
                        // */
                    }, error: function (error) {
                        console.log('ERROR 1');
                        swal("", "محصول به سبد خرید اضافه نگردید.", "error");
                    }
                })

            });


        }); //  end of jquery
    </script>
@endsection