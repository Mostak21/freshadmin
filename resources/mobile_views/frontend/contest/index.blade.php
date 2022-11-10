<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="p:domain_verify" content="5861a5107cb561900d2381c36d5c252b"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">

    <title>@yield('meta_title', get_setting('website_name').' | Contest')</title>
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
            background-position: 0% -1.5%;
        }

        .orange-btn{
            background-color: #ea9040;
            border: #ea9040;
        }

        .green-btn{
            background-color: #7bca39;
            border: #ea9040;
        }

        .primary-btn{
            background-color: #be1e2d;
            border: #be1e2d;
        }

        .bg-primary{
            background-color: #be1e2d !important;
            border-color: #be1e2d;
            color: var(--white);
        }

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

        /*fade*/
        .animate {
            opacity: 0;
            transition: all 1s;
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        .animate.active {
            opacity: 1;
            transform: translateX(-50%) translateY(-50%);
        }

        .slide-in-down {
            transform: translateY(-100%) translateX(-50%);
        }

        /*notification*/
        .notification-button {
            position: fixed;
            top: 40px;
            left: 50%;
            padding: 10px 20px;
            background: #343a40;
            color: #eeeeee;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 800;
            box-shadow: 0 0 14px rgba(0, 0, 0, 0.05);
        }



    </style>

</head>

<body>
<section class="text-center mx-0" style="max-width: 720px">
{{--    <div class="row">--}}
        <div class="text-center fs-22">
            <div class="row mx-0">
                <div class="col-2 text-left p-2">
                    <a href="{{ route('home') }}" class="ml-4">
                        <img src="{{Cache::rememberForever('header_logo', function () { return uploaded_asset(get_setting('header_logo')); })}}" height="30px">
                    </a>

                </div>
                <div class="col-10 text-right p-2 ">
                    <a href="{{ route('home') }}/dashboard" class="text-reset">
                        <i class="ci-user fs-16 "></i>

                        @if(Auth::user() && Auth::user()->name==null)
                        <i class="red-dot opacity-80"></i>
                        @endif
                        @if(Auth::user())
                        <span class="fs-14 px-2">{{Auth::user()->name??"Guest(".Auth::user()->id.")"}}</span>
                            <i class="ci-edit-alt fs-14"></i>
                            @else
                            <span class="fs-14 px-2">Login</span>
                        @endif
                    </a>

                    <img class="mr-4" src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/U2X4seURtT5QNyPOHoG7rWOfNtI3CM2m8zr8oHBM.webp" height="40px">
                </div>
            </div>
        </div>
{{--    </div>--}}
    <div class="row mx-0">
        <div class="col px-1">
            <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/mDPM6mETwV2aa67NNfXDbBMgvgfKkFwQQjNvc6tj.webp" style="max-width:100%; max-height:100%;">
        </div>
    </div>
{{--    <div class="row ">--}}
{{--        <div class="col">--}}
            <div class="h3">GUESS & WIN</div>
{{--        </div>--}}
{{--    </div>--}}
    <div class="row GWbackground mx-1" >
        <div class="col px-1">

            @foreach($contests as $key=>$contest)

                <div class="row my-3">
                    <div class="col-5 pl-3 text-right">
                        <button onclick="chooseteam(this)" data-contest="{{$contest->id}}" data-team="{{$contest->team1}}" type="button"
                                class="btn btn-secondary @if(Session::get('contestParticipation') !=null && Session::get('contestParticipation')[$contest->id]['team'] == $contest->team1) green-btn @endif fs-22 text-white orange-btn shadow-md"
                                style="width: 100px; height: 65px;">
                            <span style="font-size: 40px !important; line-height: 80%;">{{$contest->teamOne->image}}</span>
                            <br><span class="fs-9" style="position: relative;top: -15px;">{{$contest->teamOne->name}}</span>
                        </button>
                    </div>
                    <div class="col-2 my-auto text-white"> vs</div>
                    <div class="col-5 pr-3 text-left">
                        <button onclick="chooseteam(this)" data-contest="{{$contest->id}}" data-team="{{$contest->team2}}" type="button"
                                class="btn btn-secondary @if(Session::get('contestParticipation') !=null && Session::get('contestParticipation')[$contest->id]['team'] == $contest->team2) green-btn @endif fs-22 text-white orange-btn shadow-md"
                                style="width: 100px; height: 65px;">
                            <span style="font-size: 40px !important; line-height: 80%;">{{$contest->teamTwo->image}}</span>
                            <br><span class="fs-9" style="position: relative;top: -15px;">{{$contest->teamTwo->name}}</span>
                        </button>
                    </div>
                </div>
            @endforeach

            <div class="row-cols-auto mx-auto py-3">
                <div class="text-center">

                    @if($contests->count())
                        @if(Auth::check())
                            <a href="{{route('contest.submit')}}"><button type="submit" class="btn btn-success fs-18 text-white orange-btn shadow-md">SUBMIT</button></a>

                        @else
                            <button type="button" class="btn btn-success fs-18 text-white orange-btn shadow-md" onclick="showCheckoutModal()">Submit</button>
                        @endif
                    @else
                        <button type="button" class="btn btn-success fs-18 text-white orange-btn shadow-md">Comming Soon</button>
                    @endif

{{--                    <button type="button" class="btn btn-success fs-22 text-white orange-btn shadow-md">Submit</button>--}}
                </div>
            </div>
        </div>
    </div>
</section>

<section class="text-center mx-auto my-5 px-4 py-3" style="max-width: 720px">

    <div class="py-3"> Participate Challenge to Win Final Prize</div>
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

        <sapn class="p-scale p-image" style="left: 22%; "><img @if($goal['target1'] != 25) class="fade-img" @endif src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/j7QWKAFH567MceN2S1D0aJ7KKZ5BIUO1ogKLvrgR.webp" width="50px"></sapn>
        <sapn class="p-scale p-image" style="left: 46%; "><img @if($goal['target2'] != 25) class="fade-img" @endif src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/j7QWKAFH567MceN2S1D0aJ7KKZ5BIUO1ogKLvrgR.webp" width="50px"></sapn>
        <sapn class="p-scale p-image" style="left: 72%; "><img @if($goal['target3'] != 25) class="fade-img" @endif class="fade-img" src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/j7QWKAFH567MceN2S1D0aJ7KKZ5BIUO1ogKLvrgR.webp" width="50px"></sapn>

        <div class="progress-bar bg-primary left-round" role="progressbar" style="width: {{$goal['target1']}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
        <div class="progress-bar bg-primary" role="progressbar" style="width: {{$goal['target2']}}%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
        <div class="progress-bar bg-primary" role="progressbar" style="width: {{$goal['target3']}}%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
        <div class="progress-bar bg-primary right-round" role="progressbar" style="width: {{$goal['target4']}}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
        <span class="text-center my-auto">{{$goal['total']}}</span>
    </div>

    <div class="mt-5">
        <div class="animate slide-in-down notification-button">
            <i class="fa fa-files-o"></i> Link Copied to Clipboard
        </div>
        {{--        <a href="">--}}
        <input type="text"  value="{{ route('contest.refer') }}?u={{$refercode}}" class="fs-20" disabled style="width: 70%;">
        <button type="button" id="copy-refer" class="btn btn-secondary primary-btn text-white shadow-md" title="share and get extra 5 points">SHARE</button>
        {{--        </a>--}}
    </div>

</section>

<section class="text-center mx-auto my-5 px-4" style="max-width: 720px">
    <div class="fs-24 py-4"><span class="fw-800">WEEKLY LEADER BOARD </span><br><span class="fw-100">(TOP 10 | Week-{{$week??""}})</span></div>
    <div class="fs-14">
        <div class="row bg-primary rounded shadow-md">
            <div class="col-4">Name</div>
            <div class="col-2">Guess</div>
            <div class="col-2">Win</div>
            <div class="col-2">Lose</div>
            <div class="col-2">Points</div>
        </div>
        @foreach($leaderboards as $key => $leaderboard)
            @if($leaderboard->participate)
            <div class="row border-1 rounded shadow-md my-1 fs-16 bg-white">
                <div class="col-4 text-truncate">{{$leaderboard->participate->name??"Guest(".$leaderboard->participate->id.")"}}</div>
                <div class="col-2">{{$leaderboard->participation->count()??"null"}}</div>
                <div class="col-2">{{$leaderboard->win}}</div>
                <div class="col-2">{{$leaderboard->loose}}</div>
                <div class="col-2">{{$leaderboard->points}}</div>
            </div>
            @endif
        @endforeach

    </div>


    <div class="my-3">
        <a href="{{route("leaderboard")}}">
        <button type="button" class="btn btn-secondary primary-btn text-white shadow-md">VIEW GRAND LEADER BOARD</button>
        </a>
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
        $.post('{{ route('contest.select.team') }}', {
            _token:'{{ csrf_token() }}',
            contest:el.dataset.contest,
            team:el.dataset.team,
        }, function(data){

            console.log(data);

            if(data == 1){
                AIZ.plugins.notify('success', '{{ translate('Team selected') }}');
                // el.value = data[1];
                $(el).parent().parent().children().children().removeClass('green-btn');
                $(el).addClass('green-btn');
                $(el).removeClass('orange-btn');
                // console.log(data);
            }
        });
    }
    const copyToClipboard = str => {
        const el = document.createElement('textarea');
        el.value = str;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
    };

    const url ='{{ route('contest.refer') }}?u={{$refercode}}';

    var $notificationButton = $('.notification-button');

    document.getElementById('copy-refer').addEventListener('click', function(e){
        let myUrl =  url;
        copyToClipboard( myUrl );
        // alert(myUrl + ' copied to clipboard!')
        $notificationButton.toggleClass('active');
        $notificationButton.on('transitionend', fadeOutNotification);
    });

    function fadeOutNotification(){
        setTimeout(function(){
            $notificationButton.removeClass('active');
        }, 2000);
    }


</script>
<script>
    @foreach (session('flash_notification', collect())->toArray() as $message)
    AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
    @endforeach
</script>


</body>


</html>
