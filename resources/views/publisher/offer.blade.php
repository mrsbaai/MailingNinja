

@extends('layouts.account')

@section('content')

    <div class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <span style="float: right">
                                <a target='_blank' href='{{$data['preview']}}' title='Preview Landing Page'>
                                    <button class="btn btn-primary btn-sm">Preview Landing Page</button>
                                </a>
                            </span>
                        <span style="float: left">

                        <h5 class="card-title">About: {{$data['title']}}</h5>
                        </span>

                    </div>
                    <div class="card-body">
                        <div class="row px-4">
                            <p><b>Desctiption:</b> {{$data['description']}}</p>

                                <br/>


                            <h5>Verticals:
                                @foreach($data['verticals'] as $key => $vertical)@if ($key != key($data['verticals'])), @endif{{ $vertical['vertical'] }}@endforeach.
                            </h5>

                            <br/>
                            <p>
                                <br/> <br/>

                                <a target='_blank' href='{{$data['preview']}}' title='Preview Landing Page'>
                                    <div class="text-center">
                                    <img src="{{$data['thumbnail']}}" class="img-thumbnail rounded mx-auto d-block" width="300" alt="{{$data['title']}}">
                                    </div>
                                </a>
                                <br/>




                            </p>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Promotional Tools</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <h6>Subjects:</h6>
                                    <div class="card-body bg-light rounded border border-light">
                                        @foreach ($data['subjects'] as $subject)
                                            {{ $subject }} <br/>
                                        @endforeach
                                    </div><br/><br/>
                                    <h6>Froms:</h6>
                                    <div class="card-body bg-light rounded border border-light">
                                        {{$data['author_name']}}<br/>
                                        {{ config('app.name') }}<br/>
                                    </div><br/><br/>
                                    <h6>Text E-mail:</h6>
                                    <div class="card-body bg-light rounded border border-light">
                                        {{$data['title']}}<br/>
                                        {{$data['title']}}<br/>
                                        {{$data['title']}}<br/>
                                    </div><br/><br/>
                                    <h6>Html E-mail:</h6>
                                    <a target='_blank' href='{{$data['preview']}}' title='Preview Landing Page'>
                                        <button class="btn btn-primary btn-sm">Preview Html Email</button>
                                    </a>

                                    <a target='_blank' href='{{$data['preview']}}' title='Preview Landing Page'>
                                        <button class="btn btn-primary btn-sm">Download Html Email</button>
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

            <div class="col-lg-6">

                <div class="card ">
                    <div class="card-header">
                        <h5 class="card-title">Offer Price</h5>
                        <p class="card-category">If you set the price to <b>$0</b> the visitors will be asked for their email to download the product for free, perfect for list building or data cleaning.</p>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-9 col-centered">

                                {{ Form::open(array('action' => 'publisherController@offerSetPrice', 'id' => 'set_price'))}}

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-size: 300%"><b>$</b></div>
                                    </div>
                                    <input name="offer_id" value="{{$data['offer_id']}}" hidden>
                                    <input class="form-control" name="price" value="{{$data['price']}}" placeholder="Price" type="number" step=".01"style="font-size: 300%" required>

                                    <div class="input-group-append">
                                                <span class="input-group-text p-0 ">
                                                    <button type="submit" class="btn btn-link" title="Set the price">
                                                        <i class="nc-icon nc-minimal-right" style="font-size: 300%"></i>&nbsp;&nbsp;
                                                    </button>
                                                </span>
                                    </div>

                                </div>
                                {{Form::close()}}

                            </div>

                    </div>



                </div>
            </div>
        </div>


            <div class="col-lg-6">

                <div class="card ">
                    <div class="card-header">
                        <h5 class="card-title">Offer Link</h5>
                        <p class="card-category">
                            To track clicks, and <b>download targeted clicks mailing list</b>, replace {email} with the recipient's E-mail address.
                            You can also refer to the offer without "/{email}".
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
                                            <span class="input-group-text" style="font-size: 100%"><b>http://{{$data['domain']}}/{{$data['link']}}/{email}</b>&nbsp;&nbsp;</span>
                                        </div>

                                    </div>

                            </div>
                         </div>


                </div>
            </div>
        </div>

            <div class="col-lg-6">
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

            <div class="col-md-6">
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