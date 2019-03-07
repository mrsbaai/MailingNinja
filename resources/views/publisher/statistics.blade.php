@extends('layouts.account')

@section('content')
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="card ">
               <div class="card-header ">
                  <h5 class="card-title">[Subscribes] {{ $title }} </h5>
               </div>
               <div class="card-body ">

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#Subscribes7">7 Days</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Subscribes30">30 Days</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Subscribes90">90 Days</a>
                     </li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                     <div id="Subscribes7" class="container tab-pane active"><br>
                        <h5>7 Days Subscribes</h5>
                        {!! $SubscribesChart7->render() !!}


                     </div>
                     <div id="Subscribes30" class="container tab-pane fade"><br>
                        <h5>30 Days Subscribes</h5>
                        {!! $SubscribesChart30->render() !!}

                     </div>
                     <div id="Subscribes90" class="container tab-pane fade"><br>
                        <h5>90 Days Subscribes</h5>
                        {!! $SubscribesChart90->render() !!}


                     </div>
                  </div>


               </div>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-md-12">
            <div class="card ">
               <div class="card-header ">
                  <h5 class="card-title">[Profit] {{ $title }} </h5>
               </div>
               <div class="card-body ">

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#Profit7">7 Days</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Profit30">30 Days</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Profit90">90 Days</a>
                     </li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                     <div id="Profit7" class="container tab-pane active"><br>
                        <h5>7 Days Profit</h5>
                        {!! $ProfitChart7->render() !!}

                     </div>
                     <div id="Profit30" class="container tab-pane fade"><br>
                        <h5>30 Days Profit</h5>
                        {!! $ProfitChart30->render() !!}

                     </div>
                     <div id="Profit90" class="container tab-pane fade"><br>
                        <h5>90 Days Profit</h5>
                        {!! $ProfitChart90->render() !!}

                     </div>
                  </div>


               </div>
            </div>
         </div>
      </div>



      <div class="row">
         <div class="col-md-12">
            <div class="card ">
               <div class="card-header ">
                  <h5 class="card-title">[Leads] {{ $title }} </h5>
               </div>
               <div class="card-body ">

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#Leads7">7 Days</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Leads30">30 Days</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Leads90">90 Days</a>
                     </li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                     <div id="Leads7" class="container tab-pane active"><br>
                        <h5>7 Days Leads</h5>
                        {!! $LeadsChart7->render() !!}


                     </div>
                     <div id="Leads30" class="container tab-pane fade"><br>
                        <h5>30 Days Leads</h5>
                        {!! $LeadsChart30->render() !!}

                     </div>
                     <div id="Leads90" class="container tab-pane fade"><br>
                        <h5>90 Days Leads</h5>
                        {!! $LeadsChart90->render() !!}


                     </div>
                  </div>


               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card ">
               <div class="card-header ">
                  <h5 class="card-title">[Unique Clicks] {{ $title }} </h5>
               </div>
               <div class="card-body ">

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#Clicks7">7 Days</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Clicks30">30 Days</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Clicks90">90 Days</a>
                     </li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                     <div id="Clicks7" class="container tab-pane active"><br>
                        <h5>7 Days Clicks</h5>
                        {!! $ClickChart7->render() !!}


                     </div>
                     <div id="Clicks30" class="container tab-pane fade"><br>
                        <h5>30 Days Clicks</h5>
                        {!! $ClickChart30->render() !!}

                     </div>
                     <div id="Clicks90" class="container tab-pane fade"><br>
                        <h5>90 Days Clicks</h5>
                        {!! $ClickChart90->render() !!}


                     </div>
                  </div>


               </div>
            </div>
         </div>
      </div>



<div class="row">
         <div class="col-md-12">
            <div class="card ">
               <div class="card-header ">
                  <h5 class="card-title">[Unique Opens] {{ $title }} </h5>
               </div>
               <div class="card-body ">

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#Clicks7">7 Days</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Clicks30">30 Days</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#Clicks90">90 Days</a>
                     </li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                     <div id="Clicks7" class="container tab-pane active"><br>
                        <h5>7 Days Opens</h5>
                        {!! $OpenChart7->render() !!}


                     </div>
                     <div id="Clicks30" class="container tab-pane fade"><br>
                        <h5>30 Days Opens</h5>
                        {!! $OpenChart30->render() !!}

                     </div>
                     <div id="Clicks90" class="container tab-pane fade"><br>
                        <h5>90 Days Opens</h5>
                        {!! $OpenChart90->render() !!}


                     </div>
                  </div>


               </div>
            </div>
         </div>
      </div>




   </div>

@endsection

@section('title')
   {{ $title }} Statistics
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
   <!-- Chart JS -->
   <script type="text/javascript" src="{{ URL::asset('js/plugins/chartjs.min.js') }}"></script>


@endsection
