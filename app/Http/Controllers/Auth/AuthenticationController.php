<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\Invitation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function loginUser(Request $request)
    {
        $rules = array(
            'email' => 'required',
            'password' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 403);
        }

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->has('remember-me'));
            $user->update([
                'last_login_at' => Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->getClientIp(),
            ]);

            //redirect user to dashboard
            return redirect()->route('dashboard');

        } else {
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function registerUser(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'email' => "required|email|unique:users,email,",
            'password' => 'required|min:8',
            'password_confirmed' => 'required|min:8|same:password',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('register')->with('error', $validator->errors());
        }

        // if user already exists return error
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return redirect()->route('register')->with('error', 'User already exists');
        }
        // create new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;

        // hash password
        $user->password = Hash::make($request->password);

        // save user
        $user->save();

        // assign user role if role is not null
        if ($request->role) {
            $user->assignRole($request->role);
        } else {
            $user->assignRole('User');
        }

        if ($request->has('token')) {
            $invitation = Invitation::where('token', $request->token)->first();
            $invitation->status = 'accepted';
            $invitation->save();
        }

        //Log activity
        activity()
            ->event('created')
            ->performedOn($invitation, $user)
            ->causedBy($user)
            ->log('Invitation accepted');
        return redirect()->route('login');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        try {
            DB::beginTransaction();

            $rules = array(
                'email' => 'required|email|exists:users,email',
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()->with('error', 'Invalid email');
            }

            // Check if the email exists in the password_resets table
            $existingToken = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->first();

            // If the email exists, delete the token
            if ($existingToken) {
                DB::table('password_reset_tokens')
                    ->where('email', $request->email)
                    ->delete();
            }

            // Generate a token
            $token = md5(time() . $request->email);

            // Save the token in the password_resets table
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            // Generate a reset link
            $url = URL::temporarySignedRoute(
                'reset-password-form',
                now()->addMinutes(30),
                ['token' => $token]
            );

            // Prepare mail data
            $mailData = [
                'url' => $url,
            ];

            // Send the reset link to the user via email
            Mail::to($request->email)->send(new ResetPasswordMail($mailData));

            DB::commit();

            return back()->with('success', 'Reset link sent successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while sending the reset link');
        }
    }

    public function resetPassword($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {

        try
        {
            DB::beginTransaction();

            $rules = array(
                'token' => 'required',
                'password' => 'required|confirmed|min:8',
                'password_confirmation' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return back()->with('error', 'Invalid token');
            }

            // Find the password reset token
            $passwordResetToken = DB::table('password_reset_tokens')
                ->where('token', $request->token)
                ->first();

            // Check if the token exists
            if (!$passwordResetToken) {
                return back()->with('error', 'Invalid token');
            }

            // Check if the token has expired
            if (Carbon::parse($passwordResetToken->created_at)->addMinutes(30)->isPast()) {
                return back()->with('error', 'Token expired');
            }

            //find user
            $user = User::where('email', $passwordResetToken->email)->first();
            // Update the user's password
            $user->password = Hash::make($request->password);
            $user->save();

            // Delete the password reset token
            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->delete();

            DB::commit();

            return redirect()->route('login')->with('success', 'Password reset successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while resetting the password');
        }
    }
}
