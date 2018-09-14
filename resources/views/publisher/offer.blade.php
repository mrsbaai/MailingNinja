@extends('layouts.account')

@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                @include('flash::message')
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">{{$data['title']}}</h5>
                        <p class="card-category">...</p>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-8">
                            <p>{{$data['description']}}</p>

                            <h4>Generate Referral Link</h4>

                            <p>Set the price to <b>"0"</b> to use the offer for <b>E-mail list building</b>.</p>
                            <div class="row">
                                <div class="col-lg-5">
                                    <form class="form-inline">
                                        <div class="input-group">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" class="form-control" id="price" name="price" placeholder="Product Price" value="{{$data['price']}}" aria-label="Products Price Here">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Generate =></button>
                                            </div>

                                        </div>

                                    </form>
                                    <br/>

                                </div>
                                <div class="col-lg-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Link: </span>
                                        </div>
                                        <input type="text"
                                               class="form-control btn-primary"
                                               aria-label="Referral Link"
                                               onclick="this.focus();this.select()"
                                               readonly="readonly"
                                               value="https://premiumbooks.net/FFSEDDC"
                                        >
                                    </div>
                                    <br/>


                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <img src="{{$data['thumbnail']}}" class="img-thumbnail rounded" width="400" alt="{{$data['title']}}">
                            <br/>

                        </div>


                        <h4>Promotional Tools</h4>
                        {!!$data['promo']!!}
                        <br/>




                        <h4>Unsubscribers (Suppression list) </h4>
                        <div class="container">
                            <p><b>Don't send this offer to any of these E-mails:</b></p>
                            <div class="form-group col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Download Suppression List</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            ...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('title')
    Offer Info
@endsection

@section('header')
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