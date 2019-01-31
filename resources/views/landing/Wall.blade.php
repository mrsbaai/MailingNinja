
@section('Wall')

    <style>


        @media (min-width: 1200px) {
            .row-fix > .col-lg-4:nth-child(3n+1) {
                clear: left;
            }
        }

        @media (min-width: 992px) and (max-width:1199px) {
            .row-fix > .col-md-3:nth-child(4n+1) {
                clear: left;
            }
        }

        @media (min-width: 768px) and (max-width:991px) {
            .row-fix > .col-sm-6:nth-child(2n+1) {
                clear: left;
            }
        }



        .hovereffect {
            width: 100%;
            height: 100%;
            float: left;
            overflow: hidden;
            position: relative;

            cursor: default;

        }

        .hovereffect .overlay {
            width: 100%;
            height: 100%;
            position: absolute;
            overflow: hidden;
            top: 0;
            left: 0;

        }

        .hovereffect img {
            width: 100%;
            height: 100%;
            display: block;
            position: relative;
            -webkit-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
        }

        .hovereffect:hover img {
            filter: url('data:image/svg+xml;charset=utf-8,<svg xmlns="http://www.w3.org/2000/svg"><filter id="filter"><feColorMatrix type="matrix" color-interpolation-filters="sRGB" values="0.2126 0.7152 0.0722 0 0 0.2126 0.7152 0.0722 0 0 0.2126 0.7152 0.0722 0 0 0 0 0 1 0" /><feGaussianBlur stdDeviation="3" /></filter></svg>#filter');
            filter: grayscale(1) blur(5px);
            -webkit-filter: grayscale(5) blur(10px);
            -webkit-transform: scale(1.1);
            -ms-transform: scale(1.1);
            transform: scale(1.1);
            overflow:hidden;

        }


        .hovereffect h2{

            margin-top: 0px;

            position: relative;
            font-size: 20px;
            padding: 10px;
            background: white;

        }




        .hovereffect a.info:hover {
            background-color: white !important;
            color: black !important;
        }

        .hovereffect a.info, .hovereffect h2 {
            -webkit-transform: scale(0.7);
            -ms-transform: scale(0.7);
            transform: scale(0.7);
            -webkit-transition: all 0.1s ease-in;
            transition: all 0.1s ease-in;
            opacity: 0;
            filter: alpha(opacity=0);
            color: white;
            font-family: 'Proxima';
            text-transform: capitalize;
            padding: 5px;


        }

        .hovereffect h2 {
            color: #1E1D1D;
            line-height: 30px;
        }

        .info {
            font-size: 20px;
            text-decoration: none;
            padding: 7px 14px;
            border: 2px solid #fff;
            margin: 50px 0 0;
            border-radius: 2px;
            background-color: transparent !important;

        }

        .hovereffect:hover a.info, .hovereffect:hover h2 {
            opacity: 1;
            filter: alpha(opacity=100);
            -webkit-transform: scale(1);
            -ms-transform: scale(1);
            transform: scale(1);
        }

        .wallthumb{

            box-shadow: 0 3px 5px rgba(0,0,0,.05);
            width: auto;
            height: auto;

            border-radius: 2px;
            margin-bottom: 30px;

            border: 10px solid white;
            -webkit-box-shadow: 0px 10px 13px -7px #000000, inset 0px 2px 8px 4px rgba(0,0,0,0);
            box-shadow: 0px 10px 13px -7px #000000, inset 0px 2px 8px 4px rgba(0,0,0,0);

        }


    </style>
    <div class="row row-fix" >
        @foreach ($offers as $offer)

            <div class="col-lg-4 col-md-6 col-sm-6" style="">



                        <div class="hovereffect wallthumb">

                            <img class="img-responsive img-fluid center-block" src="@if ($offer->thumbnail){{$offer->thumbnail}}@else /images/empty.png @endif" alt="Read: {{$offer->title}}">
                            <div class="overlay ">
                                <h2>{{$offer->description}}</h2>
                                <center><a class="info" href="/ebook/{{$offer->id}}" target="_blank"><b>Discover</b></a></center>


                            </div>


                        </div>

            </div>

        @endforeach

    </div>

@endsection