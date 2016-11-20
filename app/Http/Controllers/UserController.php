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
            'password'=>'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4',
        ]);
        $email = $request['email'];
        $password = bcrypt($request['password']);

        $user = new User();
        $user->email = $email;
        $user->password = $password;
        $user->api_token = bin2hex(random_bytes(30));

        $user->save();

        return redirect()->route('home');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required',
            'password' => 'required',
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

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email','password');

        if(Auth::attempt(['email'=> $request['email'], 'password' => $request['password']])) {
            return response()->json(['token'=>Auth::User()->api_token],200);
        }else{
            return response()->json("", 401);
        }
    }
}
