<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ config('app.name') }}.</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">


    <!-- CSS Files -->


    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/paper-dashboard.css?v=2.0.0') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ URL::asset('css/account.css') }}" rel="stylesheet" />
    

</head>
    <center>

        {{ Form::open(array('action' => 'subscribeController@unsubscribe'))}}

        <br/>
        <br/>
        <br/>
        <div class = "col-3"></div><div class = "col-6"><h2 class="title">Do you want to unsubscribe?</h2></div><div class = "col-3"></div>
        <div class = "col-3"></div><div class = "col-6"> <input name="email" type="text"  class="form-control" placeholder="Email to unsubscribe"></div><div class = "col-3"></div>
        <div class = "col-3"></div><div class = "col-6"> <input class="btn btn-danger"  type="submit" value="Unsubscribe"></div><div class = "col-3"></div>






        {{ Form::close()}}
    </center>









