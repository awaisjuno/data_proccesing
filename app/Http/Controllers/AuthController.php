<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\UserDetailModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $user = UserModel::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        UserDetailModel::create([
            'user_id' => $user->user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        Session::put('user_id', $user->user_id);
        return redirect('/dashboard');
    }

    public function showSigninForm()
    {
        return view('auth.signin');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = UserModel::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('user_id', $user->user_id);
            return redirect('/dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Session::forget('user_id');
        return redirect('/signin');
    }
}


?>