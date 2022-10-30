<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="p:domain_verify" content="5861a5107cb561900d2381c36d5c252b"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">

    <title>@yield('meta_title', get_setting('website_name').' | '.get_setting('site_motto'))</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="@yield('meta_description', get_setting('meta_description') )" />
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords') )">
    <link rel="icon" href="{{ Cache::rememberForever('site_icon', function () { return uploaded_asset(get_setting('site_icon')); }) }}">
    <script src="https://kit.fontawesome.com/103bf7be9c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Rubik:wght@100;200;300;400;500;600;700;800;900&display=swap">
    <link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ static_asset('assets/css/custom-style.css') }}">

    <style>
        body{
            font-size: 20px;
            margin: auto;
        }
        .GWbackground{
            background-image: url("https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/He4rP8yAALQ8es2Y30kG8gCOfBUbkqXVDWlt4BNa.svg");
            background-size: contain;
            background-repeat: no-repeat;
            background-color: #be1e2d;
            background-position: 0% -0.22%;
        }
        /*.eclips-shape{*/
        /*    border-radius: 50% / 0 0 100% 100%;*/
        /*    background-color: white;*/
        /*    height: 2%;*/
        /*    z-index: 0;*/
        /*}*/
        .orange-btn{
            background-color: #ea9040;
            border: #ea9040;
            /*box-shadow: 0 4px 6px -1px rgb(0 0 0 / 10%), 0 2px 4px -1px rgb(0 0 0 / 6%) !important;*/
            /*border-top: 1px solid #f1f1f1!important;*/
        }

        .primary-btn{
            background-color: #be1e2d;
            border: #be1e2d;
            /*box-shadow: 0 4px 6px -1px rgb(0 0 0 / 10%), 0 2px 4px -1px rgb(0 0 0 / 6%) !important;*/
            /*border-top: 1px solid #f1f1f1!important;*/
        }

        .bg-primary{
            background-color: #be1e2d !important;
            border-color: #be1e2d;
            color: var(--white);
        }
        /*.bg-primary:hover{*/
        /*    background-color: #78181E !important;*/
        /*    border-color: #78181e !important;*/
        /*    color: var(--white);*/
        /*}*/
        .p-scale{
            position: relative;
            z-index: 1;
            width: 0px;
            font-size: x-large;
            line-height: normal;
            /*color: var(--white);*/
            /*overflow: visible;*/
        }
        .p-number{
            top:25px;
            z-index: 2;
            font-size: 18px;
        }
        .p-image{
            bottom:50px;
            z-index: 2;
        }
        .left-round{
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
        }
        .right-round{
            border-top-right-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
        }

        .fade-img{
            -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
            filter: grayscale(100%);
            opacity: 0.4;
        }


    </style>

