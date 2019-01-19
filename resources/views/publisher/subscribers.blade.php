@extends('layouts.account')

@section('content')
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="card" >
               <div class="card-header ">
                  <h5 class="card-title">Filters</h5>
               </div>
               <div class="card-body">

                  {{ Form::open(array('action' => 'publisherController@downloadSubscribers', 'id' => 'download'))}}
                  <div class="row">
                     <div class="col-md-4">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <div class="input-group-text">Country: </div>
                           </div>
                           {!! Form::select('country', $countries, null, ['class' => 'form-control form-control-lg custom-select', 'placeholder' => 'All']) !!}

                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <div class="input-group-text">Vertical: </div>
                           </div>
                           {!! Form::select('vertical', $verticals, null, ['class' => 'form-control form-control-lg custom-select', 'placeholder' => 'All']) !!}

                        </div>
                     </div>

                     <div class="col-md-4">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <div class="input-group-text">Period: </div>
                           </div>
                           <select class="form-control form-control-lg custom-select" id="period" name="period">
                              <option value="" selected>All</option>
                              <option value="1">Today </option>
                              <option value="7">Last 7 days</option>
                              <option value="30">Last 30 days</option>
                           </select>
                        </div>
                     </div>

                     <div class="col-md-4">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <div class="input-group-text">Confirmed: </div>
                           </div>
                           <select class="form-control form-control-lg custom-select" id="confirmed" name="confirmed">
                              <option value="" selected>All</option>
                              <option value="false">No</option>
                              <option value="true">Yes</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <div class="input-group-text">Type: </div>
                           </div>
                           <select class="form-control form-control-lg custom-select" id="type" name="type">
                              <option value="" selected>All</option>
                              <option value="0">Subscribers</option>
                              <option value="1">Buyers</option>
                              <option value="2">Clickers</option>
                              <option value="3">Openers</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <div class="input-group-text">Contains: </div>
                           </div>
                           <input class="form-control" id="filter" name="filter" placeholder="Ex: @gmail. ">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-12 text-center">
                        <br/>
                        <button type="submit" class="btn btn-primary btn-round">Download</button>
                     </div>
                  </div>
                  {{Form::close()}}
               </div>
               <div class="card-footer">
                  <hr>
                  <div class="stats">
                     <i class="fa fa-history"></i><b>{{$subscribes_today}}</b> New E-mails Today |
                     <i class="fas fa-cloud-download-alt"></i><b>{{$all_subscribes}}</b> Total E-mail Available
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection

@section('title')
   Mailing Lists
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
