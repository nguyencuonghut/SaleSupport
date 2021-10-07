<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use app\Libraries\SpeedSMSAPI;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showOtpForm()
    {
        return view('auth.otpform');
    }

    public function sendOtp(Request $request)
    {
        $rules = array(
            'phone'    => 'required|numeric|digits:10',
        );
        $messages = [
            'phone.required' => 'Bạn phải nhập số điện thoại.',
            'phone.numeric' => 'Số điện thoại chỉ cho phép các ký tự số [0-9].',
            'phone.digits' => 'Số điện thoại phải dài 10 ký tự.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            $user = User::where('phone', $request->phone)->first();
            if($user) {
                /* Check for recent send OTP */
                if (Session::has('phone') && Carbon::now()->diffInSeconds(Session::get('timeout')) < 30) {
                    return back()->withErrors(['phone' => 'Mã OTP vừa mới gửi. Hãy thử lại sau 30s.']);
                } else {
                    /*Send OTP */
                    include(app_path() . '/Libraries/SpeedSMSAPI.php');
                    $sms = new SpeedSMSAPI("aqlhe-H54xFmnYJVpRu5CNnbz4WUUJ29");
                    $to = $request->phone;
                    $otp = random_int(100000, 999999);
                    $user->update(['otp' => $otp]);
                    //Store OTP to log
                    Log::info('OTP: '.$otp);
                    $smsContent = 'HONGHAFEED - mã xác thực của bạn là: '. $otp;
                    //Send OTP to phone
                    $sms->sendSMS([$to], $smsContent, SpeedSMSAPI::SMS_TYPE_BRANDNAME, "SPEEDSMS");

                    //Store OTP and Time to session
                    Session::put('phone', $to);
                    Session::put('timeout', Carbon::now());
                    //Redirect to next page for logging with OTP
                    return redirect()->route('showloginotpform');
                }
            } else {
                return back()->withErrors(['phone' => 'Số điện thoại chưa được đăng ký']);
            }

        }
    }

    public function showLoginOtpForm()
    {
        return view('auth.loginotpform');
    }

    public function loginOtp(Request $request)
    {
        $rules = array(
            'otp'    => 'required|numeric|digits:6',
        );
        $messages = [
            'otp.required' => 'Bạn phải nhập mã OTP.',
            'otp.numeric' => 'Mã OTP chỉ cho phép các ký tự số [0-9].',
            'otp.digits' => 'Mã OTP phải dài 6 ký tự.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            //Get phone number
            if (Session::has('phone')) {
                //Check the session timeout
                $diff = Carbon::now()->diffInSeconds(Session::get('timeout'));
                //Log::info('Time now: '. Carbon::now());
                //Log::info('Time otp: '. Session::get('timeout'));
                //Log::info('Time diff: '. $diff);
                if($diff > 5*60) {
                    return back()->withErrors(['otp' => 'Mã OTP đã hết hạn (quá 5 phút)']);
                } else {
                    //Attempt to login with OTP
                    $phone =  Session::get('phone');
                    $user = User::where([['phone', '=', $phone], ['otp', '=', $request->otp]])->first();
                    if($user) {
                        Auth::login($user);
                        $user->update(['otp' => null]);
                        Session::flash('success_message', 'Đăng nhập thành công!');
                        return redirect()->intended('/');
                    } else {
                        return back()->withErrors([
                            'otp' => 'OTP không đúng!',
                        ]);
                    }
                }
            } else {
                return back()->withErrors([
                    'otp' => 'Số điện thoại không đúng!',
                ]);
            }
        }
    }

    public function showLoginForm()
    {
        return view('auth.loginform');
    }

    public function login(Request $request)
    {
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required' // password can only be alphanumeric and has to be greater than 3 characters
        );
        $validator = Validator::make($request->all(), $rules);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();
            if (auth()->user()->type == 'Admin') {
                Session::flash('success_message', 'Đăng nhập thành công!');
                return redirect()->route('admin.policies');
            }else{
                Session::flash('success_message', 'Đăng nhập thành công!');
                return redirect()->intended('/');
            }
        }

        return back()->withErrors([
            'email' => 'Email hoặc password không đúng!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        Session::flash('success_message', 'Đăng xuất thành công!');
        return redirect('/');
    }
}
