
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





        .changed:after {
            background: blue;
        }

        .navbar-default .navbar-nav > li > a:after {
            background:#484d53;
        }


        #action_1{
        background-color: {{$color}} !important;

        }
        .subs{
            background-color: {{$color}} !important;;
        }
        .purchase{
            background: {{$color}} !important;
            border: 3px solid {{$color}} !important;

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
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/subscribe.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>



<body>

<div id="load"></div>
<div id="wrapper" class="behind">

    <header  id="headerContainer" >

        <div class="container" >

            <div class="col-md-6 intro-text col-sm-12  col-xs-12 ">
                <img class="img-responsive img-fluid" src="@if($cover != null and $cover != ""){{ $cover }}@else {{ $thumbnail }} @endif" />
            </div>



            <div class="col-md-6  col-sm-12  col-xs-12 intro-text">
                <h2 class="heading white hidden-sm hidden-xs" >{{$title}}</h2>
                <h4 class="white hidden-sm hidden-xs">{{$subtitle}}</h4>
                <p class ="white justify hidden-sm hidden-xs">{!! $description !!}</p>
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




            </div>

        </div>

    </header>

    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="/"  ><h2 class="heading uppercase" style="margin-top: -5px;">{{ config('app.name') }}<span style="font-size:200%;color:#7cc576;">.</span></h2></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right main-nav">
                    <li><a href="#book" class="scrollto">Book</a></li>
                    <li><a href="#author" class="scrollto">Author</a></li>
                    <li><a href="#reviews" class="scrollto">Reviews</a></li>
                    <li><a href="#contact" class="scrollto">Contact</a></li>
                    <li><a class="scrollto" href="{{ route('login') }}">{{ __(' Login') }}</a></li>

                    <li><a href="#" class="btn btn-green">@if ($price == 0) Download @else Purchase @endif</a></li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <section id="book" >
        <div class="container">


                <div class="col-md-6" style="padding-bottom: 100px;">
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
                <div class="col-md-6 wide wow animated fadeInUp" style="padding-left: 80px;">
                    @if($book_about_1 !== null && $book_about_1 !== "" )
                        <p class="subheading big justify wow animated fadeInUp ">{!! $book_about_1 !!}</p>
                    @endif
                    @if($book_about_2 !== null && $book_about_2 !== "" )
                        <p class="small justify wow animated fadeInUp ">{!! $book_about_2 !!}</p>
                    @endif


                </div>


            </div>




    </section>




    <section id="author" class="reviews">
        <div class="container"  >
            <div class="row"  >
                <div class="col-md-8" >
                    <div class="row author" >
                        <div class="col-sm-12 author-name" >
                            <h2 class="heading dominant-color wow animated fadeInUp">About {{ $author_name }}</h2>

                            <p class="small justify muted-light wow animated fadeInUp">{{ $author_about }}.</p>

                        </div>
                    </div>

                </div>
                <div class="col-md-4 wow animated fadeInUp" >
                <br/><br/>


                    <div class="thumb">
                        <img src="{{ $author_image }}" style=" width: 100%;height:auto">
                    </div>


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
                <h2 class="heading dominant-color wow animated fadeInUp">People Who Purchased This E-book Also Liked:</h2><br/><br/><br/>
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
                    <span class="subheading big justify h2">(Available in PDF & EPUB)</span>
                </div>
                @else
                    <div class="col-md-9 text-center h2" style="padding-top:120px;padding-left:150px;" >
                        <h1 class="heading"style="font-size: 50px; color: #313131; font-weight: bold;"><blink>Special Offer!<br/>
                                Until {{ Carbon\Carbon::tomorrow()->format('l d M Y') }}
                            </blink></h1><br/>
                        <h1 class="heading"><span style="font-size: 50px; color: #B30504;"><strike>${{ $old_price  }}</strike></span><span style="font-size: 50px; color: #7CC576;"> Only ${{ $price  }}</span></h1><br/>

                        <div class='info-form'>
                            {{ Form::open(array('action' => 'landingController@register'))}}
                            <input name="code" value="{{$code}}" hidden>
                            <input type="image" src="https://i.imgur.com/PO6QqRU.jpg" alt="Submit" width='300px'>

                            {{Form::close()}}
                        </div>
                        <span class="subheading big justify h2">(Available in PDF & EPUB)</span>
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
                    <p class="copyright small">Copyright © <script> document.write(new Date().getFullYear())</script> <span class="uppercase">{{ config('app.name') }}.</span> - All rights reserved!</p>

                </div>
            </div>

        </div>
    </footer>

</div>





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
        if (!('remove' in Element.prototype)) {
            Element.prototype.remove = function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            };
        }

        document.getElementById("load").remove();

    });


</script>
</body>

</html>