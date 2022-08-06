@extends('frontend.layouts.app')

@section('content')
    <section class="py-5">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-12 ">
                        <div class="">
                            <div class="text-left  pt-4">
                                <h1 class="h4 fw-600">
                                    Wellcome
                                </h1>
                            </div>
					<div class=" pt-3 mb-5">
					<span class="fs-16 fw-600"> Please Login or <a class="text-danger" href="{{ route('user.registration') }}">Sign up</a> to continue </span>
						
							</div>
							
                            <div class=" py-3 py-lg-4">
                                <div class="">
                                    <form class="form-default" role="form" action="{{ route('login') }}" method="POST">
                                        @csrf

                                    

                                        <div class="form-group">
                                            <label class="fw-600 m-0">User ID</label>
                                            <input type="text" class="form-control-custom {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email or phone') }}" name="email" id="email" autocomplete="off">
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <label class="fw-600 m-0">Password</label>
                                        <div class="form-group input-group">
                                            <input type="password" class="form-control-custom {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ translate('Password')}}" name="password" id="password" value="{{ old('password') }}">
                                          
                                        </div>

                                        <div class="row mb-3 mt-5">
                                            <div class="col-6">
                                                <label class="aiz-checkbox m-0">
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <span class=opacity-60>{{  translate('Remember Me') }}</span>
                                                    <span class="aiz-square-check"></span>
                                                </label>
                                            </div>
                                            <div class="col-6 text-right">
                                                <a href="{{ route('password.request') }}" class="text-primary  fs-14">
													 {{ translate('Forgot password?')}}</a>
                                            </div>
                                        </div>
								<div class="row">
									{{-- <div class="col-7">
										<div class="">
                                    <p class="text-muted mb-0">{{ translate('Dont have an account?')}}</p>
                                    <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a>
                                </div>

									</div> --}}
                                        <div class=" col-12 mb-2 text-right">
                                            <button type="submit" class="btn btn-primary btn-block rounded-custom fw-600"> <i class="ci-sign-in pr-2 ms-n21"></i> {{  translate('Login') }}</button>
									</div></div>
                                    </form>
                                    <div class="separator mb-2">
                                        <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                                    </div>
                                    <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn-soft-dark facebook text-light btn btn-block ">
                                        <i class="lab la-facebook-f"></i> Facebook
                                    </a>
{{--
                                    @if (env("DEMO_MODE") == "On")
                                        <div class="mb-5">
                                            <table class="table table-bordered mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>{{ translate('Seller Account')}}</td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm" onclick="autoFillSeller()">{{ translate('Copy credentials') }}</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ translate('Customer Account')}}</td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm" onclick="autoFillCustomer()">{{ translate('Copy credentials') }}</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ translate('Delivery Boy Account')}}</td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm" onclick="autoFillDeliveryBoy()">{{ translate('Copy credentials') }}</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                    @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1)
                                        <div class="separator mb-3">
                                            <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
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
                                    <p class="text-muted mb-0">{{ translate('Dont have an account?')}}</p>
                                    <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a>
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
    <script type="text/javascript">

        function myFunction() {
            var x = document.getElementById("password");
            var ico = document.getElementById("npass");
            if (x.type === "password") {
                x.type = "text";
                ico.classList.remove("ci-eye-off");
                ico.classList.add("ci-eye");

            } else {
                x.type = "password";
                ico.classList.remove("ci-eye");
                ico.classList.add("ci-eye-off");
            }
        }
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
                $('input[name=phone]').val(null);
                isPhoneShown = false;
                $(el).html('{{ translate('Use Phone Instead') }}');
            }
            else{
                $('.phone-form-group').removeClass('d-none');
                $('.email-form-group').addClass('d-none');
                $('input[name=email]').val(null);
                isPhoneShown = true;
                $(el).html('{{ translate('Use Email Instead') }}');
            }
        }



        function autoFillSeller(){
            $('#email').val('seller@example.com');
            $('#password').val('123456');
        }
        function autoFillCustomer(){
            $('#email').val('customer@example.com');
            $('#password').val('123456');
        }
        function autoFillDeliveryBoy(){
            $('#email').val('deliveryboy@example.com');
            $('#password').val('123456');
        }
    </script>
@endsection
