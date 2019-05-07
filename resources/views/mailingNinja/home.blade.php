@extends('layouts.app')

@section('content')
    <div class="page-header" data-parallax="true" style="background-image: url('{{ URL::asset('images/3.jpg') }}');">
        <div class="filter"></div>
        <div class="container">
            <div class="motto text-center">

                <h1>Mailing Ninja</h1>
                <h3>Exclusive Offers For <b><u>Traffic Monetization</u></b> & <b><u>E-Mail List Building</u></b></h3>
                <br />
                <a href="/registe?monetize" class="btn btn-outline-neutral btn-round">Request An Account</a>
            </div>
        </div>
    </div>
        <div class="section text-center">
            <div class="container">

                <div class="row">



                    <div class="col-md-6">
                        <div class="card card-profile card-plain">
                            <img class="max-img text-center" src="{{ URL::asset('images/world_ninja.png') }}" alt="Build Targeted E-Mail Lists">


                            <div class="card-body">
                                <a href="#">
                                    <div class="author">
                                        <h3 class="card-title">Build Mailing Lists</h3>
                                    </div>
                                </a>
                                <p class="card-description text-center">
                                    Automated mailing list generator, from openers, clickers, subscribers, and buyers. Download lists segmented by country and interest.
                                </p>
                                <br>
                                <a href="/register?build" class="btn btn-sm btn-round btn-danger">Get Started</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-profile card-plain">
                            <img class="max-img text-center" src="{{ URL::asset('images/money_ninja.png') }}" alt="Monetize Your Traffic">

                            <div class="card-body">
                                <a href="#">
                                    <div class="author">
                                        <h3 class="card-title">Monetize Your Traffic</h3>
                                    </div>
                                </a>
                                <p class="card-description text-center">
                                    Send your mailing traffic to our high converting landing pages and get maximum revenue from any mailing list.
                                </p>
                                <br>
                                <a href="/register" class="btn btn-sm btn-round btn-danger">Get Started</a>
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
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="nc-icon nc-spaceship"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Build Mailing Lists</h4>
                                <p>Use our free digital products giveaways, and generate quality mailing lists.</p>
                                <a href="#pkp" class="btn btn-link btn-danger">See more</a><br/><br/><br/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="nc-icon nc-bulb-63"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Exclusive Offers</h4>
                                <p>Exclusive high converting CPC & CPA offers.</p>
                                <a href="#pkp" class="btn btn-link btn-danger">See more</a><br/><br/><br/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="nc-icon nc-globe"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Worldwide</h4>
                                <p class="description">We have digital product offers for most countries in the world.</p>
                                <a href="#pkp" class="btn btn-link btn-danger">See more</a><br/><br/><br/>
                            </div>
                        </div>
                    </div>



                </div>
                <br/><br/>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="/register" class="btn btn-lg  btn-outline-danger  btn-round">Request An Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="section landing-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <h2 class="text-center">Keep in touch?</h2><br/>
                        @include('flash::message')
                        {{ Form::open(array('action' => 'ContactController@saveContact'))}}
                        @csrf
                            <input type="text"  id="lg_role" name="lg_role" value="unregistered_publisher" hidden>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Subject</label>
                                    <div class="input-group">
	                                        <span class="input-group-addon">
	                                            <i class="nc-icon nc-bulb-63"></i>
	                                        </span>
                                        <input type="text" id="lg_subject" name="lg_subject" class="form-control" placeholder="Subject" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Email</label>
                                    <div class="input-group">
											<span class="input-group-addon">
												<i class="nc-icon nc-email-85"></i>
											</span>
                                        <input type="text"  id="lg_email" name="lg_email" class="form-control" placeholder="Email" required>
                                    </div>
                                </div>
                            </div>
                            <label>Message</label>
                            <textarea class="form-control" rows="4"  id="lg_message" name="lg_message" placeholder="Tell us your thoughts and feelings..." required></textarea>
                            <div class="row text-center">
                                <div class="col-md-4 ml-auto mr-auto">
                                    <br/>
                                    <button class="btn btn-fill">Send Message</button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
