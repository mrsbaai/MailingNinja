@extends('layouts.account')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
               
            <form action="@if( ! empty($id)) {{route('update-offer')}} @else {{route('store-offer')}} @endif"  class="text-large" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}


                @if( ! empty($id))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">


                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Reviewer Name 1: </span>
                                                </div>
                                                <input id="review_name_1" type="text" name="review_name_1" class="form-control"@if( ! empty($review_name_1)) value="{{$review_name_1}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Review Content 1: </span>
                                                </div>
                                                <input id="review_content_1" type="text" name="review_content_1" class="form-control"@if( ! empty($review_content_1)) value="{{$review_content_1}}" @endif >
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Reviewer Name 2: </span>
                                                </div>
                                                <input id="review_name_2" type="text" name="review_name_2" class="form-control"@if( ! empty($review_name_2)) value="{{$review_name_2}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Review Content 2: </span>
                                                </div>
                                                <input id="review_content_2" type="text" name="review_content_2" class="form-control"@if( ! empty($review_content_2)) value="{{$review_content_2}}" @endif >
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Reviewer Name 3: </span>
                                                </div>
                                                <input id="review_name_3" type="text" name="review_name_3" class="form-control"@if( ! empty($review_name_3)) value="{{$review_name_3}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Review Content 3: </span>
                                                </div>
                                                <input id="review_content_3" type="text" name="review_content_3" class="form-control"@if( ! empty($review_content_3)) value="{{$review_content_3}}" @endif >
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Reviewer Name 4: </span>
                                                </div>
                                                <input id="review_name_4" type="text" name="review_name_4" class="form-control"@if( ! empty($review_name_4)) value="{{$review_name_4}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Review Content 4: </span>
                                                </div>
                                                <input id="review_content_4" type="text" name="review_content_4" class="form-control"@if( ! empty($review_content_4)) value="{{$review_content_4}}" @endif >
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Reviewer Name 5: </span>
                                                </div>
                                                <input id="review_name_5" type="text" name="review_name_5" class="form-control"@if( ! empty($review_name_5)) value="{{$review_name_5}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Review Content 5: </span>
                                                </div>
                                                <input id="review_content_5" type="text" name="review_content_5" class="form-control"@if( ! empty($review_content_5)) value="{{$review_content_5}}" @endif >
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Reviewer Name 6: </span>
                                                </div>
                                                <input id="review_name_6" type="text" name="review_name_6" class="form-control"@if( ! empty($review_name_6)) value="{{$review_name_6}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Review Content 6: </span>
                                                </div>
                                                <input id="review_content_6" type="text" name="review_content_6" class="form-control"@if( ! empty($review_content_6)) value="{{$review_content_6}}" @endif >
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 1:</span>
                                                </div>
                                                <input id="image_1" type="text" name="image_1" class="form-control"@if( ! empty($image_1)) value="{{$image_1}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 2:</span>
                                                </div>
                                                <input id="image_2" type="text" name="image_2" class="form-control"@if( ! empty($image_2)) value="{{$image_2}}" @endif >
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 3:</span>
                                                </div>
                                                <input id="image_3" type="text" name="image_3" class="form-control"@if( ! empty($image_3)) value="{{$image_3}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 4:</span>
                                                </div>
                                                <input id="image_4" type="text" name="image_4" class="form-control"@if( ! empty($image_4)) value="{{$image_4}}" @endif >
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 5:</span>
                                                </div>
                                                <input id="image_5" type="text" name="image_5" class="form-control"@if( ! empty($image_5)) value="{{$image_5}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 6:</span>
                                                </div>
                                                <input id="image_6" type="text" name="image_6" class="form-control"@if( ! empty($image_6)) value="{{$image_6}}" @endif >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 7:</span>
                                                </div>
                                                <input id="image_7" type="text" name="image_7" class="form-control"@if( ! empty($image_7)) value="{{$image_7}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 8:</span>
                                                </div>
                                                <input id="image_8" type="text" name="image_8" class="form-control"@if( ! empty($image_8)) value="{{$image_8}}" @endif >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 9:</span>
                                                </div>
                                                <input id="image_9" type="text" name="image_9" class="form-control"@if( ! empty($image_9)) value="{{$image_9}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Author Picture:</span>
                                                </div>
                                                <input id="author_image" type="text" name="author_image" class="form-control"@if( ! empty($author_image)) value="{{$author_image}}" @endif >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Author Name:</span>
                                        </div>
                                        <input id="author_name" type="text" name="author_name" class="form-control"@if( ! empty($author_name)) value="{{$author_name}}" @endif >
                                    </div>

                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Author About: </span>
                                        </div>
                                        <textarea rows="5" name="author_about" id="author_about" class="form-control" style="max-height: 100%" >@if( ! empty($author_about)) {{$author_about}} @endif</textarea>

                                    </div>

                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Description: </span>
                                        </div>
                                        <textarea rows="5" name="description" id="description" class="form-control" style="max-height: 100%" >@if( ! empty($description)) {{$description}} @endif</textarea>

                                    </div>

                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Book About 1: </span>
                                        </div>
                                        <textarea rows="5" name="book_about_1" id="book_about_1" class="form-control" style="max-height: 100%" >@if( ! empty($book_about_1)) {{$book_about_1}} @endif</textarea>

                                    </div>

                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Book About 2:</span>
                                        </div>
                                        <textarea rows="5" name="book_about_2" id="book_about_2" class="form-control" style="max-height: 100%" >@if( ! empty($book_about_2)) {{$book_about_2}} @endif</textarea>

                                    </div>

                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Book About 3: </span>
                                        </div>
                                        <textarea rows="5" name="book_about_3" id="book_about_3" class="form-control" style="max-height: 100%" >@if( ! empty($book_about_3)) {{$book_about_3}} @endif</textarea>

                                    </div>




                                </div>


                            </div>
                        </div>
                    </div>

                @endif


                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
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
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Subtitle: </span>
                                                </div>
                                                <input id="subtitle" type="text" name="subtitle" class="form-control"@if( ! empty($subtitle)) value="{{$subtitle}}" @endif required>
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
                                            <a href="{{$id}}/landing/b" target="BLANK" class="btn btn-outline-default btn-sm">Edit B</a>
                                            <a href="{{$id}}/promo" target="BLANK"  class="btn btn-outline-default btn-sm">Edit Promotional Tools</a>
                                            <a class="btn btn-outline-primary btn-sm" target="BLANK"  href="/preview/{{$id}}">Preview</a>

                                            <br/>

                                        @endif
                                        <button type="submit" class="btn btn-danger btn-round btn-lg">Save</button>

                                    </div>

                                </div>
                            </div>


                    </div>

                </div>

                <div class="col-lg-3">

                        <div class="card">
                            <div class="card-body">
                            <img @if( ! empty($thumbnail)) src="{{$thumbnail}}" @else src="/images/ebook.jpg" @endif class="card-img-top rounded mx-auto d-block"  id="preview" />
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
