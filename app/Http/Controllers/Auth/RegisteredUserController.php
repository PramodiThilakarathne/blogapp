<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));


        $data['email'] = $request->email;

        $data['title'] = 'Welcome to Our Blog Community!';

        $data['body'] = "Hello,

        Thank you for registering. We are excited to have you on board. Explore, write, and share your thoughts with our vibrant community! 🪄✨
        
        
        Stay enchanted,
        
        My Blog Enchantment Team 🎭✨";
        
        Mail::send('mail\mailVerification', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'])->subject($data['title']);
        });


        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

   /* public function verification ($id)
	{
				$user = User::where('id', $id)->first(); 
				if(!$user || $user->is_verified == 1) 
					{ 
					return redirect('/');
					}
					$email = $user->email;
					
					
				$this->sendOtp($user); //OTP SEND

				return view('mail.verification', compact('email'));

	}

	public function verifiedOtp (Request $request)
	{
		$user =User::where('email', $request->email)->first();
		$otpData = EmailVerification::where('otp', $request->otp)->first();

		if(!$otpData) 
			{
			return response()->json(['success' => false, 'msg' => 'You entered wrong OTP']);
			}
		else
		{
			
			$currentTime = time();
			$time = strtotime($otpData->created_at);
			if($currentTime >= $time && $time >= $currentTime - (90 + 5))
			{
				User::where('id', $user->id)->update([ 
				'is_verified' => 1
				]);
				return response()->json(['success' => true, 'msg' => 'Mail has been verified']);
			}
			else
			{
				return response()->json(['success' => false, 'msg' => 'Your OTP has been Expired']);
			}

		}
	}


	public function sendOtp ($user) 
	{
		$otp = rand(100000, 999999);

		$time =time();

		EmailVerification::updateOrCreate(

			['email' => $user->email],

			['email' => $user->email, 

			'otp' => $otp,

			'created_at' => $time,
            
            'updated_at'=> $time]
		);
		
		$data['email'] = $user->email;

		$data['title'] = 'Mail Verification';

		$data['body'] = "Hello,

        Welcome to the Auditorium booking management system. We're delighted to have you as part of our community.
        
        To verify your account, please use the following OTP (One-Time Password):  $otp .
        
        If you didn't request this OTP or have any questions, please contact our support team. We're here to assist you.
        
        Best regards,
        The Auditorium Team";

         $super=User::where('role','superadmin')->first();
        $data['from'] =$super->email;
		$superadmin=$super->firstname;
        Mail::send('mail\mailVerification', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'])->subject($data['title']);
            $message->from($data['from'],'superadmin');
        });
	}
	public function resendOtp (Request $request)
	{
		$user = User::where('email', $request->email)->first();
		$otpData = EmailVerification::where('email', $request->email)->first(); 
		
		$currentTime = time();
		$time = strtotime($otpData->created_at); 
		if ($currentTime >= $time && $time >= $currentTime - (90 + 5)) 
		{//90 seconds 
			return response()->json(['success' => false, 'msg'=> 'Please try after some time']); 
		}
		else
		{
			$this->sendOtp($user); //OTP SEND
			return response()->json(['success' => true, 'msg'=> 'OTP has been sent']);
		}
	}*/


}
