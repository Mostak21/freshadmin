@extends('frontend.layouts.app')

@section('content')
    <section class="gry-bg py-4">
        <div class="profile">
            <div class="container-custom">
                <div class="row">
                    <div class="col-12 mx-auto">
                        <div class="">
                            <div class="text-left pt-2">
                                <h1 class="h4 fw-600">
                                    No account? Sign up
                                </h1>
                            </div>
							<div class="mb-5 fw-400">Registration takes less than a minute but gives you full control over your orders.</div>
							{{-- <div class="px-4 pt-4">
								<span class="fs-18 fw-600"> Or, Login With </span><a class="btn-social bs-facebook me-2 mb-2" href="{{ route('social.login', ['provider' => 'facebook']) }}" ><i class="ci-facebook"></i></a>
							</div> --}}
                            <div class=" py-3 py-lg-4">
                                <div class="">
                                    <form id="reg-form" class="form-default" role="form" action="{{ route('register') }}" method="POST">
                                        @csrf
										<div class="row">
										<div class="col-md-6">
											<div class="form-group">
											<label class="fw-600 m-0">Full Name</label>
                                            <input type="text" class="form-control-custom{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="" name="name">
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div></div>
										<div class="col-md-6">
											 <div class="form-group">
												 <label class="fw-600 m-0">Gender</label>
                                            <select name="gender" id="gender" class="form-control-custom" required>
                                                <option value="NULL" selected hidden>Select your Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

										</div>
										</div>


{{--                                        @if (addon_is_activated('otp_system'))--}}
{{--                                            <div class="form-group phone-form-group mb-1">--}}
{{--												 <label class="fw-600">Phone</label>--}}
{{--                                                <input type="tel" id="phone-code" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">--}}
{{--                                            </div>--}}

{{--                                            <input type="hidden" name="country_code" value="">--}}

{{--                                            <div class="form-group email-form-group mb-1 d-none">--}}
{{--												<label class="fw-600">Email</label>--}}
{{--                                                <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email"  autocomplete="off">--}}
{{--                                                @if ($errors->has('email'))--}}
{{--                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                        <strong>{{ $errors->first('email') }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}

{{--                                            <div class="form-group text-right">--}}
{{--                                                <button class="btn btn-link p-0 opacity-50 text-reset" type="button" onclick="toggleEmailPhone(this)">{{ translate('Use Email Instead') }}</button>--}}
{{--                                            </div>--}}
{{--                                        @else--}}
{{--                                            <div class="form-group">--}}
{{--												 <label class="fw-600">Email</label>--}}
{{--                                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="" name="email">--}}
{{--                                                @if ($errors->has('email'))--}}
{{--                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                        <strong>{{ $errors->first('email') }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        @endif--}}

                                        <div class="form-group">
                                             <label class="fw-600 m-0">Email or Phone</label>
                                            <input type="text" class="form-control-custom{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="" name="email">
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="row">
											<div class="col-md-6">
												 <div class="form-group">
													 <label class="fw-600 m-0">Password</label>
                                            <input type="password" class="form-control-custom{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="" name="password">
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
											</div>
											<div class="col-md-6">
												 <div class="form-group">
													 <label class="fw-600 m-0">Confirm Password</label>
                                            <input type="password" class="form-control-custom" placeholder="" name="password_confirmation">
                                        </div>
											</div>

										</div>




                                        @if(get_setting('google_recaptcha') == 1)
                                            <div class="form-group">
                                                <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label class="rit-checkbox">
                                                <input type="checkbox" name="checkbox_example_1" required>
                                                <span class=opacity-60>{{ translate('By signing up you agree to our terms and conditions.')}}</span>
                                                <span class="rit-square-check"></span>
                                            </label>
                                        </div>

                                        <div class="mb-2 text-right">
                                            <button type="submit" class="btn btn-block btn-primary  fw-600"><i class="ci-user pr-2 ms-n1"></i>{{  translate('Create Account') }}</button>
                                        </div>
                                    </form>
                                    <div class="separator mb-2">
                                        <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                                    </div>
                                    <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn-soft-dark facebook text-light btn btn-block mb-3">
                                        <i class="lab la-facebook-f"></i> Facebook
                                    </a>
									{{--
                                    @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1)
                                        <div class="separator mb-3">
                                            <span class="bg-white px-3 opacity-60">{{ translate('Or Join With')}}</span>
                                        </div>
                                        <ul class="list-inline social colored text-center mb-5">
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
                                    @endif--}}
                                </div>
                               {{-- <div class="text-center">
                                    <p class="text-muted mb-0">{{ translate('Already have an account?')}}</p>
                                    <a href="{{ route('user.login') }}">{{ translate('Log In')}}</a>
                                </div>--}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
    @if(get_setting('google_recaptcha') == 1)
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

    <script type="text/javascript">

        @if(get_setting('google_recaptcha') == 1)
        // making the CAPTCHA  a required field for form submission
        $(document).ready(function(){
            // alert('helloman');
            $("#reg-form").on("submit", function(evt)
            {
                var response = grecaptcha.getResponse();
                if(response.length == 0)
                {
                //reCaptcha not verified
                    alert("please verify you are humann!");
                    evt.preventDefault();
                    return false;
                }
                //captcha verified
                //do the rest of your validations here
                $("#reg-form").submit();
            });
        });
        @endif

        var isPhoneShown = true,
            countryData = window.intlTelInputGlobals.getCountryData(),
            input = document.querySelector("#phone-code");

        for (var i = 0; i < countryData.length; i++) {
            var country = countryData[i];
            if(country.iso2 == 'bd'){
                country.dialCode = '88';
            }
        }

        var iti = intlTelInput(input, {
            separateDialCode: true,
            utilsScript: "{{ static_asset('assets/js/intlTelutils.js') }}?1590403638580",
            onlyCountries: @php echo json_encode(\App\Models\Country::where('status', 1)->pluck('code')->toArray()) @endphp,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                if(selectedCountryData.iso2 == 'bd'){
                    return "01xxxxxxxxx";
                }
                return selectedCountryPlaceholder;
            }
        });

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

        input.addEventListener("countrychange", function(e) {
            // var currentMask = e.currentTarget.placeholder;

            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);

        });

        function toggleEmailPhone(el){
            if(isPhoneShown){
                $('.phone-form-group').addClass('d-none');
                $('.email-form-group').removeClass('d-none');
                isPhoneShown = false;
                $(el).html('{{ translate('Use Phone Instead') }}');
            }
            else{
                $('.phone-form-group').removeClass('d-none');
                $('.email-form-group').addClass('d-none');
                isPhoneShown = true;
                $(el).html('{{ translate('Use Email Instead') }}');
            }
        }
    </script>
@endsection
