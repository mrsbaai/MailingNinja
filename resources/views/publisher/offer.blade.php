

@extends('layouts.account')

@section('content')

    <div class="content">
        <div class="row">
            <div class="col-lg-5">
            <div class="col-lg-12">



                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{$data['title']}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row px-4">

                                <div class="row">
                                    <h6>Countries:
                                        @foreach($data['countries'] as $key => $country)@if ($key != key($data['countries'])), @endif{{ $country['code'] }}@endforeach

                                    </h6>
                                </div>

                                @if(Auth::user()->is_monetize == true)
                                    @if($data['cpc'] > 0)
                                        <div class="row">
                                            <h6>Offer Type: CPC</h6>
                                        </div>
                                        <div class="row">
                                            <h6>Offer Payout: {{$data['cpc']}}</h6>
                                        </div>


                                    @endif

                                    @if($data['cpa'] > 0)
                                            <div class="row">
                                                <h6>Offer Type: CPA</h6>
                                            </div>
                                            <div class="row">
                                                <h6>Offer Payout: {{$data['cpa']}}</h6>
                                            </div>
                                    @endif
                                @endif


                                <div class="row">
                                <h6>Verticals:
                                    @foreach($data['verticals'] as $key => $vertical)@if ($key != key($data['verticals'])), @endif{{ $vertical['vertical'] }}@endforeach
                                </h6>
                                </div>
                                <br/><br/>

                            </div>


                            <div class="row">
                                <br/>
                                <div class="col-centered">
                                <a target='_blank' href='{{$data['preview']}}' title='Preview Landing Page'>
                                        <img src="{{$data['thumbnail']}}" class="img-thumbnail rounded mx-auto d-block"  width="300" alt="{{$data['title']}}">
                                </a>
                                </div>
                                <br/>

                            </div>

                            <div class="row">
                                <br/>
                                <div class="col-centered">
                                    <a target='_blank' href='{{$data['preview']}}' title='Preview Landing Page'>
                                        <button class="btn btn-primary btn-sm">Preview Landing Page</button>
                                    </a>
                                </div>
                            </div>


                        </div>
                    </div>





            </div>

            </div>

            <div class="col-lg-7">
                <div class="">
                    <div class="card ">
                        <div class="card-header">
                            <h5 class="card-title">Offer Link</h5>
                            <p class="card-category">
                                @if(Auth::user()->is_monetize == false)
                                    To track clicks, and <b>download targeted clicks mailing list</b>, replace {email} with the recipient's E-mail address.
                                    You can also refer to the offer without "/{email}".
                                @endif
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-centered">
                                    <div class="input-group">
                                        <div class="input-group-prepend" >
                                            <span class="input-group-text" style="font-size: 110%">Link:</span>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="font-size: 100%"><b>https://{{$data['domain']}}/{{$data['link']}} @if(Auth::user()->is_monetize == false)/{email}@endif</b>&nbsp;&nbsp;</span>
                                        </div>

                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>

                </div>

                <div class="">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Unsubscribe Link</h5>
                            @if(Auth::user()->is_monetize == false)<p class="card-category">/{email} is optional</p>@endif

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-centered">
                                    <div class="input-group">
                                        <div class="input-group-prepend" >
                                            <span class="input-group-text" style="font-size: 110%">Unsubscribe:</span>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="font-size: 100%"><b>https://{{$data['domain']}}/unsubscribe @if(Auth::user()->is_monetize == false)/{email}@endif</b>&nbsp;&nbsp;</span>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Suppression list</h5>
                            <p class="card-category">Don't send this offer to any of these E-mails</p>


                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group col-md-12 text-center">
                                        <a class='btn btn-danger' target='_blank' href='{{$data['suppression']}}'  title='Download Subscribed E-mail List'>
                                            Download Suppression List
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Promotional Tools</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <h6>E-mail Subjects:</h6>
                                    <div class="card-body bg-light rounded border border-light">
                                        @foreach ($data['subjects'] as $subject)
                                            {{ $subject }} <br/>
                                        @endforeach
                                    </div><br/><br/>
                                    <h6>E-mail From Names:</h6>
                                    <div class="card-body bg-light rounded border border-light">
                                        {{$data['author_name']}}<br/>
                                        {{ config('app.name') }}<br/>
                                    </div><br/><br/>
                                    <h6>Text E-mail:</h6>
                                    <div class="card-body bg-light rounded border border-light">
                                        @if( $data['price'] == 0)
                                            Hello {name},<br/><br/>

                                            {{$data['description']}}<br/><br/>

                                            Read More: https://{{$data['domain']}}/{{$data['link']}}/@if(Auth::user()->is_monetize == false){email}@endif<br/><br/>

                                            {{$data['about_1']}}<br/><br/>

                                            To Download This E-book for FREE, Please Follow This Link:<br/><br/>

                                            https://{{$data['domain']}}/{{$data['link']}}/@if(Auth::user()->is_monetize == false){email}@endif<br/><br/>

                                            Cheers,<br/>
                                            {{ config('app.name') }}.<br/><br/>

                                            To unsubscribe please follow this link: https://{{$data['domain']}}/unsubscribe

                                        @else
                                            Hello {name},<br/><br/>

                                            {{$data['description']}}<br/><br/>

                                            Read More: https://{{$data['domain']}}/{{$data['link']}}/@if(Auth::user()->is_monetize == false){email}@endif<br/><br/>

                                            {{$data['about_1']}}<br/><br/>

                                            To Download This E-book With %40 Discount, Please Follow This Link:<br/><br/>

                                            https://{{$data['domain']}}/{{$data['link']}}/@if(Auth::user()->is_monetize == false){email}@endif<br/><br/>


                                            Cheers,<br/>
                                            {{ config('app.name') }}.<br/><br/>

                                            To unsubscribe please follow this link: https://{{$data['domain']}}/unsubscribe
                                        @endif
                                    </div><br/><br/>
                                    <h6>Html E-mail:</h6>
                                    <a target='_blank' href='/preview/email/{{$data['link']}}' title='Preview HTML Email'>
                                        <button class="btn btn-primary btn-sm">Preview Html Email</button>
                                    </a>

                                    <a target='_blank' href='/download/email/{{$data['link']}}' title='Download Html Email'>
                                        <button class="btn btn-primary btn-sm">Download Html Email</button>
                                    </a>
                                    <br/><br/>
                                    <h6>2 Images E-mail:</h6>
                                    <p>Html email converted to 2 simple images (Opt-in, Opt-out), for easy inboxing.</p>

                                    <a target='_blank' href='/download/email/screenshot/{{$data['link']}}' title='Download 2 Images Email'>
                                        <button class="btn btn-success btn-sm">Download 2 Images Email</button>
                                    </a>

                                </div>

                                <p>{!! $data['promo'] !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            @if(Auth::user()->is_monetize == false)
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Tracking Email Opens</h5>
                        <p class="card-category">To track email opens, and <b>download targeted opens mailing list</b>, add this code to your email body. Replace {email} with the recipient's E-mail address.</p>


                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <kbd>&lt;img src="https://{{$data['domain']}}/{{$data['link']}}/tracking/{email}" width="1" height="1" border="0"&gt;</kbd>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif




    </div>



@endsection

        @section('title')
            Promote Offer
        @endsection

        @section('header')
            <style>

                h1,h2,h3,h4 {
                    font-size: 120%;
                    font-weight: bold;
                }
                .col-centered{
                    float: none;
                    margin: 0 auto;
                    padding-bottom: 20px;
                }

                .input-group .form-control:not(:first-child):not(:last-child), .input-group-btn:not(:first-child):not(:last-child){
                    border-radius: 0;
                    border-right: 0;
                }

                .btn:hover, .btn:focus, .btn:active, .btn.active, .btn:active:focus, .btn:active:hover, .btn.active:focus, .btn.active:hover, .show > .btn.dropdown-toggle, .show > .btn.dropdown-toggle:focus, .show > .btn.dropdown-toggle:hover, .navbar .navbar-nav > a.btn:hover, .navbar .navbar-nav > a.btn:focus, .navbar .navbar-nav > a.btn:active, .navbar .navbar-nav > a.btn.active, .navbar .navbar-nav > a.btn:active:focus, .navbar .navbar-nav > a.btn:active:hover, .navbar .navbar-nav > a.btn.active:focus, .navbar .navbar-nav > a.btn.active:hover, .show > .navbar .navbar-nav > a.btn.dropdown-toggle, .show > .navbar .navbar-nav > a.btn.dropdown-toggle:focus, .show > .navbar .navbar-nav > a.btn.dropdown-toggle:hover {
                    background-color: transparent !important;
                    color: black !important;
                    box-shadow: none !important;

                }
            </style>
        @endsection


        @section('footer')



            <script type="text/javascript" src="{{ URL::asset('js/core/jquery.min.js') }}"></script>
            <script type="text/javascript" src="{{ URL::asset('js/core/popper.min.js') }}"></script>
            <script type="text/javascript" src="{{ URL::asset('js/core/bootstrap.min.js') }}"></script>
            <!--  Notifications Plugin    -->
            <script type="text/javascript" src="{{ URL::asset('js/plugins/bootstrap-notify.js') }}"></script>
            <script type="text/javascript" src="{{ URL::asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
            <script>
                $(document).ready(function() {
                    // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
                    demo.initChartsPages();
                });
            </script>
@endsection