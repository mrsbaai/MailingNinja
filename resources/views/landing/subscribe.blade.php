

@section('subscribe')
    <style>
        .modal-content {
            background-color: #F5F5F5;
            border: 10px solid white;
            border-radius: 2px;
            -webkit-box-shadow: 0px 10px 13px -7px #000000, inset 0px 2px 8px 4px rgba(0,0,0,0);
            box-shadow: 0px 10px 13px -7px #000000, inset 0px 2px 8px 4px rgba(0,0,0,0);
        }


    </style>
    <p class="wow animated fadeInUp check-green text-center"><h3 class="heading">“Get Notified About New Trending E-books & Special Offers.”</h3></p>
    {{ Form::open(array('action' => 'subscribeController@subscribePost'))}}
    <input name="code" value="@if(!empty($code)){{$code}}@endif" hidden>
    <input name="email" type="email" class="form__field" placeholder="Your E-Mail Address" required oninvalid="this.setCustomValidity('Please enter your real e-mail.')" oninput="setCustomValidity('')" />
    <button type="submit" class="btn--subscribe btn--primary btn--inside uppercase">Subscribe</button>
    {{ Form::close()}}
    <br/>
    <h4><span class="label label-info"><i class="fas fa-envelope fa-md"></i> {{$subscribers_count}} Subscribed</span></h4>
    <br/>

    <script>

        setTimeout(function(){
            $('#subscribe-modal').modal();
        }, 3000);

    </script>
@endsection