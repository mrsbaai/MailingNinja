
<!DOCTYPE html>
<html lang="en">
<head>

    <style>

        #load {
            background-color: #F5F5F5;
            width:100%;
            height:2000px;
        }

        blink {
            -webkit-animation: 1s linear infinite condemned_blink_effect;
            animation: 1s linear infinite condemned_blink_effect;
        }
        @-webkit-keyframes condemned_blink_effect {
        0% {
            visibility: hidden;
        }
        10% {
            visibility: hidden;
        }
        100% {
            visibility: visible;
        }
        }
        @keyframes condemned_blink_effect {
            0% {
                visibility: hidden;
            }
            10% {
                visibility: hidden;
            }
            100% {
                visibility: visible;
            }
        }
        header{
            background-color: #F5F5F5;
        }
        #headerContainer{
            background-image: linear-gradient(to right top, #212120, #1f1f1e, #1d1c1c, #1a1a1a, #181818);
        }

        .action-container{

            background-image: radial-gradient(circle, #f5f5f5, #f6f7f6, #f8f8f8, #f9faf9, #fbfbfb);
            -webkit-box-shadow: 0px 10px 13px -7px #000000, inset 0px 2px 8px 4px rgba(0,0,0,0);
            box-shadow: 0px 10px 13px -7px #000000, inset 0px 2px 8px 4px rgba(0,0,0,0);
            padding-top: 20px;
            border: 10px solid white;
            border-radius: 2px;


        }
        .white{
            text-transform: capitalize;
        }




        #bookhold{
            width: 369px;
            height: 596px;
            background-image: url({{ asset('landing/img/bookhold.png') }}),url({{ $thumbnail }});
            background-size: 369px 596px,133px 178px;
            background-repeat: no-repeat,no-repeat;
            background-position: 0px 0px ,232px 199px;
            overflow: visible!important;
        }



        .thumb{

            box-shadow: 0 3px 5px rgba(0,0,0,.05);
            width: 300px;
            height: auto;
            border: 5px solid white;
            border-radius: 2px;

        }



        .infobook{
            padding: 10px;
            padding-top: 25px;
            padding-bottom: 25px;
            margin: 0px;
            background-image: linear-gradient(to right top, #212120, #1f1f1e, #1d1c1c, #1a1a1a, #181818);


        }
        .infobook p{

            color: white;

        }





        .csstransforms3d .book::before {
            background-color: gray;

        }

        .changed:after {
            background: blue;
        }

        .navbar-default .navbar-nav > li > a:after {
            background:#484d53;
        }



    </style>

    <noscript>
        <style type="text/css">
            #load {visibility : hidden;}
        </style>
    </noscript>



    @include('landing.subscribe')
    @include('landing.Wall')
    @include('landing.contact')

    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/normalize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/bootstrap.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/owl.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/et-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/tooltip.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/lightbox.css') }}">
    <link id="main" rel="stylesheet" type="text/css" href="{{ asset('landing/css/publisher.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/book.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/subscribe.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>



<body>

<div id="load"></div>
<div id="wrapper" class="behind">

    <header >

        <div class="container" id="headerContainer" >

            <div class="col-md-6  hidden-sm hidden-xs">
                <div class="intro-book" style="width: 90%;">
                    <div class="books ">
                        <div class="book">
                            <img src="{{ $thumbnail }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 intro-text">
                <h2 class="heading white" >{{$title}}</h2>
                <h4 class="white">{{$subtitle}}</h4>
                <p class ="white justify">{!! $description !!}</p>


                        @if ($price == 0)
                    <br/>
                    <div class="container" style="padding-left: 15px;">
                        <div class="row" >
                            {{ Form::open(array('action' => 'landingController@register'))}}
                                <input name="code" value="{{$code}}" hidden>
                                <input name="email" type="email" class="form__field" placeholder="Your E-Mail Address" required oninvalid="this.setCustomValidity('Your free eBook will be sent by e-mail.')" oninput="setCustomValidity('')" />
                                <button type="submit" class="btn--subscribe btn--primary btn--inside uppercase" id="action_1" >Download eBook</button>
                            {{ Form::close()}}

                        </div>
                    </div>

                        @else
                        {{ Form::open(array('action' => 'landingController@register'))}}
                        <input name="code" value="{{$code}}" hidden>
                    <a href="#book" class="scrollto btn btn-white" style="margin-left: 0px;">About <span class=" hidden-md hidden-sm hidden-xs"> Book</span></a>
                        <button type="submit" class="btn btn-green purchase" >Purchase<span class=" hidden-md hidden-sm hidden-xs"> eBook</span><span class="price">(Only ${{$price}})</span></button>
                        {{Form::close()}}


                        @endif
                <br/><br/><br/><br/><br/>



            </div>
        </div>

    </header>

    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"  ><h2 class="heading uppercase" style="margin-top: -5px;">{{explode(".", Request::getHost())[0]}}<span style="font-size:200%;color:#7cc576;">.</span></h2></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right main-nav">
                    <li><a href="#book" class="scrollto">Book</a></li>
                    <li><a href="#author" class="scrollto">Author</a></li>
                    <li><a href="#reviews" class="scrollto">Reviews</a></li>
                    <li><a href="#contact" class="scrollto">Contact</a></li>
                    <li><a href="#" class="btn btn-green">@if ($price == 0) Download @else Purchase @endif</a></li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <section id="book" >
        <div class="container">


                <div class="col-md-6">
                    <br/>
                    <div class="book-preview ">
                        <img src="{{ asset('landing/img/kindle.png') }}" class="background-device" alt="">

                        <div class="owl-book">
                            @foreach($images as $image)
                                @if($image !== null && $image !== "" )
                                    <div class="item">
                                        <img src="{{ $image }}" />
                                        <div class="overlay">
                                            <a  href="{{ $image }}" class="expand" data-lightbox="book-collection" data-title="test"><i class="fa fa-expand"></i></a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach


                        </div>
                    </div>
                </div>
                <div class="col-md-6 wide check-green">
                    <h2 class="heading dominant-color wow animated fadeInUp">About The Book</h2>
                    @if($book_about_1 !== null && $book_about_1 !== "" )
                        <p class="subheading big justify wow animated fadeInUp check-green">{!! $book_about_1 !!}</p>
                    @endif
                    @if($book_about_2 !== null && $book_about_2 !== "" )
                        <p class="small justify wow animated fadeInUp check-green">{!! $book_about_2 !!}</p>
                    @endif


                </div>


            </div>




    </section>




    <section id="author" class="reviews">
        <div class="container"  >
            <div class="row"  >
                <div class="col-md-7" >
                    <div class="row author" >
                        <div class="col-sm-12 author-name" >
                            <h2 class="heading dominant-color wow animated fadeInUp">{{ $author_name }} (The Author)</h2>

                            <p class="small justify muted-light wow animated fadeInUp">{{ $author_about }}.</p>

                        </div>
                    </div>

                </div>
                <div class="col-md-5 wow animated fadeInUp" >
                <br/><br/>

                    <span class="pull-right ">
                    <div class="thumb">
                        <img src="{{ $author_image }}" style=" width: 100%;height:auto">
                    </div>
                    </span>

                </div>
            </div>
        </div>
    </section>


    @if($book_about_3 !== null && $book_about_3 !== "" )
        <section class="infobook">

            <div class="container">
                <div class="row">
                    <div class="col-md-12 check-green text-center">
                        <p class="wow animated fadeInUp check-green text-center"><em>{!! $book_about_3 !!}</em></p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="about">

        <div class="container">
            <div class="row">
                <h2 class="heading dominant-color wow animated fadeInUp">People Who Purchased This eBook Also Liked:</h2><br/><br/><br/>
                @yield('Wall')
                <div class="col-lg-12 wow animated fadeInUp" >
                    <p class="text-center">
                        <a id="discover_button" href="{{$related_url}}" class="btn btn-green "  style="background-color: #4C4A48;border-color:#4C4A48; padding: 0px 10px 0px 10px;"  target="_blank">More eBooks...</a>
                    </p>

                </div>
           </div>
       </div>
   </section>


    <section id="reviews" class="reviews" style="padding-bottom: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-left">
                    <h2 class="heading dominant-color">Reviews</h2>
                </div>
                <div class="col-sm-6 text-right text-left-mobile">
                    <div class="rate-amount">
                        4/5 <span>(16 Reviews)</span>
                    </div>
                    <div class="rating">
                        <span class="rate active"></span>
                        <span class="rate active"></span>
                        <span class="rate active"></span>
                        <span class="rate active"></span>
                        <span class="rate"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="owl-reviews">

                    @if($review_name_1 !== null && $review_name_1 !== "" )
                    <div class="item">
                        <div class="review text-center wow animated fadeInUp">
                            <h4 class="subheading reviewer-name">{{ $review_name_1 }}</h4>
                            <h6 class="subheading muted reviewer-city">Tampa, Florida</h6>
                            <div class="rating">
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                            </div>
                            <p class="small">{{ $review_content_1 }}</p>
                        </div>
                    </div>
                    @endif
                    @if($review_name_2 !== null && $review_name_2 !== "" )
                    <div class="item">
                        <div class="review text-center wow animated fadeInUp">
                            <h4 class="subheading reviewer-name">{{ $review_name_2 }}</h4>
                            <h6 class="subheading muted reviewer-city">Los Angeles, California</h6>
                            <div class="rating">
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate"></span>
                            </div>
                            <p class="small">{{ $review_content_2 }}</p>
                        </div>
                    </div>
                    @endif
                    @if($review_name_3 !== null && $review_name_3 !== "" )
                    <div class="item">
                        <div class="review text-center wow animated fadeInUp">
                            <h4 class="subheading reviewer-name">{{ $review_name_3 }}</h4>
                            <h6 class="subheading muted reviewer-city">Dallas, Texas</h6>
                            <div class="rating">
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate"></span>
                            </div>
                            <p class="small">{{ $review_content_3 }}</p>
                        </div>
                    </div>
                    @endif
                    @if($review_name_4 !== null && $review_name_4 !== "" )
                    <div class="item">
                        <div class="review text-center wow animated fadeInUp">
                            <h4 class="subheading reviewer-name">{{ $review_name_4 }}</h4>
                            <h6 class="subheading muted reviewer-city">Tucson, Arizona</h6>
                            <div class="rating">
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                            </div>
                            <p class="small">{{ $review_content_4 }}.</p>
                        </div>
                    </div>
                    @endif
                    @if($review_name_5 !== null && $review_name_5!== "" )
                    <div class="item">
                        <div class="review text-center wow animated fadeInUp">
                            <h4 class="subheading reviewer-name">{{ $review_name_5 }}</h4>
                            <h6 class="subheading muted reviewer-city">Wichita, Kansas</h6>
                            <div class="rating">
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                            </div>
                            <p class="small">{{ $review_content_5 }}</p>
                        </div>
                    </div>
                    @endif
                    @if($review_name_6 !== null && $review_name_6 !== "" )
                    <div class="item">
                        <div class="review text-center wow animated fadeInUp">
                            <h4 class="subheading reviewer-name">{{ $review_name_6 }}</h4>
                            <h6 class="subheading muted reviewer-city">Huntington, New York</h6>
                            <div class="rating">
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate"></span>
                            </div>
                            <p class="small">{{ $review_content_6 }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>


@if(Route::currentRouteName() != 'host-landing')
    <section id="action"  class="reviews text-center wow animated fadeInUp">


        <div class="col-md-12" style="padding-bottom: 80px;">

            <div class="container action-container" >


                <div class="col-md-3 text-left  h2">
                    <img src="{{ asset('landing/img/tr.gif') }}" id="bookhold">
                </div>
                @if ($price == 0)

                    <div class="col-md-9 text-center h2" style="padding-top:80px;padding-left:150px;" >
                        <h1 class="heading" style="font-size: 40px; color: #313131; font-weight: bold;"><blink>Free Download,<br/>
                                Until {{ Carbon\Carbon::tomorrow()->format('l d M Y') }}
                            </blink></h1><br/>
                        <h1 class="heading"><span style="font-size: 50px; color: #B30504;"><strike>${{ $old_price  }}</strike></span><span style="font-size: 50px; color: #7CC576;">  Free!</span></h1><br/>
                    </div>
                <div class="col-md-9 text-center h2" style="padding-top:20px;padding-left:150px;" >
                    {{ Form::open(array('action' => 'landingController@register'))}}
                        <input name="code" value="{{$code}}" hidden>
                        <input type="email" name="email" class="form__field" placeholder="Your E-Mail Address" required />
                        <button type="submit" class="btn--subscribe btn--primary btn--inside uppercase" id="action_2">Download Now</button>
                    {{ Form::close() }}
                    <span class="subheading big justify h2 check-green">(Available in PDF, MOBI, and EPUB)</span>
                </div>
                @else
                    <div class="col-md-9 text-center h2" style="padding-top:120px;padding-left:150px;" >
                        <h1 class="heading"style="font-size: 50px; color: #313131; font-weight: bold;"><blink>Spacial Offer!<br/>
                                Until {{ Carbon\Carbon::tomorrow()->format('l d M Y') }}
                            </blink></h1><br/>
                        <h1 class="heading"><span style="font-size: 50px; color: #B30504;"><strike>${{ $old_price  }}</strike></span><span style="font-size: 50px; color: #7CC576;"> Only ${{ $price  }}</span></h1><br/>

                        <div class='info-form'>
                            {{ Form::open(array('action' => 'landingController@register'))}}
                            <input name="code" value="{{$code}}" hidden>
                            <input type="image" src="https://i.imgur.com/PO6QqRU.jpg" alt="Submit" width='300px'>

                            {{Form::close()}}
                        </div>
                        <span class="subheading big justify h2 check-green">(Avalable in PDF, MOBI, and EPUB)</span>
                    </div>
                @endif


            </div>

        </div>
    </section>

@endif

    <section>

        <div class="container ">
            <div class="row">
                @yield('contact')
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="col-sm-12 text-center text-center-mobile">


                <div id="subscribe-modal" class="modal fade flash-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                @yield('subscribe')
                            </div>
                        </div>
                    </div>
                </div>




                <br/><br/><br/>


                <div class="col-md-12">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8 wow animated fadeInUp">
                        @yield('subscribe')
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>



                <div class="col-md-12">
                    <p class="copyright small">Copyright © <script> document.write(new Date().getFullYear())</script> <span class="uppercase">{{explode(".", Request::getHost())[0]}}.</span> - All rights reserved!</p>

                </div>
            </div>

        </div>
    </footer>

</div>



<script src="{{ asset('landing/js/color-thief.js') }}"></script><script type="text/javascript">


    function ColorLuminance(r, g, b, lum) {

        hex = "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
        // validate hex string
        hex = String(hex).replace(/[^0-9a-f]/gi, '');
        if (hex.length < 6) {
            hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
        }
        lum = lum || 0;

        // convert to decimal and change luminosity
        var rgb = "#", c, i;
        for (i = 0; i < 3; i++) {
            c = parseInt(hex.substr(i*2,2), 16);
            c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
            rgb += ("00"+c).substr(c.length);
        }

        return rgb;
    }



    function lightOrDark(color) {

        // Check the format of the color, HEX or RGB?
        if (color.match(/^rgb/)) {

            // If HEX --> store the red, green, blue values in separate variables
            color = color.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)$/);

            r = color[1];
            g = color[2];
            b = color[3];
        }
        else {

            // If RGB --> Convert it to HEX: http://gist.github.com/983661
            color = +("0x" + color.slice(1).replace(
                    color.length < 5 && /./g, '$&$&'
                )
            );

            r = color >> 16;
            g = color >> 8 & 255;
            b = color & 255;
        }

        // HSP (Highly Sensitive Poo) equation from http://alienryderflex.com/hsp.html
        hsp = Math.sqrt(
            0.299 * (r * r) +
            0.587 * (g * g) +
            0.114 * (b * b)
        );

        // Using the HSP value, determine whether the color is light or dark
        if (hsp>127.5) {

            return 'light';
        }
        else {

            return 'dark';
        }
    }

    function hexToRgb(hex) {
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    }

    var colorThief = new ColorThief();
    colorThief.getpaletteAsync("{{ $thumbnail }}",function(color, element){

        if(lightOrDark('rgb('+color[0][0]+','+color[0][1]+','+color[0][2]+')') == 'dark')
        {
            a = color[0][0];
            b = color[0][1];
            c = color[0][2];

        }
        else if(lightOrDark('rgb('+color[1][0]+','+color[1][1]+','+color[1][2]+')') == 'dark')
        {
            a = color[1][0];
            b = color[1][1];
            c = color[1][2];
        }
        else if(lightOrDark('rgb('+color[2][0]+','+color[2][1]+','+color[2][2]+')') == 'dark')
        {
            a = color[2][0];
            b = color[2][1];
            c = color[2][2];
        }else{
            a = color[0][0];
            b = color[0][1];
            c = color[0][2];
        }


        dominant = "#" + ((1 << 24) + (a << 16) + (b << 8) + c).toString(16).slice(1);
        dominant_light =  ColorLuminance(a,b,c,1);
        if(lightOrDark('rgb('+color[0][0]+','+color[0][1]+','+color[0][2]+')') == 'light')
        {
            a = color[0][0];
            b = color[0][1];
            c = color[0][2];

        }
        else if(lightOrDark('rgb('+color[1][0]+','+color[1][1]+','+color[1][2]+')') == 'light')
        {
            a = color[1][0];
            b = color[1][1];
            c = color[1][2];
        }
        else if(lightOrDark('rgb('+color[2][0]+','+color[2][1]+','+color[2][2]+')') == 'light')
        {
            a = color[2][0];
            b = color[2][1];
            c = color[2][2];
        }else{
            a = color[0][0];
            b = color[0][1];
            c = color[0][2];
        }

        do {

            if (a < b){
                a = parseInt((a + ((b - a) / 2)));
            }else{
                a = parseInt((a - ((a - b) / 2)));
            }
            if (c < b){
                c = parseInt((c + ((b - c) / 2)));
            }else{
                c = parseInt((c - ((c - b) / 2)));
            }
            e = Math.abs(b - a) + Math.abs(b - c);

        }

        while (e > 15);

        secondary = "#" + ((1 << 24) + (a << 16) + (b << 8) + c).toString(16).slice(1);




        $('#action_1').css('background-color', dominant);






        $('.subs').css('background-color', dominant);
        $('.purchase').css('border', '3px solid transparent');
        $('.purchase').css('background', dominant);

        //$('.dominant-color').css('color', dominant);






    });
