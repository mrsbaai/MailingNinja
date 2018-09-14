@extends('layouts.app')

@section('content')
    <div class="page-header" data-parallax="true" style="background-image: url('{{ URL::asset('images/3.jpg') }}');">
        <div class="filter"></div>
        <div class="container">
            <div class="motto text-center">
                <h1>Mailing Ninja</h1>
                <h3>Exclusive Offers For <b><u>Fast Profit</u></b> & <b><u>List Building</u></b></h3>
                <br />
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-outline-neutral btn-round">Watch video</a>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="section text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <h2 class="title">Let's Talk About Our Service</h2>
                        <h5 class="description">We provide <b>exclusive</b> digital products, specially made for costumer <b>segmentation</b>, and generating <b>maximum profit</b> from a <b>random mailing list</b>.</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-profile card-plain">
                            <img class="card-img-top" src="{{ URL::asset('images/sell.png') }}" alt="Card image cap">

                            <div class="card-body">
                                <a href="#paper-kit">
                                    <div class="author">
                                        <h3 class="card-title">Make Money</h3>
                                    </div>
                                </a>
                                <p class="card-description text-center">
                                    <u>Sell</u> our high converting offers and generate maximum <u>profit</u> from your mailing campaigns.
                                </p>
                                <br>
                                <a href="#pkp" class="btn btn-sm btn-round btn-danger">Learn how</a>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="card card-profile card-plain">
                            <img class="card-img-top" src="{{ URL::asset('images/build.png') }}" alt="Card image cap">


                            <div class="card-body">
                                <a href="#paper-kit">
                                    <div class="author">
                                        <h3 class="card-title">Build Lists</h3>
                                    </div>
                                </a>
                                <p class="card-description text-center">
                                    <u>Giveaway</u> our quality digital products and generate well segmented <u>mailing lists</u>.
                                </p>
                                <br>
                                <a href="#pkp" class="btn btn-sm btn-round btn-danger">Learn how</a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <br/>
        </div>

        <div class="section section-dark text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="nc-icon nc-bulb-63"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Customizable Price</h4>
                                <p>Customize the price of the products to hit the sweet spot price point for your audience.</p>
                                <a href="#pkp" class="btn btn-link btn-danger">See more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="nc-icon nc-money-coins"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">High Conversion</h4>
                                <p class="description">Exclusive offers that convert high. Our commission is clear. Their is no other parties involved.</p>
                                <a href="#pkp" class="btn btn-link btn-danger">See more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="nc-icon nc-chart-bar-32"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Statistics</h4>
                                <p>Track Clicks, Subscriptions, Profit... In real time, with ease.</p>
                                <a href="#pkp" class="btn btn-link btn-danger">See more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="nc-icon nc-spaceship"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Build Lists</h4>
                                <p>We don't charge anything for list building. It's Free :)</p>
                                <a href="#pkp" class="btn btn-link btn-danger">See more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <br/><br/>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="/register" class="btn btn-lg  btn-outline-danger  btn-round">Get An Account Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="section landing-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <h2 class="text-center">Keep in touch?</h2>
                        @include('flash::message')
                        <form action="{{url('saveContact')}}" method="POST" enctype="multipart/form-data" class="contact-form" id="contact-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Subject</label>
                                    <div class="input-group">
	                                        <span class="input-group-addon">
	                                            <i class="nc-icon nc-bulb-63"></i>
	                                        </span>
                                        <input type="text" id="lg_subject" name="lg_subject" class="form-control" placeholder="Subject">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Email</label>
                                    <div class="input-group">
											<span class="input-group-addon">
												<i class="nc-icon nc-email-85"></i>
											</span>
                                        <input type="text"  id="lg_email" name="lg_email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <label>Message</label>
                            <textarea class="form-control" rows="4"  id="lg_message" name="lg_message" placeholder="Tell us your thoughts and feelings..."></textarea>
                            <div class="row text-center">
                                <div class="col-md-4 ml-auto mr-auto">
                                    <button class="btn btn-fill">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
