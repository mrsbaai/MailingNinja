

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
    <button type="submit" class="btn--subscribe btn--primary btn--inside subs uppercase">Subscribe</button>
    {{ Form::close()}}

    <h4><span class="label label-info"><i class="fas fa-envelope fa-md"></i> {{$subscribers_count}} Subscribed</span></h4>
    <br/>
    <!-- AddToAny BEGIN -->
    <div class="a2a_kit a2a_kit_size_32 a2a_default_style text-center">
        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
        <a class="a2a_button_facebook"></a>
        <a class="a2a_button_twitter"></a>
        <a class="a2a_button_google_plus"></a>
        <a class="a2a_button_whatsapp"></a>
        <a class="a2a_button_email"></a>
        <a class="a2a_button_pinterest"></a>
    </div>
    <script async src="https://static.addtoany.com/menu/page.js"></script>
    <!-- AddToAny END -->
    <br/>


    <script>

        setTimeout(function(){
            $('#subscribe-modal').modal();
        }, 30000);

    </script>
@endsection