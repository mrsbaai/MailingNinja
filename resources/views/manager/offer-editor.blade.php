@extends('layouts.manager')

@section('header')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/account.css') }}">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>





@endsection

@section('content')
<div class="container">
    @include('flash::message')
    <h1>Offer Builder</h1>

    <form action="@if( ! empty($id)) {{route('update-offer')}} @else {{route('store-offer')}} @endif"  class="text-large" method="POST">
        {{ csrf_field() }}

        @if( ! empty($id)) <input id="id" type="text" name="id" hidden value="{{$id}}"> @endif


        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <label for="verticals">Niches:</label>
                    @if( empty($selected_verticals)) {{$selected_verticals = null}} @endif
                    {!! Form::select('verticals[]', $verticals, $selected_verticals, ['multiple' => true, 'class' => 'form-control long']) !!}

                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input id="title" type="text" name="title" class="form-control" @if( ! empty($title)) value="{{$title}}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control">@if( ! empty($description)) {{$description}} @endif</textarea>

                    </div>
                    <div class="form-group">
                        <label for="payout">Default Payout ($):</label>
                        <input id="payout" type="text" name="payout" class="form-control" @if( ! empty($payout)) value="{{$payout}}" @endif>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">

                                @if( ! empty($is_private))
                                    {{ Form::checkbox('is_private', null, true, array('id'=>'is_private')) }}
                                @else

                                    {{ Form::checkbox('is_private', null, false, array('id'=>'is_private')) }}
                                @endif

                                <label class="custom-control-label" for="is_private">Private offer</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group ui checkbox">

                                @if( ! empty($is_active))
                                    {{ Form::checkbox('is_active', null, true, array('id'=>'is_active')) }}
                                @else
                                    {{ Form::checkbox('is_active', null, false, array('id'=>'is_active')) }}
                                @endif
                                <label class="custom-control-label" for="is_active">Active offer</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>




        <br/>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content">Offer Content:</label>
                        <textarea name="offer" id="offer">@if( ! empty($offer)) {{$offer}} @endif</textarea>
                    </div>
                    <br/>

                    <div class="form-group">
                        <label for="promo">Promotional tools:</label>
                        <textarea name="promo" id="promo">@if( ! empty($promo)) {{$promo}} @endif</textarea>
                    </div>
                    <br/><br/>

                    <div class="form-group col-md-12 text-center">
                        <button type="submit" class="btn btn-lg btn-primary">Save</button>
                    </div>
                    <br>
                </div>
            </div>
        </div>



    </form>


</div>
@endsection

@section('footer')


    <script>
        $(document).ready(function() {
            $('#offer').summernote({
                height: 500,
                toolbar: [
                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['table', 'picture' ,'video', 'link', 'hr']],
					['controle', ['fullscreen', 'codeview', 'undo', 'redo']],
                   
                ]
            });
        });

        $(document).ready(function() {
            $('#promo').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['table', 'picture' ,'video', 'link', 'hr']],
					['controle', ['fullscreen', 'codeview', 'undo', 'redo']],

                ]
            });
        });
    </script>


@endsection
