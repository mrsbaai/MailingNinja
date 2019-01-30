
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

        .img-responsive {
            margin-bottom:30px;
        }

        .hovereffect {
            width: 100%;
            height: 100%;
            float: left;
            overflow: hidden;
            position: relative;
            text-align: center;
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
            -webkit-transition: all 0.4s ease-in;
            transition: all 0.4s ease-in;
        }

        .hovereffect:hover img {
            filter: url('data:image/svg+xml;charset=utf-8,<svg xmlns="http://www.w3.org/2000/svg"><filter id="filter"><feColorMatrix type="matrix" color-interpolation-filters="sRGB" values="0.2126 0.7152 0.0722 0 0 0.2126 0.7152 0.0722 0 0 0.2126 0.7152 0.0722 0 0 0 0 0 1 0" /><feGaussianBlur stdDeviation="3" /></filter></svg>#filter');
            filter: grayscale(1) blur(3px);
            -webkit-filter: grayscale(1) blur(3px);
            -webkit-transform: scale(1.1);
            -ms-transform: scale(1.1);
            transform: scale(1.1);
            margin: -1px;
        }


        .hovereffect h2{
            text-transform: capitalize;
            text-align: center;
            position: relative;
            font-size: 17px;
            padding: 10px;
            background: rgba(0, 0, 0, 0.6);
            font-color: white;
        }




        .hovereffect a.info:hover {
            box-shadow: 0 0 5px #fff;
        }

        .hovereffect a.info, .hovereffect h2 {
            -webkit-transform: scale(0.7);
            -ms-transform: scale(0.7);
            transform: scale(0.7);
            -webkit-transition: all 0.4s ease-in;
            transition: all 0.4s ease-in;
            opacity: 0;
            filter: alpha(opacity=0);
            color: #fff;
            text-transform: uppercase;
            padding: 5px;


        }

        .info {

            text-decoration: none;
            padding: 7px 14px;
            border: 1px solid #fff;
            margin: 50px 0 0;
            border-radius: 0;
            background-color: transparent !important;

        }

        .hovereffect:hover a.info, .hovereffect:hover h2 {
            opacity: 1;
            filter: alpha(opacity=100);
            -webkit-transform: scale(1);
            -ms-transform: scale(1);
            transform: scale(1);
        }
    </style>
    <div class="row row-fix" >
        @foreach ($offers as $offer)

            <div class="col-lg-4 col-md-6 col-sm-6" style="">
                <a href="/ebook/{{$offer->id}}" target="_blank">

                    <div class="hovereffect">

                        <img class="img-responsive img-fluid img-thumbnail center-block" src="@if ($offer->thumbnail){{$offer->thumbnail}}@else /images/empty.png @endif" alt="Read: {{$offer->title}}">
                        <div class="overlay ">
                            <h2>{{$offer->title}}:<br/>
                                <span style="font-size: 80%">{{$offer->subtitle}}</span><br/>

                            </h2>
                            <h2>
                                <span style="font-size: 70%">{{$offer->description}}</span>
                            </h2>

                            <a class="info" href="/ebook/{{$offer->id}}" target="_blank">Discover</a>
                        </div>

                    </div>
                </a>
            </div>

        @endforeach

    </div>

@endsection