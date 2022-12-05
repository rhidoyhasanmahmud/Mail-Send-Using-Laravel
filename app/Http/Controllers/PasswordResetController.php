<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPassword;
use App\Mail\VerificationEmail;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PasswordResetController extends Controller
{
    public  function index()
    {
        return view('password_reset.create');
    }
    protected function forgetpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        // if validator fails
        if ($validator->fails()) {
            $notification = array('message' => 'Something Wents Wrong. Please Check Again', 'alert-type' => 'success');
            return redirect()->back()->WithErrors($validator)->withInput()->with($notification);
        }

        $email = $request->input('email');

        $verify_token = md5(rand(1, 10) . microtime());
        $isExistEmail = User::where('email', $request->email)->update(['email_verification_token' => $verify_token]);
        if ($isExistEmail) {
            $user = User::where('email', $request->email)->first();
            $user = ['full_name'=>$user->full_name, 'email_verification_token'=>$user->email_verification_token];
            Mail::send(['text'=>'mailusers.forget_password'],$user ,function($message) use ($request) {
                $message->to($request->email)->subject('Account Verification');
                $message->from(config('mail.from.address'),'E-Tax');
            });

            $notification = array('message' => 'Please check email for Password Reset.', 'alert-type' => 'success');
            return back()->with($notification);
        } else {
            session()->flash('message', 'Email Not Found.');
            session()->flash('alert_tag', 'alert-danger');
            return redirect('forget-password-page');
        }
    }
}