</head>
<body>
<section class="text-center mx-auto" style="max-width: 720px">
{{--    <div class="row">--}}
        <div class="text-center fs-22">
            <div class="row">
                <div class="col-2 text-left p-2">
                    <a href="{{ route('home') }}" class="ml-4">
                        <img src="{{Cache::rememberForever('header_logo', function () { return uploaded_asset(get_setting('header_logo')); })}}" height="30px">
                    </a>

                </div>
                <div class="col-10 text-right p-2">
                    <i class="ci-user fs-16 "></i>
                    <span class="fs-14 px-2">RUHUL AMIN</span>
                    <img class="mr-4" src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/U2X4seURtT5QNyPOHoG7rWOfNtI3CM2m8zr8oHBM.webp" height="40px">
                </div>
            </div>
        </div>
{{--    </div>--}}
    <div class="row">
        <div class="col px-0">
            <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/PA2d09lzEG9IGZqc9k4wrt0FEq3r1MJ1rHhnHSv7.png" style="max-width:100%; max-height:100%;">
        </div>
    </div>
    <div class="row ">
        <div class="col">
            <div class="h3">GUESS & WIN</div>
        </div>
    </div>
    <div class="row GWbackground" >

        <div class="col">
{{--            <div class="eclips-shape"></div>--}}
            <div class="row my-3">
                <div class="col-5 pl-3 text-right">
                    <button type="button" class="btn btn-secondary fs-22 text-white orange-btn shadow-md">Team 1</button>
                </div>
                <div class="col-2 my-auto text-white"> vs</div>
                <div class="col-5 pr-3 text-left">
                    <button type="button" class="btn btn-secondary fs-22 text-white orange-btn shadow-md">Team 2</button>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-5 pl-3 text-right">
                    <button type="button" class="btn btn-secondary fs-22 text-white orange-btn shadow-md">Team 3</button>
                </div>
                <div class="col-2 my-auto text-white"> vs</div>
                <div class="col-5 pr-3 text-left">
                    <button type="button" class="btn btn-secondary fs-22 text-white orange-btn shadow-md">Team 4</button>
                </div>
            </div>
            <div class="row-cols-auto mx-auto py-3">
                <div class="text-center">
                    <button type="button" class="btn btn-success fs-22 text-white orange-btn shadow-md">Submit</button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="text-center mx-auto my-5 px-4 py-3" style="max-width: 720px">

    <div class="py-3"> Participate Challenge to Win Final Price</div>
    {{--    <div class="progress">--}}
    {{--        <div class="progress-bar bg-primary" role="progressbar" style="width: 10%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--    </div>--}}

    <div class="progress mt-5" style="overflow: visible;">
        {{--        <sapn class="p-scale" style="left: 0%">|</sapn>--}}
        <sapn class="p-scale" style="left: 24.6%">|</sapn>
        <sapn class="p-scale" style="left: 49.6%">|</sapn>
        <sapn class="p-scale" style="left: 74.6%">|</sapn>

        <sapn class="p-scale p-number" style="left: 22%; ">100</sapn>
        <sapn class="p-scale p-number" style="left: 46%;">1,000</sapn>
        <sapn class="p-scale p-number" style="left: 70%;">10,000</sapn>

        <sapn class="p-scale p-image" style="left: 22%; "><img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/j7QWKAFH567MceN2S1D0aJ7KKZ5BIUO1ogKLvrgR.webp" width="50px"></sapn>
        <sapn class="p-scale p-image" style="left: 46%; "><img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/j7QWKAFH567MceN2S1D0aJ7KKZ5BIUO1ogKLvrgR.webp" width="50px"></sapn>
        <sapn class="p-scale p-image" style="left: 72%; "><img class="fade-img" src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/j7QWKAFH567MceN2S1D0aJ7KKZ5BIUO1ogKLvrgR.webp" width="50px"></sapn>

        <div class="progress-bar bg-primary left-round" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
        <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
        <div class="progress-bar bg-primary right-round" role="progressbar" style="width: 10%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    {{--    <div class="progress">--}}
    {{--        <sapn class="p-scale" style="left: 24.6%">1000</sapn>--}}
    {{--        <sapn class="p-scale" style="left: 49.6%">10k</sapn>--}}
    {{--        <sapn class="p-scale" style="left: 74.6%">100k</sapn>--}}
    {{--    </div>--}}
</section>

<section class="text-center mx-auto my-5 px-4" style="max-width: 720px">
    <div class="fs-24 py-4"><span class="fw-800">WEEKLY LEADER BOARD </span><br><span class="fw-100">(TOP 10)</span></div>
    <div class="fs-14">
        <div class="row bg-primary rounded shadow-md">
            <div class="col-4">Name</div>
            <div class="col-2">Guess</div>
            <div class="col-2">Win</div>
            <div class="col-2">Lose</div>
            <div class="col-2">Points</div>
        </div>
        <div class="row border-1 rounded shadow-md my-1 bg-white">
            <div class="col-4">Ruhul amin</div>
            <div class="col-2">10</div>
            <div class="col-2">7</div>
            <div class="col-2">3</div>
            <div class="col-2">300</div>
        </div>
        <div class="row border-1 rounded shadow-md my-1 bg-white">
            <div class="col-4">Ruhul amin</div>
            <div class="col-2">10</div>
            <div class="col-2">7</div>
            <div class="col-2">3</div>
            <div class="col-2">300</div>
        </div>
        <div class="row border-1 rounded shadow-md my-1 bg-white">
            <div class="col-4">Ruhul amin</div>
            <div class="col-2">10</div>
            <div class="col-2">7</div>
            <div class="col-2">3</div>
            <div class="col-2">300</div>
        </div>
        <div class="row border-1 rounded shadow-md my-1 bg-white">
            <div class="col-4">Ruhul amin</div>
            <div class="col-2">10</div>
            <div class="col-2">7</div>
            <div class="col-2">3</div>
            <div class="col-2">300</div>
        </div>
        <div class="row border-1 rounded shadow-md my-1 bg-white">
            <div class="col-4">Ruhul amin</div>
            <div class="col-2">10</div>
            <div class="col-2">7</div>
            <div class="col-2">3</div>
            <div class="col-2">300</div>
        </div>
        <div class="row border-1 rounded shadow-md my-1 bg-white">
            <div class="col-4">Ruhul amin</div>
            <div class="col-2">10</div>
            <div class="col-2">7</div>
            <div class="col-2">3</div>
            <div class="col-2">300</div>
        </div>
        <div class="row border-1 rounded shadow-md my-1 bg-white">
            <div class="col-4">Ruhul amin</div>
            <div class="col-2">10</div>
            <div class="col-2">7</div>
            <div class="col-2">3</div>
            <div class="col-2">300</div>
        </div>
        <div class="row border-1 rounded shadow-md my-1 bg-white">
            <div class="col-4">Ruhul amin</div>
            <div class="col-2">10</div>
            <div class="col-2">7</div>
            <div class="col-2">3</div>
            <div class="col-2">300</div>
        </div>
        <div class="row border-1 rounded shadow-md my-1 bg-white">
            <div class="col-4">Ruhul amin</div>
            <div class="col-2">10</div>
            <div class="col-2">7</div>
            <div class="col-2">3</div>
            <div class="col-2">300</div>
        </div>
        <div class="row border-1 rounded shadow-md my-1 bg-white">
            <div class="col-4">Ruhul amin</div>
            <div class="col-2">10</div>
            <div class="col-2">7</div>
            <div class="col-2">3</div>
            <div class="col-2">300</div>
        </div>

    </div>


    <div class="my-3">
        <button type="button" class="btn btn-secondary primary-btn text-white shadow-md">VIEW GRAND LEADER BOARD</button>
    </div>
</section>


</body>


</html>
