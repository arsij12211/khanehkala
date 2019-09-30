<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <meta name="author" content="">
    <meta name="robots" content="all">
    @yield('meta')

    <title>@yield('title') || خانه موبایل</title>

    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('public/assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('public/assets/img/favicon.png')}}">

    <link rel="stylesheet" href="{{asset('public/assets/fonts/font-awesome/css/font-awesome.min.css')}}"/>
    <!-- CSS Files -->
    <link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('public/assets/css/now-ui-kit.css')}}" rel="stylesheet"/>
    <link href="{{asset('public/assets/css/plugins/owl.carousel.css')}}" rel="stylesheet"/>
    <link href="{{asset('public/assets/css/plugins/owl.theme.default.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('public/assets/css/main.css')}}" rel="stylesheet"/>

    <style>

    </style>
    @yield('css')


</head>

<body class="index-page sidebar-collapse">

<!-- responsive-header -->
@includeIf('sub.responsiveHeader')
<!-- responsive-header -->

<div class="wrapper default">

    <!-- header -->
@includeIf('sub.myheader')
<!-- header -->

    <main class="main default">
        <div class="container">
            <!-- banner -->
            <div class="row banner-ads">
                <div class="col-12">
                    <section class="banner">
                        <a href="#">
                            <img src="{{asset('public/assets/img/banner/banner.jpg')}}" alt="">
                        </a>
                    </section>
                </div>
            </div>
            <!-- banner -->
            @yield('content')
            @includeIf('sub.brands')
        </div>
    </main>


    @includeIf('sub.myfooter')
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
<!--  sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!--  Jquery easing -->
<script src="{{asset('public/assets/js/plugins/jquery.easing.1.3.min.js')}}" type="text/javascript"></script>
<!--  LocalSearch -->
<script src="{{asset('public/assets/js/plugins/JsLocalSearch.js')}}" type="text/javascript"></script>
<!-- Main Js -->
<script src="{{asset('public/assets/js/main.js')}}" type="text/javascript"></script>

<script type="text/javascript">

    function strToMoney(Number) {
        Number += '';
        Number = Number.replace(',', '');
        Number = Number.replace(',', '');
        Number = Number.replace(',', '');
        Number = Number.replace(',', '');
        Number = Number.replace(',', '');
        Number = Number.replace(',', '');
        x = Number.split('.');
        y = x[0];
        z = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(y))
            y = y.replace(rgx, '$1' + ',' + '$2');
        return y + z;
    }

    function arrayKeys(input) {
        var output = new Array();
        var counter = 0;
        for (let i in input) {
            output[counter++] = i;
        }
        return output;
    }

    $(document).ready(function () {

        $('#cartsproduct').on('click', '.deleteCart[data-id]', function (e) {
            e.preventDefault();
            let idRowDeleted = $(this).attr('data-id');
            let url = $(this).attr('data-url');
            $.ajax({
                type: "GET",
                url: url,
                success: function (data) {

                    console.table(data);
                    if (data.length > 0) {
                        // console.log('یک آیتم از سبد خرید حذف شد.');
                        $("#numberOfCarts").fadeIn(200, function () {
                            $(this).text(data.length);
                        });

                        let priceOfCarts = 0;
                        let rowCart = '';
                        let arrIndex = arrayKeys(data);
                        for (let i = 0; i < data.length; i++) {
                            priceOfCarts += (parseFloat(data[i]['product_price']) * parseFloat(data[i]['product_number']));

                            let color_name = data[i]['color_name'];

                            rowCart += "<li id='cart" + arrIndex[i] + "' style='position: relative'><button data-url='../deleteCart/" + arrIndex[i] + "'  data-id='" + arrIndex[i] + "' class=\"basket-item-remove deleteCart\"></button>" +
                                "<a href='./" + data[i]['product_slug'] + "' class=\"basket-item\">" +
                                "<div class=\"basket-item-content\">" +
                                "<div class=\"basket-item-image\"><img alt='" + data[i]['product_name'] + "' src='" + data[i]['product_image'] + "'> " +
                                "</div>" +
                                "<div class=\"basket-item-details\">" +
                                "<div class=\"basket-item-title\">" + data[i]['product_name'] +
                                "</div>" +
                                "<div class=\"basket-item-params\">" +
                                "<div class=\"basket-item-props\">" +
                                "<span>" + data[i]['product_number'] + "</span><span>رنگ " + color_name + "</span>" +
                                "</div>" +
                                "</div>" +
                                "</div>" +
                                "</div>" +
                                "</a></li>";
                        }

                        $("ul.basket-list").html('');
                        $("ul.basket-list").append(rowCart);
                        $("#priceOfCarts").fadeIn(200, function () {
                            $(this).text(strToMoney(priceOfCarts));
                        });

                    } else {
                        $("#numberOfCarts").fadeIn(200, function () {
                            $(this).text('0');
                        });
                        $("ul#cartsproduct").html('');
                        $("#priceOfCarts").text('0');
                        $("#basket-header-id > a.basket-link").html('');


                        let divText = document.createTextNode("سبد خرید شما خالی هست!");
                        let divTag = document.createElement("div");
                        divTag.className = "basket-item-content";
                        divTag.style.cssText = 'padding: 5%';
                        divTag.appendChild(divText);

                        let liTag = document.createElement("li");
                        liTag.style.cssText = 'text-align: center;';
                        liTag.appendChild(divTag);

                        document.getElementById('cartsproduct').appendChild(liTag);

                        let basketSubmitBtn = document.querySelector('a.basket-submit');
                        basketSubmitBtn.style.backgroundColor = '#bbfff7';
                        basketSubmitBtn.style.color = 'gray';
                        basketSubmitBtn.href = '';

                        Swal.fire({
                            type: 'info',
                            title: 'سبد خرید',
                            text: 'محصولی در سبد خرید موجود نمی باشد.',
                        });
                    }
                }, error: function (error) {
                    console.log('ERROR');
                    // swal("", "همه موارد را تکمیل نمایید.", "info");
                }
            })
        });

    });                                 //      end of Jquery

</script>
@yield('js')
</html>
