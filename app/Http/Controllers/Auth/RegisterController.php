<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Customer;
use App\Models\Cart;
use App\Models\BusinessSetting;
use App\OtpConfiguration;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OTPVerificationController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Cookie;
use Session;
use Nexmo;
use Twilio\Rest\Client;

use App\Http\Controllers\AWSPersonalizeController;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if (is_numeric($data['email'])){
            return Validator::make($data, [
            'name' => 'required|string|max:255|regex:/^[\x{0980}-\x{09FF}_A-Za-z0-9. -]+$/u',
            'password' => 'required|string|min:6|confirmed',
            'email' => ['required','regex:/^(\+8801|01)[0-9]{9}$/'],

        ],
        [
            'email.regex' => 'Please enter valid BD phone number',
        ]);
        }
        else{
            return Validator::make($data, [
            'name' => 'required|string|max:255|regex:/^[\x{0980}-\x{09FF}_A-Za-z0-9. -]+$/u',
            'password' => 'required|string|min:6|confirmed',
            'email' => 'required|email',
        ],
        [
            'email.required' => 'Please enter valid email address',
        ]);
        }
    }

    protected function guestValidator(array $data)
    {
        if (is_numeric($data['email'])){
            return Validator::make($data, [
                'email' => ['required','regex:/^(\+8801|01)[0-9]{9}$/'],
            ],
                [
                    'email.regex' => 'Please enter valid BD phone number',
                ]);
        }
        else{
            return Validator::make($data, [
                'email' => 'required|email',
            ],
                [
                    'email.required' => 'Please enter valid email address',
                ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $user = User::create([
                'name' => $data['name'],
                'gender' => $data['gender'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),

                'verification_code_sending_at' => date('Y-m-d h:m:s')
            ]);

            $customer = new Customer;
            $customer->user_id = $user->id;
            $customer->save();
        }
        else {
            $user_phone = null;
            if(strlen($data['email'])==14 && strpos($data['email'],"+8801")==0 && is_numeric($data['email'])){
                $user_phone = $data['email'];
            }
            elseif (strlen($data['email'])==11 && strpos($data['email'],"01")==0  && is_numeric($data['email'])){
                $user_phone = '+88'.$data['email'];
            }

            if($user_phone != null){
                if (addon_is_activated('otp_system')){
                    $user = User::create([
                        'name' => $data['name'],
                        'gender' => $data['gender'],
                        'phone' => $user_phone,
                        'password' => Hash::make($data['password']),
                        'verification_code' => rand(100000, 999999),
                        'verification_code_sending_at' => date('Y-m-d h:m:s')
                    ]);

                    $customer = new Customer;
                    $customer->user_id = $user->id;
                    $customer->save();

                    $otpController = new OTPVerificationController;
                    $otpController->send_code($user);
                }
            }

        }

        if(session('temp_user_id') != null){
            Cart::where('temp_user_id', session('temp_user_id'))
                    ->update([
                        'user_id' => $user->id,
                        'temp_user_id' => null
            ]);

            Session::forget('temp_user_id');
        }

        if(Cookie::has('referral_code')){
            $referral_code = Cookie::get('referral_code');
            $referred_by_user = User::where('referral_code', $referral_code)->first();
            if($referred_by_user != null){
                $user->referred_by = $referred_by_user->id;
                $user->save();
            }
        }

        return $user;
    }

    public function register(Request $request)
    {
        if ($request->guest){
            $validate = $this->guestValidator($request->all());

            if ($validate->fails()) {
                if($request->ajax())
                {
                    return response()->json(['errors'=>$validate->errors()->first()]);
                }
                $this->guestValidator($request->all())->validate();

            }
            $request->merge(['name'=>null,'gender'=>null,'password'=>null]);
        }
        else {
            $this->validator($request->all())->validate();
        }


        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if(User::where('email', $request->email)->first() != null){
                flash(translate('Email already exists.'));
                return back()->withInput()->withErrors(['email' => 'Email already exists.',]);
            }
        }
        elseif (User::where('phone', '+88'.$request->email)->orWhere('phone', $request->email)->first() != null) {
            flash(translate('Phone already exists.'));
            return back()->withInput()->withErrors(['email' => 'Phone already exists.',]);
        }

//        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        $this->guard()->login($user);

        //AWS personalizer inport user data

        $personalize = new AWSPersonalizeController;
        if ($personalize){
            $request->AWSdataset = "user-dataset"??"";
            $request->AWSdata = $user??"";
            $personalize->index($request);
        }
        //AWS personalizer

        if ($request->guest && $user->email != null){
            $user->verification_code = rand(100000, 999999);
            $user->save();
            event(new Registered($user));
            flash(translate('Registration successful. Please verify your email.'))->success();
        }
        else{
            if($user->email != null){
                if(BusinessSetting::where('type', 'email_verification')->first()->value != 1){
                    $user->email_verified_at = date('Y-m-d H:m:s');
                    $user->save();
                    flash(translate('Registration successful.'))->success();
                }
                else {
                    event(new Registered($user));
                    flash(translate('Registration successful. Please verify your email.'))->success();
                }
            }
        }

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        if ($user->email == null) {
            return redirect()->route('verification');
        }elseif(session('link') != null){
            return redirect(session('link'));
        }else {
            return redirect()->route('home');
        }
    }
}
