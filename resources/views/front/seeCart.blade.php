@extends('layouts.app')
@section('meta')
    <meta name="description" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">


@endsection

@section('title')
    مشاهده سبد خرید
@endsection

@section('css')
    <style>
        input[type=number] {
            font-size: 1em;
            width: 35%;
            padding: 3px;
            margin: 0;
            border: 2px solid #ddd;
            border-radius: 7px;
            text-align: center;
        }

        input[type=number]:focus {
            outline: none;
            border-color: #acacac;
            transition: all 200ms ease;
        }
    </style>
@endsection

@section('content')


    <!-- main -->
    <main class="cart-page default">
        <div class="container">
            <div class="row">
                <div class="cart-page-content col-xl-9 col-lg-8 col-md-12 order-1">
                    <div class="cart-page-title">
                        <h1>سبد خرید</h1>
                    </div>
                    <div class="table-responsive checkout-content default">
                        <table class="table">
                            <tbody id="completeCarts">
                            @if(Session::has('cart'))
                                @php($cartAll = Session::get('cart'))
                                @php($arrIndex = array_keys($cartAll))

                                @for ($i = 0; $i < count($cartAll); $i++)
                                    <tr class="checkout-item">
                                        <td>
                                            <img width="150" height="auto" src="{{$cartAll[$arrIndex[$i]]['image']}}"
                                                 alt="">
                                            <button class="checkout-btn-remove"></button>

                                        {{--<td class="romove-item">--}}
                                            {{--<a data-id="{{$totalCart[$i]['id']}}" href=""--}}
                                               {{--title="حذف کامل محصول"--}}
                                               {{--class="icon deleteCompleteCart"--}}
                                               {{--data-url="{{route('deleteCompleteCart',$totalCart[$i]['id'])}}">--}}
                                                {{--<i class="fa fa-trash-o"></i></a></td>--}}
                                        {{--</td>--}}
                                        <td>
                                            <h3 class="checkout-title" style="margin-bottom: 0;">
                                                {{$cartAll[$arrIndex[$i]]['name']}}
                                            </h3>
                                        </td>
                                        <td><input type="number" name="hours" value="{{count($cartAll)}}" min="0"
                                                   max="23"> عدد
                                        </td>
                                        <td>{{number_format($cartAll[$arrIndex[$i]]['price']*$cartAll[$arrIndex[$i]]['number'])}}
                                            تومان
                                        </td>
                                    </tr>
                                @endfor
                            @else
                            @endif


                            </tbody>
                        </table>
                    </div>
                </div>
                <aside class="cart-page-aside col-xl-3 col-lg-4 col-md-6 center-section order-2">
                    <div class="checkout-aside">
                        <div class="checkout-summary">
                            <div class="checkout-summary-main">
                                <ul class="checkout-summary-summary">
                                    <li><span>مبلغ کل (
                                                    @if(isset($numberOfCarts))
                                                {{$numberOfCarts}}
                                            @else
                                                0
                                            @endif
                )</span><span>@if(isset($priceOfCarts))
                                                {{$priceOfCarts}}
                                            @else
                                                0
                                            @endif تومان</span></li>
                                    <li>
                                        <span>هزینه ارسال</span>
                                        <span>وابسته به آدرس<span class="wiki wiki-holder"><span
                                                        class="wiki-sign"></span>
                                                        <div class="wiki-container js-dk-wiki is-right">
                                                            <div class="wiki-arrow"></div>
                                                            <p class="wiki-text">
                                                                هزینه ارسال مرسولات می‌تواند وابسته به شهر و آدرس گیرنده
                                                                متفاوت باشد. در
                                                                صورتی که هر
                                                                یک از مرسولات حداقل ارزشی برابر با ۱۰۰هزار تومان داشته باشد،
                                                                آن مرسوله
                                                                بصورت رایگان
                                                                ارسال می‌شود.<br>
                                                                "حداقل ارزش هر مرسوله برای ارسال رایگان، می تواند متغیر
                                                                باشد."
                                                            </p>
                                                        </div>
                                                    </span></span>
                                    </li>
                                </ul>
                                <div class="checkout-summary-devider">
                                    <div></div>
                                </div>
                                <div class="checkout-summary-content">
                                    <div class="checkout-summary-price-title">مبلغ قابل پرداخت:</div>
                                    <div class="checkout-summary-price-value">
                                        <span class="checkout-summary-price-value-amount">۱۵,۳۹۰,۰۰۰</span>تومان
                                    </div>
                                    <a href="#" class="selenium-next-step-shipping">
                                        <div class="parent-btn">
                                            <button class="dk-btn dk-btn-info">
                                                ادامه ثبت سفارش
                                                <i class="now-ui-icons shopping_basket"></i>
                                            </button>
                                        </div>
                                    </a>
                                    <div>
                                                <span>
                                                    کالاهای موجود در سبد شما ثبت و رزرو نشده‌اند، برای ثبت سفارش مراحل بعدی
                                                    را تکمیل
                                                    کنید.
                                                </span>
                                        <span class="wiki wiki-holder"><span class="wiki-sign"></span>
                                                    <div class="wiki-container is-right">
                                                        <div class="wiki-arrow"></div>
                                                        <p class="wiki-text">
                                                            محصولات موجود در سبد خرید شما تنها در صورت ثبت و پرداخت سفارش
                                                            برای شما رزرو
                                                            می‌شوند. در
                                                            صورت عدم ثبت سفارش، تاپ کالا هیچگونه مسئولیتی در قبال تغییر
                                                            قیمت یا موجودی
                                                            این کالاها
                                                            ندارد.
                                                        </p>
                                                    </div>
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-feature-aside">
                            <ul>
                                <li class="checkout-feature-aside-item checkout-feature-aside-item-guarantee">
                                    هفت روز
                                    ضمانت تعویض
                                </li>
                                <li class="checkout-feature-aside-item checkout-feature-aside-item-cash">
                                    پرداخت در محل با
                                    کارت بانکی
                                </li>
                                <li class="checkout-feature-aside-item checkout-feature-aside-item-express">
                                    تحویل اکسپرس
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
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
                        // console.log(parseFloat(data[1]['product_price']));
                        for (let i = 0; i < data.length; i++) {
                            priceOfCarts += (parseFloat(data[i]['product_price']) * parseFloat(data[i]['product_number']));

                            rowCart += "<li><a href='./" + data[i]['product_slug'] + "' class=\"basket-item\">" +
                                "<button class=\"basket-item-remove\"></button>" +
                                "<div class=\"basket-item-content\">" +
                                "<div class=\"basket-item-image\"><img alt='" + data[i]['product_name'] + "' src='" + data[i]['product_image'] + "'> " +
                                "</div>" +
                                "<div class=\"basket-item-details\">" +
                                "<div class=\"basket-item-title\">" + data[i]['product_name'] +
                                "</div>" +
                                "<div class=\"basket-item-params\">" +
                                "<div class=\"basket-item-props\">" +
                                "<span>" + data[i]['product_number'] + "</span><span>رنگ مشکی</span>" +
                                "</div>" +
                                "</div>" +
                                "</div>" +
                                "</div>" +
                                "</a></li>";
                        }

                        $("ul.basket-list").html('');
                        $("ul.basket-list").append(rowCart)
                        $("#priceOfCarts").fadeIn(200, function () {
                            $(this).text(strToMoney(priceOfCarts));
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


            $('#completeCarts').on('click', '.deleteCompleteCart[data-id]', function (e) {
                e.preventDefault();
                var url = $(this).attr('data-url');

                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (data) {
                        // alert("ok")
                        $('#completeCarts' + data.id + '').fadeOut(300, function () {
                            $(this).remove();
                        });

                        $('#countCart').text(data.totalNumberCart);
                        $("span#cost").fadeOut(200, function () {
                            $(this).text(data.totalPriceCart).fadeIn();
                        });
                        $("#totalPriceOfProducts").fadeOut(200, function () {
                            $(this).text(data.totalPriceCart + 'تومان').fadeIn();
                        });
                        // swal("موفق", "با موفقیت ثبت گردید", "success");

                    }, error: function (error) {
                        console.log('ERROR');
                        // swal("", "همه موارد را تکمیل نمایید.", "info");
                    }
                })  //  end of AJAX
            })


        }); //  end of jquery
    </script>
@endsection