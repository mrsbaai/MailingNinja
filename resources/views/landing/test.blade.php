<!doctype html>
<html class="no-js" lang="en">
<head>


    <script src="{{ asset('landing/js/color-thief.js') }}"></script>
    <script src="{{ asset('landing/js/jquery-1.11.1.min.js') }}"></script>

</head>
<body>

<header>
    <div class="container">

        <div id="crossdomain">
            <img width="400" height="200">
            <h1>Cross-domain, image by url</h1>
        </div>
        <script type="text/javascript">
            var colorThief = new ColorThief();
            colorThief.getColorAsync("http://t0.gstatic.com/images?q=tbn:ANd9GcS-yFFgpIkOE2PnvMrKsjBF_fHtR0oTfyY8OvHykhTMGvCZuM9-",function(color, element){
                $('#crossdomain').css('background-color','rgb('+color[0]+','+color[1]+','+color[2]+')')
                $('#crossdomain img').attr('src',element.src)
                console.log('async', color, element.src)
            });
        </script>

    </div>




</body>
</html>