</script>


<script>
    /* Modernizr 2.5.3 (Custom Build) | MIT & BSD
     * Build: http://www.modernizr.com/download/#-csstransforms3d-shiv-cssclasses-teststyles-testprop-testallprops-prefixes-domprefixes-load
     */
    ;window.Modernizr=function(a,b,c){function z(a){j.cssText=a}function A(a,b){return z(m.join(a+";")+(b||""))}function B(a,b){return typeof a===b}function C(a,b){return!!~(""+a).indexOf(b)}function D(a,b){for(var d in a)if(j[a[d]]!==c)return b=="pfx"?a[d]:!0;return!1}function E(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:B(f,"function")?f.bind(d||b):f}return!1}function F(a,b,c){var d=a.charAt(0).toUpperCase()+a.substr(1),e=(a+" "+o.join(d+" ")+d).split(" ");return B(b,"string")||B(b,"undefined")?D(e,b):(e=(a+" "+p.join(d+" ")+d).split(" "),E(e,b,c))}var d="2.5.3",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l={}.toString,m=" -webkit- -moz- -o- -ms- ".split(" "),n="Webkit Moz O ms",o=n.split(" "),p=n.toLowerCase().split(" "),q={},r={},s={},t=[],u=t.slice,v,w=function(a,c,d,e){var f,i,j,k=b.createElement("div"),l=b.body,m=l?l:b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),k.appendChild(j);return f=["&#173;","<style>",a,"</style>"].join(""),k.id=h,(l?k:m).innerHTML+=f,m.appendChild(k),l||(m.style.background="",g.appendChild(m)),i=c(k,a),l?k.parentNode.removeChild(k):m.parentNode.removeChild(m),!!i},x={}.hasOwnProperty,y;!B(x,"undefined")&&!B(x.call,"undefined")?y=function(a,b){return x.call(a,b)}:y=function(a,b){return b in a&&B(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=u.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(u.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(u.call(arguments)))};return e});var G=function(a,c){var d=a.join(""),f=c.length;w(d,function(a,c){var d=b.styleSheets[b.styleSheets.length-1],g=d?d.cssRules&&d.cssRules[0]?d.cssRules[0].cssText:d.cssText||"":"",h=a.childNodes,i={};while(f--)i[h[f].id]=h[f];e.csstransforms3d=(i.csstransforms3d&&i.csstransforms3d.offsetLeft)===9&&i.csstransforms3d.offsetHeight===3},f,c)}([,["@media (",m.join("transform-3d),("),h,")","{#csstransforms3d{left:9px;position:absolute;height:3px;}}"].join("")],[,"csstransforms3d"]);q.csstransforms3d=function(){var a=!!F("perspective");return a&&"webkitPerspective"in g.style&&(a=e.csstransforms3d),a};for(var H in q)y(q,H)&&(v=H.toLowerCase(),e[v]=q[H](),t.push((e[v]?"":"no-")+v));return z(""),i=k=null,function(a,b){function g(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function h(){var a=k.elements;return typeof a=="string"?a.split(" "):a}function i(a){var b={},c=a.createElement,e=a.createDocumentFragment,f=e();a.createElement=function(a){var e=(b[a]||(b[a]=c(a))).cloneNode();return k.shivMethods&&e.canHaveChildren&&!d.test(a)?f.appendChild(e):e},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+h().join().replace(/\w+/g,function(a){return b[a]=c(a),f.createElement(a),'c("'+a+'")'})+");return n}")(k,f)}function j(a){var b;return a.documentShived?a:(k.shivCSS&&!e&&(b=!!g(a,"article,aside,details,figcaption,figure,footer,header,hgroup,nav,section{display:block}audio{display:none}canvas,video{display:inline-block;*display:inline;*zoom:1}[hidden]{display:none}audio[controls]{display:inline-block;*display:inline;*zoom:1}mark{background:#FF0;color:#000}")),f||(b=!i(a)),b&&(a.documentShived=b),a)}var c=a.html5||{},d=/^<|^(?:button|form|map|select|textarea)$/i,e,f;(function(){var a=b.createElement("a");a.innerHTML="<xyz></xyz>",e="hidden"in a,f=a.childNodes.length==1||function(){try{b.createElement("a")}catch(a){return!0}var c=b.createDocumentFragment();return typeof c.cloneNode=="undefined"||typeof c.createDocumentFragment=="undefined"||typeof c.createElement=="undefined"}()})();var k={elements:c.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",shivCSS:c.shivCSS!==!1,shivMethods:c.shivMethods!==!1,type:"default",shivDocument:j};a.html5=k,j(b)}(this,b),e._version=d,e._prefixes=m,e._domPrefixes=p,e._cssomPrefixes=o,e.testProp=function(a){return D([a])},e.testAllProps=F,e.testStyles=w,g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+t.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return o.call(a)=="[object Function]"}function e(a){return typeof a=="string"}function f(){}function g(a){return!a||a=="loaded"||a=="complete"||a=="uninitialized"}function h(){var a=p.shift();q=1,a?a.t?m(function(){(a.t=="c"?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){a!="img"&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l={},o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};y[c]===1&&(r=1,y[c]=[],l=b.createElement(a)),a=="object"?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),a!="img"&&(r||y[c]===2?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i(b=="c"?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),p.length==1&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&o.call(a.opera)=="[object Opera]",l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return o.call(a)=="[object Array]"},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,i){var j=b(a),l=j.autoCallback;j.url.split(".").pop().split("?").shift(),j.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]||h),j.instead?j.instead(a,e,f,g,i):(y[j.url]?j.noexec=!0:y[j.url]=1,f.load(j.url,j.forceCSS||!j.forceJS&&"css"==j.url.split(".").pop().split("?").shift()?"c":c,j.noexec,j.attrs,j.timeout),(d(e)||d(l))&&f.load(function(){k(),e&&e(j.origUrl,i,g),l&&l(j.origUrl,i,g),y[j.url]=2})))}function i(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var j,l,m=this.yepnope.loader;if(e(a))g(a,0,m,0);else if(w(a))for(j=0;j<a.length;j++)l=a[j],e(l)?g(l,0,m,0):w(l)?B(l):Object(l)===l&&i(l,m);else Object(a)===a&&i(a,m)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,b.readyState==null&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};
</script>


<script src="{{ asset('landing/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('landing/js/owl.carousel.js') }}"></script>
<script src="{{ asset('landing/js/lightbox.min.js') }}"></script>
<script src="{{ asset('landing/js/wow.min.js') }}"></script>
<script src="{{ asset('landing/js/jquery.onepagenav.js') }}"></script>
<script src="{{ asset('landing/js/core.js') }}"></script>
<script src="{{ asset('landing/js/tooltip.js') }}"></script>
<script src="{{ asset('landing/js/jquery.form-validator.js') }}"></script>
<script src="{{ asset('landing/js/preloader.js') }}"></script>
<script src="{{ asset('landing/js/main.js') }}"></script>
<script src="{{ asset('landing/js/bootstrap.min.js') }}"></script>
<script>
    $('#flash-overlay-modal').modal();

    $(document).ready(function(){
        document.getElementById("load").remove();
    });

</script>
</body>

</html>