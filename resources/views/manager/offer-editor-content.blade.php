<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <link href="{{ asset('landing/css.css') }}" rel="stylesheet" type="text/css">

    <!-- CSS -->
    <link href="{{ asset('landing/style.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/book.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ asset('landing/purple.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">


</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br/>

            <form action="{{route('update-landing')}}"  class="text-large" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input id="n" type="text" name="n" hidden value="{{$n}}">
                <input id="id" type="text" name="id" hidden value="{{$id}}">
                <div class="form-group">
                    <br/><br/>
                    <textarea name="landing" id="landing">@if( ! empty($landing)) {{$landing}} @endif</textarea>
                </div>
                <br/>


                <div class="form-group col-md-12 text-center">
                    <button type="submit" class="btn btn-lg btn-primary">Save</button>
                </div>
                <br>

            </form>

        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ URL::asset('js/core/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/core/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

<!--  Notifications Plugin    -->
<script type="text/javascript" src="{{ URL::asset('js/plugins/bootstrap-notify.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>

<script>


    $(document).ready(function() {
        $('#landing').summernote({
            height: 400,
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

</body>

</html>
