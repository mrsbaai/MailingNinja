@extends('layouts.account')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                @include('flash::message')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Edit Info</h5>
                    </div>
                    <div class="card-body">
                        {{ Form::open(array('action' => 'userController@updateInfo', 'id' => 'info-form'))}}
                        <input name="id" id="id" value="{{$data['id']}}" hidden>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Company</label>
                                    <input name="name" id="name" type="text" class="form-control" placeholder="Company" value="{{$data['name']}}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input name="first_name" id="first_name" type="text" class="form-control" placeholder="First Name"value="{{$data['first_name']}}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input name="last_name" id="last_name" type="text" class="form-control" placeholder="Last Name" value="{{$data['last_name']}}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>


                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label  for="email">Email address</label>
                                    <input name="email" id="email" type="email" class="form-control" placeholder="Email" value="{{$data['email']}}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label  for="skype">Skype</label>
                                    <input name="skype" id="skype" type="text" class="form-control" placeholder="Skype" value="{{$data['skype']}}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label  for="phone">Phone Number</label>
                                    <input name="phone" id="phone" type="text" class="form-control" placeholder="Ex: (001) 456-7890" value="{{$data['phone']}}" onkeydown="javascript:backspacerDOWN(this,event);" onkeyup="javascript:backspacerUP(this,event);">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input name="address" id="address" type="text" class="form-control" placeholder="Home Address" value="{{$data['address']}}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input name="city" id="city" type="text" class="form-control" placeholder="City"  value="{{$data['city']}}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    {!!Form::select('country', $countries, $data['country'], ['class' => 'form-control'])!!}


                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="postal_code">Postal Code</label>
                                    <input name="postal_code" id="postal_code" type="number" class="form-control" placeholder="ZIP Code" value="{{$data['postal_code']}}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="paypal">PayPal E-mail</label>
                                    <input name="paypal" id="paypal" type="email" class="form-control" placeholder="PayPal E-mail (Buisness)" value="{{$data['paypal']}}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="merchant_id">PayPal Merchant ID</label>
                                    <input name="merchant_id" id="merchant_id" type="text" class="form-control" placeholder="PayPal Merchant ID (Buisness)" value="{{$data['merchant_id']}}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="website">Website URL</label>
                                    <input name="website" id="website" type="text" class="form-control" placeholder="Website URL" value="{{$data['website']}}">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="update ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary btn-round">Update Info</button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Sign up Message</h5>
                    </div>
                    <div class="card-body">
                        <p>{{$data['message']}}</p>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('title')
    Publisher Info
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




    <!-- auro phone formating -->
    <script>


        var zChar = new Array(' ', '(', ')', '-', '.');
        var maxphonelength = 13;
        var phonevalue1;
        var phonevalue2;
        var cursorposition;

        function ParseForNumber1(object) {
            phonevalue1 = ParseChar(object.value, zChar);
        }

        function ParseForNumber2(object) {
            phonevalue2 = ParseChar(object.value, zChar);
        }

        function backspacerUP(object, e) {
            if (e) {
                e = e
            } else {
                e = window.event
            }
            if (e.which) {
                var keycode = e.which
            } else {
                var keycode = e.keyCode
            }

            ParseForNumber1(object)

            if (keycode >= 48) {
                ValidatePhone(object)
            }
        }

        function backspacerDOWN(object, e) {
            if (e) {
                e = e
            } else {
                e = window.event
            }
            if (e.which) {
                var keycode = e.which
            } else {
                var keycode = e.keyCode
            }
            ParseForNumber2(object)
        }

        function GetCursorPosition() {

            var t1 = phonevalue1;
            var t2 = phonevalue2;
            var bool = false
            for (i = 0; i < t1.length; i++) {
                if (t1.substring(i, 1) != t2.substring(i, 1)) {
                    if (!bool) {
                        cursorposition = i
                        bool = true
                    }
                }
            }
        }

        function ValidatePhone(object) {

            var p = phonevalue1

            p = p.replace(/[^\d]*/gi, "")

            if (p.length < 3) {
                object.value = p
            } else if (p.length == 3) {
                pp = p;
                d4 = p.indexOf('(')
                d5 = p.indexOf(')')
                if (d4 == -1) {
                    pp = "(" + pp;
                }
                if (d5 == -1) {
                    pp = pp + ")";
                }
                object.value = pp;
            } else if (p.length > 3 && p.length < 7) {
                p = "(" + p;
                l30 = p.length;
                p30 = p.substring(0, 4);
                p30 = p30 + ")"

                p31 = p.substring(4, l30);
                pp = p30 + p31;

                object.value = pp;

            } else if (p.length >= 7) {
                p = "(" + p;
                l30 = p.length;
                p30 = p.substring(0, 4);
                p30 = p30 + ")"

                p31 = p.substring(4, l30);
                pp = p30 + p31;

                l40 = pp.length;
                p40 = pp.substring(0, 8);
                p40 = p40 + "-"

                p41 = pp.substring(8, l40);
                ppp = p40 + p41;

                object.value = ppp.substring(0, maxphonelength);
            }

            GetCursorPosition()

            if (cursorposition >= 0) {
                if (cursorposition == 0) {
                    cursorposition = 2
                } else if (cursorposition <= 2) {
                    cursorposition = cursorposition + 1
                } else if (cursorposition <= 5) {
                    cursorposition = cursorposition + 2
                } else if (cursorposition == 6) {
                    cursorposition = cursorposition + 2
                } else if (cursorposition == 7) {
                    cursorposition = cursorposition + 4
                    e1 = object.value.indexOf(')')
                    e2 = object.value.indexOf('-')
                    if (e1 > -1 && e2 > -1) {
                        if (e2 - e1 == 4) {
                            cursorposition = cursorposition - 1
                        }
                    }
                } else if (cursorposition < 11) {
                    cursorposition = cursorposition + 3
                } else if (cursorposition == 11) {
                    cursorposition = cursorposition + 1
                } else if (cursorposition >= 12) {
                    cursorposition = cursorposition
                }

                var txtRange = object.createTextRange();
                txtRange.moveStart("character", cursorposition);
                txtRange.moveEnd("character", cursorposition - object.value.length);
                txtRange.select();
            }

        }

        function ParseChar(sStr, sChar) {
            if (sChar.length == null) {
                zChar = new Array(sChar);
            } else zChar = sChar;

            for (i = 0; i < zChar.length; i++) {
                sNewStr = "";

                var iStart = 0;
                var iEnd = sStr.indexOf(sChar[i]);

                while (iEnd != -1) {
                    sNewStr += sStr.substring(iStart, iEnd);
                    iStart = iEnd + 1;
                    iEnd = sStr.indexOf(sChar[i], iStart);
                }
                sNewStr += sStr.substring(sStr.lastIndexOf(sChar[i]) + 1, sStr.length);

                sStr = sNewStr;
            }

            return sNewStr;
        }
        var clipboard = new Clipboard('.btn');

        clipboard.on('success', function(e) {
            console.log(e);
        });

        clipboard.on('error', function(e) {
            console.log(e);
        });
    </script>
@endsection
