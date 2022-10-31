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
    <div class="row">
        <div class="col text-center fs-22">
            <div class="row">
                <div class="col text-left m-3">
                    <a href="{{ route('home') }}">
                        <img src="{{Cache::rememberForever('header_logo', function () { return uploaded_asset(get_setting('header_logo')); })}}" height="30px">
                    </a>

                </div>
                <div class="col text-right m-3">
                    <a href="{{ route('home') }}/dashboard">
                        <i class="ci-user fs-22 "></i>
                        <span class="fs-16 px-3">{{Auth::user()->name??""}}</span>
                    </a>

                    <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/U2X4seURtT5QNyPOHoG7rWOfNtI3CM2m8zr8oHBM.webp" height="40px">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col px-0">
            <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/PA2d09lzEG9IGZqc9k4wrt0FEq3r1MJ1rHhnHSv7.png" style="max-width:100%; max-height:100%;">
        </div>
    </div>
    <div class="row ">
        <div class="col">
            <div class="h1">GUESS & WIN</div>
        </div>
    </div>
    <div class="row GWbackground" >
        <div class="col">

            @foreach($contests as $key=>$contest)
                <div class="row mt-4 p-2">
                    <div class="col-5 pl-3 text-right">
                        <button onclick="chooseteam(this)" data-contest="{{$contest->id}}" data-team="{{$contest->team1}}" type="button" class="btn btn-secondary fs-24 text-white orange-btn shadow-md lh-1" style="width: 100px; height: 65px;">
                            <span style="font-size: 40px !important; line-height: 80%;">{{$contest->teamOne->image}}</span>
                            <br><span class="fs-9" style="position: relative;top: -15px;">{{$contest->teamOne->name}}</span>
                        </button>
                    </div>
                    <div class="col-2 my-auto text-white"> vs</div>
                    <div class="col-5 pr-3 text-left">
                        <button onclick="chooseteam(this)" data-contest="{{$contest->id}}" data-team="{{$contest->team2}}" type="button" class="btn btn-secondary fs-24 text-white orange-btn shadow-md lh-1" style="width: 100px; height: 65px;">
                            <span style="font-size: 40px !important; line-height: 80%;">{{$contest->teamTwo->image}}</span>
                            <br><span class="fs-9" style="position: relative;top: -15px;">{{$contest->teamTwo->name}}</span>
                        </button>
                    </div>
                </div>
            @endforeach

            <div class="row-cols-auto mx-auto py-3">
                <div class="text-center">

                    @if(Auth::check())
                        {{-- <a href="{{ route('checkout.shipping_info') }}" class="btn btn-primary fw-600 btn-mright">
                            {{ translate('Continue to Shipping')}}<i class="ci-arrow-right mt-sm-0 ms-1"></i>
                        </a> --}}
                        <button type="submit" class="btn btn-success fs-18 text-white orange-btn shadow-md">SUBMIT</button>

                    @else
                        <button type="button" class="btn btn-success fs-18 text-white orange-btn shadow-md" onclick="showCheckoutModal()">Submit</button>
                    @endif



{{--                    <button type="button" class="btn btn-success fs-18 text-white orange-btn shadow-md">Submit</button>--}}
                </div>
            </div>
        </div>
    </div>
</section>

<section class="text-center mx-auto my-5 px-2 py-3" style="max-width: 720px">

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

<section class="text-center mx-auto my-5" style="max-width: 720px">
    <div class="fs-24 py-4"><span class="fw-800">WEEKLY LEADER BOARD </span><span class="fw-100">(TOP 10)</span></div>
    <div class="row bg-primary rounded shadow-md">
        <div class="col">Name</div>
        <div class="col">Participate</div>
        <div class="col">Win</div>
        <div class="col">Lose</div>
        <div class="col">Points</div>
    </div>
    <div class="row border-1 rounded shadow-md my-1 bg-white">
        <div class="col">Ruhul amin</div>
        <div class="col">10</div>
        <div class="col">7</div>
        <div class="col">3</div>
        <div class="col">300</div>
    </div>
    <div class="row border-1 rounded shadow-md my-1 bg-white">
        <div class="col">Ruhul amin</div>
        <div class="col">10</div>
        <div class="col">7</div>
        <div class="col">3</div>
        <div class="col">300</div>
    </div>
    <div class="row border-1 rounded shadow-md my-1 bg-white">
        <div class="col">Ruhul amin</div>
        <div class="col">10</div>
        <div class="col">7</div>
        <div class="col">3</div>
        <div class="col">300</div>
    </div>
    <div class="row border-1 rounded shadow-md my-1 bg-white">
        <div class="col">Ruhul amin</div>
        <div class="col">10</div>
        <div class="col">7</div>
        <div class="col">3</div>
        <div class="col">300</div>
    </div>
    <div class="row border-1 rounded shadow-md my-1 bg-white">
        <div class="col">Ruhul amin</div>
        <div class="col">10</div>
        <div class="col">7</div>
        <div class="col">3</div>
        <div class="col">300</div>
    </div>
    <div class="row border-1 rounded shadow-md my-1 bg-white">
        <div class="col">Ruhul amin</div>
        <div class="col">10</div>
        <div class="col">7</div>
        <div class="col">3</div>
        <div class="col">300</div>
    </div>

    <div class="my-3">
        <button type="button" class="btn btn-secondary primary-btn text-white shadow-md">VIEW GRAND LEADER BOARD</button>
    </div>
