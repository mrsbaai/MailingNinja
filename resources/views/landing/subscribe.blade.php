

@section('subscribe')
    <p class="wow animated fadeInUp check-green text-center"><h4>“Get Notified About New Trending E-books And Special Offers.”</h4></p>
    {{ Form::open(array('action' => 'subscribeController@subscribePost'))}}
    <input name="code" value="@if(!empty($code)){{$code}}@endif" hidden>
    <input name="email" type="email" class="form__field" placeholder="Your E-Mail Address" required oninvalid="this.setCustomValidity('Please enter your real e-mail.')" oninput="setCustomValidity('')" />
    <button type="submit" class="btn--subscribe btn--primary btn--inside uppercase" id="action_1" >Subscribe</button>
    {{ Form::close()}}
    <br/>
    <h4><span class="label label-default"><i class="fas fa-envelope fa-md"></i> {{$subscribers_count}} Subscribed</span></h4>
    <br/>
@endsection