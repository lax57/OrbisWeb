<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getDashboard()
    {
        $courses = Auth::User()->courses;
        return view('dashboard', ['courses' => $courses]);
    }

    public function postSignUp(Request $request)
    {
        $this->validate();
        $email = $request['email'];
        $password = bcrypt($request['password']);

        $user = new User();
        $user->email = $email;
        $user->password = $password;

        $user->save();

        return redirect()->route('dashboard');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email'=> $request['email'], 'password' => $request['password']])) {
            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
