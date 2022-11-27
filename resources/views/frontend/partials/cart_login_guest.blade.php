
@if(isset($user) && $user->password != null && !password_verify(null, $user->password))
<div class="p-3">
    <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
        @csrf
        <p>Hello, <b>{{$user->name}}</b> enter password to continue </p>
        <div class="form-group d-none">
            <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $user->email??$user->phone??old('email') }}" placeholder="{{  translate('Email or phone') }}" name="email" id="email" autocomplete="off">
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
                <div class="form-group input-group">
                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ translate('Password')}}" name="password" id="password" value="{{ old('password') }}">
                    <div class="input-group-append">
                        <button class="btn form-control" type="button" onclick="showPassword()"><i class="ci-eye-off text-secondary"  id="npass"></i></button>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-6">
                        <label class="rit-checkbox">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class=opacity-60>{{  translate('Remember Me') }}</span>
                            <span class="rit-square-check"></span>
                        </label>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">{{ translate('Forgot password?')}}</a>
                    </div>
                </div>

        <div class="mb-5">
                <input type="submit" class="btn btn-primary fw-600" value="{{  translate('Login') }}">
{{--            <button type="button" class="btn btn-primary fw-600 btn-mright" onclick="guestLogin()" style="width: 100%!important;">{{ translate('Next')}} <i class="ci-arrow-right fw-600 pl-2"></i></button>--}}
        </div>
    </form>

</div>


@elseif(isset($registration) && $registration->errors)


    <div class="p-3">
        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
            @csrf
            <p>Enter phone number or email to continue</p>
            <div class="form-group">
                <input type="text" class="form-control{{ $registration->errors ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email or phone') }}" name="email" id="email" autocomplete="off">
                @if ($registration->errors)
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $registration->errors }}</strong>
                                        </span>
                @endif
            </div>
            <div class="mb-5">
                <button type="button" id="guestbutton" class="btn btn-primary fw-600 btn-mright" onclick="guestLogin()" style="width: 100%!important;">{{ translate('Next')}} <i class="ci-arrow-right fw-600 pl-2"></i></button>
            </div>
        </form>

    </div>





{{--@elseif(isset($user) && $user->password != null && password_verify(null, $user->password) && $user->email_verified_at != null)--}}

{{--    <div class="p-3">--}}
{{--        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">--}}
{{--            @csrf--}}
{{--            <p>Hello,User enter <b title="One Time Password. Check your email or phone...">OTP</b> to continue</p>--}}
{{--            <div class="form-group d-none">--}}
{{--                <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $user->email??$user->phone??old('email')??'' }}" placeholder="{{  translate('Email or phone') }}" name="email" id="email" autocomplete="off">--}}
{{--                @if ($errors->has('email'))--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                    <strong>{{ $errors->first('email') }}</strong>--}}
{{--                </span>--}}
{{--                @endif--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <input type="number" class="form-control{{ $errors->has('OTP') ? ' is-invalid' : '' }}" value="{{ old('OTP') }}" placeholder="{{  translate('OTP') }}" name="OTP" id="OTP" autocomplete="off" autofocus>--}}
{{--                @if ($errors->has('email'))--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                    <strong>{{ $errors->first('email') }}</strong>--}}
{{--                </span>--}}
{{--                @endif--}}
{{--            </div>--}}

{{--            <div class="mb-5">--}}
{{--                --}}{{--            <input type="submit" class="btn btn-primary fw-600" value="{{  translate('Login') }}" style="width: 100%!important;">--}}

{{--                <button type="submit" class="btn btn-primary fw-600 btn-mright" style="width: 100%!important;">{{ translate('Next')}} <i class="ci-arrow-right fw-600 pl-2"></i></button>--}}
{{--            </div>--}}
{{--        </form>--}}

{{--        @if($user->phone != null)--}}
{{--            <a href="https://localhost/httpdocs/verification/phone/code/resend" onclick="OTPresend()" class="btn btn-link">Resend Code</a>--}}
{{--        @endif--}}

{{--    </div>--}}







@else
    <div class="p-3">
    <form class="form-default" role="form" action="{{ route('verification.submit') }}" method="POST">
        @csrf
        <p>Hello,User enter <b title="One Time Password. Check your email or phone...">OTP</b> to continue</p>
        <div class="form-group d-none">
            <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $user->email??$user->phone??old('email')??'' }}" placeholder="{{  translate('Email or phone') }}" name="email" id="email" autocomplete="off">
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <input type="number" class="form-control{{ $errors->has('OTP') ? ' is-invalid' : '' }}" value="{{ old('OTP') }}" placeholder="{{  translate('OTP') }}" name="verification_code" id="OTP" autocomplete="off" autofocus>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="mb-5">
{{--            <input type="submit" class="btn btn-primary fw-600" value="{{  translate('Login') }}" style="width: 100%!important;">--}}

            <button type="submit" class="btn btn-primary fw-600 btn-mright" style="width: 100%!important;">{{ translate('Next')}} <i class="ci-arrow-right fw-600 pl-2"></i></button>
        </div>
    </form>

        @if($user->phone != null)
            <a href="#" onclick="OTPresend()" class="btn btn-link">Resend Code</a>
        @endif

    </div>

@endif

<script>
    function OTPresend(){
        $.get('{{ route('verification.phone.resend') }}', {
            _token   :  RIT.data.csrf
        },
        function () {
            RIT.plugins.notify('success', '{{ translate('OTP send successfully') }}');
        });
    }
</script>
