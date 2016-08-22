<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class AuthController extends Controller
{
    //Login
    public function login()
    {
        if(\Session::has('user'))
        {
            return redirect('/election');
        }
        return view('user.auth.login');
    }

    //Login post data
    public function loginPost(Request $request)
    {
        $sid = $request->input('stuid');
        $password = $request->input('password');

        $validator = Validator::make($request->all(), [
            'stuid' => 'required|max:255',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect('/login')
                ->withErrors($validator, 'login')
                ->withInput();
        }

        $login = DB::table('users')->where(['stuId' => $sid])->first();
        $passwordGet = $login->password;

        if ($login)
        {
            if(decrypt($passwordGet) == $password)
            {
                \Session::put('user',$login->id);
                return redirect('/');
            }
            else
            {
                return redirect('/login')
                    ->withErrors(array('invalid' => 'Username or password is invalid.' ), 'login');
            }
        }
        else
        {
            return redirect('/login')
                ->withErrors(array('invalid' => 'Username or password is invalid.' ), 'login');
        }
    }

    //Logout
    public function logout()
    {
        \Session::forget('user');
        return redirect('/login');
    }
}
