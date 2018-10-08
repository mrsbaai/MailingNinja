@extends('layouts.account')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                @include('flash::message')
            <form action="@if( ! empty($id)) {{route('update-offer')}} @else {{route('store-offer')}} @endif"  class="text-large" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Offer</h5>

                            </div>
                            <div class="card-body">
                                @if( ! empty($id)) <input id="id" type="text" name="id" hidden value="{{$id}}"> @endif
                                <div class="container">

                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Title: </span>
                                                </div>
                                                <input id="title" type="text" name="title" class="form-control"@if( ! empty($title)) value="{{$title}}" @endif required>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="input-group">


                                                <input id="payout" type="text" name="payout" class="form-control" @if( ! empty($payout)) value="{{$payout}}" @endif required>

                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <b>$</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if( ! empty($id))
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" data-preview="#preview" name="thumbnail" id="thumbnail">
                                                        <label class="custom-file-label" for="thumbnail">Choose Thumbnail</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="product" id="product">
                                                        <label class="custom-file-label" for="product">Choose Product</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    @endif




                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Description: </span>
                                        </div>
                                        <textarea rows="5" name="description" id="description" class="form-control" style="max-height: 100%" required>@if( ! empty($description)) {{$description}} @endif</textarea>

                                    </div>


                                    <div class="form-group">
                                        @if( empty($selected_verticals)) {{$selected_verticals = null}} @endif
                                        {!! Form::select('verticals[]', $verticals, $selected_verticals, ['multiple' => true, 'class' => 'custom-select long', 'size' => '12', 'required' => 'required']) !!}

                                    </div>

                                    <br>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="custom-control custom-checkbox">

                                                @if( ! empty($is_private))
                                                    {{ Form::checkbox('is_private', null, true, array('id'=>'is_private', 'class'=>'custom-control-input')) }}
                                                @else

                                                    {{ Form::checkbox('is_private', null, false, array('id'=>'is_private', 'class'=>'custom-control-input')) }}
                                                @endif

                                                <label class="custom-control-label" for="is_private">Private offer</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-control custom-checkbox">

                                                @if( ! empty($is_active))
                                                    {{ Form::checkbox('is_active', null, true, array('id'=>'is_active', 'class'=>'custom-control-input')) }}
                                                @else
                                                    {{ Form::checkbox('is_active', null, false, array('id'=>'is_active', 'class'=>'custom-control-input')) }}
                                                @endif
                                                <label class="custom-control-label" for="is_active">Active offer</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>


                                    <div class="form-group col-md-12 text-center">
                                        @if( ! empty($id))
                                            <a href="{{$id}}/landing/a" target="BLANK" class="btn btn-outline-default btn-sm">Edit A</a>
                                            <a href="{{$id}}/landing/b" target="BLANK" class="btn btn-outline-default btn-sm">Edit  B</a>
                                            <a class='btn btn-outline-primary btn-sm'  target='blank' href='/preview/{{$id}}/a'>Preview A</a>
                                            <a class='btn btn-outline-primary btn-sm'  target='blank' href='/preview/{{$id}}/b'>Preview B</a>
                                            <a href="{{$id}}/promo" target="BLANK"  class="btn btn-outline-default btn-sm">Edit Promotional Tools</a>
                                            <br/>

                                        @endif
                                        <button type="submit" class="btn btn-danger btn-round btn-lg">Save</button>

                                    </div>






                                </div>
                            </div>



                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="row">
                        <div class="card">
                            <img src="i.imgur.com/nLNOXMy.jpg"/>
                            <img @if( ! empty($thumbnail)) src="{{$thumbnail}}" @else src="/images/ebook.jpg" @endif class="card-img-top img-thumbnail rounded mx-auto d-block"  id="preview" />

                        </div>
                    </div>





                </div>
            </div>





            </form>
        </div>



        </div>
    </div>



@endsection

@section('title')
    @if(empty($id)) New Offer @else Edit Offer @endif
@endsection

@section('header')
   <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
@endsection

@section('footer')

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ URL::asset('js/core/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/core/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

    <!--  Notifications Plugin    -->
    <script type="text/javascript" src="{{ URL::asset('js/plugins/bootstrap-notify.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>

    <script>

        $(document).ready( function() {
            $(document).on('change', '.btn-file :file', function() {
                var input = $(this),
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [label]);
            });

            $('.btn-file :file').on('fileselect', function(event, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = label;

                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
                }

            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#thumbnail").change(function(){
                readURL(this);
            });
        });

        $(document).ready(function() {
            $('#offer').summernote({
                height: 700,
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
                height: 700,
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
