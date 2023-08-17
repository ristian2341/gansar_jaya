<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $redirectTo = 'layout';

    public function index(){
        return view('auth.login');
    }

    public function logout()
    {
        Session::remove('s_username');
        Session::remove('s_superUser');
        return redirect()->back();
    }

    public function login(Request $request){
        $username = $request->user_name;
        $pass =$request->password;
      
        if ($username == '') {
            return redirect()->back()->with('alert', 'User Name tidak boleh kosong');
        }elseif($pass == ''){
            return redirect()->back()->with('alert', 'Password tidak boleh kosong');
        }else {
           
            $params = [
                'user_name' => $username,
                'password' => $pass,
            ];

            $response = Controller::RequestCurl("http://localhost/gansar-api/public/login","POST",$params);
            $data =json_decode($response);
            if(isset($data->statusCode) && $data->statusCode == 200){
                $user = $data->users;
            }
          
            if (isset($user->user_name)) {
                if ($user->password == md5($pass)) {
                    Session::put('s_username', $username);      
                    Session::put('s_superUser', $user->administrator);
                    Session::put('s_id', $user->id_user);      
                        Session::put('s_jabatan', $user->jabatan);
                        return redirect()->route('layout');
                } else {
                    return redirect()->back()->with('alert', 'Login Gagal, Password Salah');
                }
            } else {
                return redirect()->back()->with('alert', 'Login Gagal, Username atau Password Salah');
            }
        }
    }
}
