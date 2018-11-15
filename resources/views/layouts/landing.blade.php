<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Peremiumbooks :: Title</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/normalize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/bootstrap.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/owl.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/animate.css') }}">
    <link href="{{ asset('landing/font-awesome-4.1.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/et-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/tooltip.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/lightbox.css') }}">
    <link id="main" rel="stylesheet" type="text/css" href="{{ asset('landing/css/publisher.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/book.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/subscribe.css') }}">
    <style>

        header, .action-container{
            background-image: -webkit-radial-gradient(51% 98%, #F5F5F5 7%, #CCCCCC 98%);
            background-image: radial-gradient(51% 98%, #F5F5F5 7%, #CCCCCC 98%);
        }

        .clients{
            margin: 50px;


        }

        .vcenter {
            display: inline-block;
            vertical-align: middle;
            float: none;
        }

        #bookhold{
            width: 369px;
            height: 596px;
            background-image: url({{ asset('landing/img/bookhold.png') }}),url(http://t0.gstatic.com/images?q=tbn:ANd9GcS-yFFgpIkOE2PnvMrKsjBF_fHtR0oTfyY8OvHykhTMGvCZuM9-);
            background-size: 369px 596px,133px 178px;
            background-repeat: no-repeat,no-repeat;
            background-position: 0px 0px ,232px 199px;
            overflow: visible!important;
        }



        .thumb{
            margin:50px;
            box-shadow: 0 3px 5px rgba(0,0,0,.05);

            max-width: 500px;
            border: 3px solid white;
            border-radius: 2px;

        }
        .thumb img{
            width: 100%;
            height: auto;

        }


        .action-container{
            -webkit-box-shadow: 0px 10px 13px -7px #000000, inset 0px 2px 8px 4px rgba(0,0,0,0);
            box-shadow: 0px 10px 13px -7px #000000, inset 0px 2px 8px 4px rgba(0,0,0,0);
            padding-top: 20px;
            border: 10px solid white;
            border-radius: 2px;

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
</head>
<body>

<div id="wrapper" class="behind">

    <header>

        <div class="container" id="head">

            <div class="col-md-6  hidden-sm hidden-xs wow animated fadeInUp">
                <div class="intro-book" style="width: 250%;">
                    <div class="books ">
                        <div class="book">
                            <img src="http://t0.gstatic.com/images?q=tbn:ANd9GcS-yFFgpIkOE2PnvMrKsjBF_fHtR0oTfyY8OvHykhTMGvCZuM9-" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 intro-text  wow animated fadeInUp">
                <h2 class="heading" >Growing Beautiful Food</h2>
                <h4 class="subheading">A Gardener’s Guide to Cultivating Extraordinary Vegetables and Fruit</h4>
                <p>With the paradigm shift toward local and homegrown food, gardeners and foodies have come to relish beautiful vegetable gardens and beautiful meals. Author Matthew Benson writes that beauty inspires behavior, and he believes that we can and will eat better, be healthier, and live more sustainably when we grow food that’s visually enticing.</p>
                <br/><br/>
                <div class="container">
                    <div class="row">
                        <form class="form">
                            <input type="email" class="form__field" placeholder="Your E-Mail Address" />
                            <button type="button" class="btn--subscribe  btn--primary btn--inside uppercase" id="action_1" >Download</button>
                        </form>
                    </div>
                </div>
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
                <a class="navbar-brand" href="#"  ><h2 class="heading uppercase" style="margin-top: -5px;">Peremiumbooks<span id="logo_span" style="font-size:200%;color:#7cc576;">.<span></h2></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right main-nav">
                    <li><a href="#book" class="scrollto">Book</a></li>
                    <li><a href="#author" class="scrollto">Author</a></li>
                    <li><a href="#reviews" class="scrollto">Reviews</a></li>
                    <li><a href="#contact" class="scrollto">Contact</a></li>
                    <li><a href="#" class="btn btn-green">Download Book</a></li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <section id="book">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="book-preview">
                        <img src="{{ asset('landing/img/kindle.png') }}" class="background-device" alt="">

                        <div class="owl-book">


                            <div class="item">
                                <img src="{{ asset('landing/img/book_page.png') }}" />
                                <div class="overlay">
                                    <a href="{{ asset('landing/img/book_page.png') }}" class="expand" data-lightbox="book-collection" data-title="  "><i class="fa fa-expand"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="heading wow animated fadeInUp">About The Book</h2>
                    <p class="small wow animated fadeInUp">Benson restored a time-worn gentleman’s farm and operates a CSA on one small acre of the land, offering vegetables, orchard fruit, cut flowers, herbs, eggs, and honey from the property. His garden-to-table operation offers an edible feast of textures, colors, and aromas and has grown into a way to feed others, while pushing back against the industrial food system in a small but meaningful way.</p>
                    <p class="small wow animated fadeInUp">Growing Beautiful Food is both inspiration and instruction, with detailed growing advice for 50 remarkable crops, a memorable narrative, and evocative imagery. It’s a photographic journey through four seasons in the garden, fueling the dream that you can connect to the land by growing your own food. Benson encourages us to start small like he did, celebrate every harvest, and understand that heartbreaking crop losses are simply part of the process. Whether gardeners, families, farmers, or chefs, readers will come to the table motivated by the flavor of homegrown, the message of self sufficiency, and the beautiful food that’s as local as their backyards.</p>

                </div>
            </div>
        </div>
    </section>


    <section id="author" class="reviews">
        <div class="container"  >
            <div class="row"  >
                <div class="col-md-7" >
                    <div class="row author" >
                        <div class="col-sm-12 author-name" >
                            <h2 class="heading wow animated fadeInUp">Author: Nicolas Adamson</h2>

                            <p class="small muted-light wow animated fadeInUp">Nullam quis risus eget urna mollis ornare vel eu leo Praesent commodo cursus magna, ligula porta felis euismod semper.l nisl consectetur etonec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Vestibulum id ligula porta felis euismod semper. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Maecenas faucibus mollis interdum.</p>

                        </div>
                    </div>

                </div>
                <div class="col-md-5 text-right wow animated fadeInUp" >

                    <div class="thumb">
                        <img src="{{ asset('landing/img/writer.jpg') }}">
                    </div>

                </div>
            </div>
        </div>
    </section>

    <aside class="clients">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="{{ asset('landing/img/asilver-author.png') }}" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="{{ asset('landing/img/agold-book.png') }}" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="{{ asset('landing/img/agold-seller.png') }}" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="{{ asset('landing/img/asilver-author.png') }}" class="img-responsive img-centered" alt="">
                    </a>
                </div>
            </div>
        </div>
    </aside>

    <section id="reviews" class="reviews">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-left">
                    <h2 class="heading">Reviews</h2>
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
                    <div class="item">
                        <div class="review text-center wow animated fadeInUp">
                            <h4 class="subheading reviewer-name">Alfred Rudolf</h4>
                            <h6 class="subheading muted reviewer-city">Dallas, Texas</h6>
                            <div class="rating">
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate"></span>
                            </div>
                            <p class="small">This book is an excellent resource for anyone who is serious about graphic layout.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="review text-center wow animated fadeInUp">
                            <h4 class="subheading reviewer-name">Emily Carey</h4>
                            <h6 class="subheading muted reviewer-city">Tampa, Florida</h6>
                            <div class="rating">
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                            </div>
                            <p class="small">Swiss Typography is a critical guide for graphic designers. I  recommend this fantastic eBook.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="review text-center wow animated fadeInUp">
                            <h4 class="subheading reviewer-name">Martin Doe</h4>
                            <h6 class="subheading muted reviewer-city">Los Angeles, California</h6>
                            <div class="rating">
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate"></span>
                            </div>
                            <p class="small">Chock full of great photos of lettering with a little info about the artist and projects shown.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="review text-center wow animated fadeInUp">
                            <h4 class="subheading reviewer-name">Alfred Rudolf</h4>
                            <h6 class="subheading muted reviewer-city">Dallas, Texas</h6>
                            <div class="rating">
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate"></span>
                            </div>
                            <p class="small">This book is an excellent resource for anyone who is serious about graphic layout.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="review text-center wow animated fadeInUp">
                            <h4 class="subheading reviewer-name">Emily Carey</h4>
                            <h6 class="subheading muted reviewer-city">Tampa, Florida</h6>
                            <div class="rating">
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                            </div>
                            <p class="small">Swiss Typography is a critical guide for graphic designers. I  recommend this fantastic eBook.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="review text-center wow animated fadeInUp">
                            <h4 class="subheading reviewer-name">Martin Doe</h4>
                            <h6 class="subheading muted reviewer-city">Los Angeles, California</h6>
                            <div class="rating">
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate active"></span>
                                <span class="rate"></span>
                            </div>
                            <p class="small">Chock full of great photos of lettering with a little info about the artist and projects shown.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section id="sample-form">
        <div class="container">
            <form>
                <div class="row">
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="firstname" placeholder="Name" data-validation="required">
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="email" placeholder="Email" data-validation="email">
                    </div>
                    <div class="col-sm-2">
                        <input type="submit" class="btn btn-green sign-up-button sample-button-done" value="Subscribe">
                    </div>
                </div>
            </form>
        </div>
    </section>



    <section id="action"  class="reviews" style="padding-top:0px;">


        <div class="col-md-12 wow animated fadeInUp" >

            <div class="container action-container" >


                <div class="col-md-3 text-left  wow animated fadeInUp">
                    <img src="{{ asset('landing/img/tr.gif') }}" id="bookhold">
                </div>

                <div class="col-md-9 text-center wow animated fadeInUp" style="padding-top:160px;padding-left:150px;" >
                    <p id="heading_1">Download Your Copy Now For <s>$26.99</s><b> FREE!</b></p><br/>
                    <form class="form" >
                        <input type="email" class="form__field" placeholder="Your E-Mail Address" />
                        <button type="button" class="btn--subscribe  btn--primary btn--inside uppercase" id="action_2">Download</button>
                    </form>
                </div>


            </div>

        </div>
    </section>






    <section id="contact" >

        <div class="col-sm-12  wow animated fadeInUp contact-details text-center" style = "padding-top:100px">
            <br/><h2 class="heading">Drop Us A Message</h2><br/><br/><br/><br/>
        </div>
        <div class="container ">


            <div class="row">

                <form>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <input name="firstname" type="text" class="form-control" placeholder="Name" data-validation="required">
                            </div>
                            <div class="col-sm-6">
                                <input name="email" type="text" class="form-control" placeholder="Email" data-validation="email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <input name="subject" type="text" class="form-control" placeholder="Subject" data-validation="required">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <textarea name="body" class="form-control" rows="10" placeholder="Message. . ." data-validation="required"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-right" style="padding-top:18px;">
                                <input id="send_btn" type="submit" class=" btn--subscribe  btn--primary btn--inside " value="Send">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <footer>
        <div class="container " >
            <div class="col-sm-12 text-center text-center-mobile">
                <p class="copyright small">Copyright © 2018-2019 <span class="uppercase">premiumbooks.</span> - All rights reserved!</p>
            </div>

        </div>
    </footer>

</div>

<div class="notification-box"><span>Sending...</span></div>
<div class="mobile-nav">
    <ul class="menu">

    </ul>
</div>


<script src="{{ asset('landing/js/color-thief.js') }}"></script>

<script type="text/javascript">


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
    colorThief.getColorAsync("http://t0.gstatic.com/images?q=tbn:ANd9GcS-yFFgpIkOE2PnvMrKsjBF_fHtR0oTfyY8OvHykhTMGvCZuM9-",function(color, element){

        alert(color[0][0]);
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

        while (e > 20);



        var i = a + b + c;
        do {

            if (i > 400){light1 = "#" + ((1 << 24) + (a << 16) + (b << 8) + c).toString(16).slice(1);}
            light =  ColorLuminance(a,b,c,0.05)

            a = hexToRgb(light).r;
            b = hexToRgb(light).g;
            c = hexToRgb(light).b;
            i = a + b + c;
        }
        while (i < 700);


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

        while (e > 20);



        light = "#" + ((1 << 24) + (a << 16) + (b << 8) + c).toString(16).slice(1);
        $('header').css('background-color', light);

        $('header').css('background-image', '-webkit-radial-gradient(51% 98%, #F5F5F5 7%, ' + light + ' 98%);');
        $('header').css('background-image', 'radial-gradient(51% 98%, #F5F5F5 7%, ' + light + ' 98%)');


        $('.action-container').css('background-image', '-webkit-radial-gradient(51% 98%, #F5F5F5 7%, ' + light + ' 98%);');
        $('.action-container').css('background-image', 'radial-gradient(51% 98%, #F5F5F5 7%, ' + light + ' 98%)');



        //$('#author').css('background-color', light);
        //$('footer').css('background-color', light);
        $('.btn-green').css('color', dominant);

        $('.subheading').css('color', dominant);
        $('.btn-green').css('border-color', dominant);
        $('#action_1').css('background-color', dominant);
        $('#action_2').css('background-color', dominant);
        $('#send_btn').css('background-color', dominant);
        //$('#reviews').css('background-color',light);
        $('#logo_span').css('color', dominant);
        $('#purchase_btn').css('border-color',dominant);
        $('#purchase_btn').css('color',dominant);










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

</body>
</html>