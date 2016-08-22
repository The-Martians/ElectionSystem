<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Crypt;

class AuthController extends Controller
{
    //Login
    public function login()
    {
        if(\Session::has('admin'))
        {
            return redirect('/admin');
        }
        return view('admin.auth.login');
    }

    //Login post data
    public function loginPost(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/login')
                ->withErrors($validator, 'login')
                ->withInput();
        }

        $login = DB::table('admins')->where(['email' => $email])->first();
        $passwordGet = $login->password;

        if ($login)
        {
            if(decrypt($passwordGet) == $password)
            {
                \Session::put('admin',$login->id);
                return redirect('/admin');
            }
           else
           {
               return redirect('/admin/login')
                   ->withErrors(array('invalid' => 'Username or password is invalid.' ), 'login');
           }
        }
        else
        {
            return redirect('/admin/login')
                ->withErrors(array('invalid' => 'Username or password is invalid.' ), 'login');
        }
    }

    //Register Admin
    public function registerAdmin()
    {
        return view('admin.auth.registerAdmin');
    }
    
    //Register post data
    public function registerAdminPost(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:admins|max:255',
            'name' => 'required|max:255|min:3',
            'password' => 'required|min:6',
            'repassword' => 'required|min:6|same:password',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/register')
                ->withErrors($validator, 'register')
                ->withInput();
        }

        DB::table('admins')->insert(
            [
                'name' => $name,
                'email' => $email,
                'password' => encrypt($password),
            ]
        );

        return redirect('/admin');
    }

    //Logout
    public function logout()
    {
        \Session::forget('admin');
        return redirect('admin/login');
    }
}
