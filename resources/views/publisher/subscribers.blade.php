@extends('layouts.account')

@section('content')
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="card" >
               <div class="card-header ">
                  <h5 class="card-title">Download E-mail Lists</h5>
                  <p class="card-category">...</p>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <div class="input-group-text">Vertical: </div>
                           </div>
                           <select class="form-control form-control-lg custom-select" id="vertical" name="vertical">
                              <option value="all" selected>All Verticals</option>
                              <option value="1">Male Nutra</option>
                              <option value="2">Politics</option>
                              <option value="3">Crypto</option>
                           </select>
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <div class="input-group-text">Period: </div>
                           </div>
                           <select class="form-control form-control-lg custom-select" id="period" name="period">
                              <option value="all" selected>All Time</option>
                              <option value="1">Last Day </option>
                              <option value="7">Last 7 days</option>
                              <option value="30">Last 30 days</option>
                           </select>
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <div class="input-group-text">Confirmed: </div>
                           </div>
                           <select class="form-control form-control-lg custom-select" id="confirmed" name="confirmed">
                              <option value="all" selected>all</option>
                              <option value="no">No</option>
                              <option value="yes">Yes</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-12 text-center">
                        <br/>
                        <button type="submit" class="btn btn-primary btn-round">Download</button>
                     </div>
                  </div>
               </div>
               <div class="card-footer">
                  <hr>
                  <div class="stats">
                     <i class="fa fa-history"></i><b>125</b> New E-mails Today |
                     <i class="fas fa-cloud-download-alt"></i><b>96617</b> Total E-mail Available
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection

@section('title')
   Download Mailing List
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
