

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
    <div>
        <a href="https://www.addtoany.com/share#url={{url()->current()}}&amp;title=" target="_blank"><img src="https://static.addtoany.com/buttons/a2a.svg" width="32" height="32" style="background-color:royalblue"></a>
        <a href="https://www.addtoany.com/add_to/facebook?linkurl={{url()->current()}}&amp;linkname=" target="_blank"><img src="https://static.addtoany.com/buttons/facebook.svg" width="32" height="32" style="background-color:royalblue"></a>
        <a href="https://www.addtoany.com/add_to/twitter?linkurl={{url()->current()}}&amp;linkname=" target="_blank"><img src="https://static.addtoany.com/buttons/twitter.svg" width="32" height="32" style="background-color:royalblue"></a>
        <a href="https://www.addtoany.com/add_to/google_plus?linkurl={{url()->current()}}&amp;linkname=" target="_blank"><img src="https://static.addtoany.com/buttons/google_plus.svg" width="32" height="32" style="background-color:royalblue"></a>
        <a href="https://www.addtoany.com/add_to/pinterest?linkurl={{url()->current()}}&amp;linkname=" target="_blank"><img src="https://static.addtoany.com/buttons/pinterest.svg" width="32" height="32" style="background-color:royalblue"></a>
        <a href="https://www.addtoany.com/add_to/whatsapp?linkurl={{url()->current()}}&amp;linkname=" target="_blank"><img src="https://static.addtoany.com/buttons/whatsapp.svg" width="32" height="32" style="background-color:royalblue"></a>
        <a href="https://www.addtoany.com/add_to/email?linkurl={{url()->current()}}&amp;linkname=" target="_blank"><img src="https://static.addtoany.com/buttons/email.svg" width="32" height="32" style="background-color:royalblue"></a>
    </div>
    <!-- AddToAny END -->
    <br/>


    <script>

        setTimeout(function(){
            $('#subscribe-modal').modal();
        }, 30000);

    </script>
@endsection