</section>




{{--@section('modal')--}}
    <div class="modal fade" id="login-modal">
        <div class="modal-dialog modal-dialog-zoom">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600">{{ translate('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <section id="cart-login-guest">
                        <div class="p-3">
                            <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                                @csrf
                                <p>Enter phone number or email to continue</p>

                                <div class="form-group">
                                    <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email or phone') }}" name="email" id="email" autocomplete="off">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="mb-5">
                                    {{--                                <input type="submit" class="btn btn-primary fw-600" value="{{  translate('Login') }}">--}}
                                    <button type="button" id="guestbutton" class="btn btn-primary fw-600 btn-mright" onclick="guestLogin()" style="width: 100%!important;">{{ translate('Next')}} <i class="ci-arrow-right fw-600 pl-2"></i></button>
                                </div>
                            </form>

                        </div>
                    </section>
{{--                    <div class="text-center mb-3">--}}
{{--                        <p class="text-muted mb-0">{{ translate('Dont have an account?')}}</p>--}}
{{--                        <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a>--}}
{{--                    </div>--}}
                    @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1)
                        <div class="separator mb-3">
                            <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                        </div>
                        <ul class="list-inline social colored text-center mb-3">
                            @if (get_setting('facebook_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                        <i class="lab la-facebook-f"></i>
                                    </a>
                                </li>
                            @endif
                            @if(get_setting('google_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                        <i class="lab la-google"></i>
                                    </a>
                                </li>
                            @endif
                            @if (get_setting('twitter_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                        <i class="lab la-twitter"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
{{--@endsection--}}
<script>
    var AIZ = AIZ || {};
    AIZ.local = {
        nothing_selected: 'Nothing selected',
        nothing_found: 'Nothing found',
        choose_file: 'Choose file',
        file_selected: 'File selected',
        files_selected: 'Files selected',
        add_more_files: 'Add more files',
        adding_more_files: 'Adding more files',
        drop_files_here_paste_or: 'Drop files here, paste or',
        browse: 'Browse',
        upload_complete: 'Upload complete',
        upload_paused: 'Upload paused',
        resume_upload: 'Resume upload',
        pause_upload: 'Pause upload',
        retry_upload: 'Retry upload',
        cancel_upload: 'Cancel upload',
        uploading: 'Uploading',
        processing: 'Processing',
        complete: 'Complete',
        file: 'File',
        files: 'Files',
    }
</script>
<script src="{{ static_asset('assets/js/vendors.js') }}"></script>
<script src="{{ static_asset('assets/js/aiz-core.js') }}"></script>
<script>
    function showCheckoutModal(){
        $('#login-modal').modal();
    }
    function guestLogin(){
        $.post('{{ route('cart.login.guest') }}', {
            _token   :  AIZ.data.csrf,
            // id       :  key,
            email :  document.getElementById("email").value
        }, function(data){

            // updateNavCart(data.nav_cart_view,data.cart_count);
            $('#cart-login-guest').html(data);
            console.log(data);
        });
    }

    function chooseteam(el) {

        $.post('{{ route('select.team') }}', {
            _token:'{{ csrf_token() }}',
            contest:el.dataset.contest,
            team:el.dataset.team,
            }, function(data){

            console.log(data);

            {{--if(data == 1){--}}
            {{--    AIZ.plugins.notify('success', '{{ translate('Shipping Agent status updated successfully') }}');--}}
            {{--    el.value = data[1];--}}
            {{--    console.log(data);--}}
            {{--}--}}
            {{--else{--}}
            {{--    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');--}}
            {{--    console.log(data);--}}
            {{--}--}}

        });

    }
</script>


</body>


</html>
