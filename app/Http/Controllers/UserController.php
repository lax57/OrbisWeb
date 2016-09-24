<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'email'=>'required|email|unique:users',
            'password'=>'required|min:4'
        ]);
        $email = $request['email'];
        $password = bcrypt($request['password']);

        $user = new User();
        $user->email = $email;
        $user->password = $password;

        $user->save();

        return redirect()->route('user_courses');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email'=> $request['email'], 'password' => $request['password']])) {
            return redirect()->route('user_courses');
        }
        return redirect()->back();
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
