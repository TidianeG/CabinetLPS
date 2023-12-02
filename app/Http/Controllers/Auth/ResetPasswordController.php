<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function updatePasswordProfile(Request $request){
        //dd($request);
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email',$email)->update(['password'=>Hash::make($password)]);

        if (isset($user)) {
            Auth::logout();
            return redirect('/');
        }
        else {
            return redirect()->back()->with(['error'=>'Erreur']);
        }

    }

    public function updatePasswordUserCM(Request $request){
        //dd($request);
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email',$email)->update(['password'=>Hash::make($password)]);

        if (isset($user)) {
            return redirect()->back()->with(['success'=>'Mot de passe modifié!!!']);
        }
        else {
            return redirect()->back()->with(['error'=>'Erreur']);
        }

    }
}
