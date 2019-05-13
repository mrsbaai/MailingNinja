@section('contact')

    {{ Form::open(array('action' => 'ContactController@saveContact'))}}
    @csrf
    <input type="text"  id="lg_role" name="lg_role" value="unregistered_costumer" hidden>
    <div class="col-md-2"></div>
    <div class="col-md-8  wow animated fadeInUp" id="contact">
        <h2 class="heading">@lang('landing.contact') / <span style="color: #680D0D">@lang('landing.report')</span></h2><br/>
        @include('flash::message')
        <div class="row">

            <div class="col-sm-6">
                <input name="lg_email" type="text" class="form-control" placeholder="Email" data-validation="email">
            </div>

            <div class="col-sm-6">
                <input name="lg_subject" type="text" class="form-control" placeholder="Subject" data-validation="required">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <textarea name="lg_message" class="form-control" rows="5" placeholder="Message. . ." data-validation="required"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-right" style="padding-top:18px;">
                <input id="send_btn" type="submit" class="btn--subscribe btn--primary btn--inside" style="background-color: #4C4A48;border-color:#4C4A48;"value="@lang('landing.send')">
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
    {{ Form::close() }}
@endsection
