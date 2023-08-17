<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $redirectTo = 'layout';

    public function index(){
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/user","GET",[]);
        $data =json_decode($response);
        if(isset($data->statusCode) && $data->statusCode == 200){
            $data = $data->users;
        }
        
        return view('user.user',['data_user' => $data]);
    }

    public function add_user(Request $request)
    {
          
        if(count($request->all()) > 0){
            $admin = ($request->input("txtadmin") != '') ? $request->input("txtadmin") : 0;
          
            // send to api save user
             $params = [
                'nama' => $request->input("txtname"),
                'wa' => $request->input("txtwa"),
                'jabatan' => $request->input("txtjabatan"),
                'user_name' => $request->input("txtusername"),
                'password'=> $request->input("txtpass"),
                'administrator'=> $admin,
            ];
         
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/add_user","POST",$params);
            $data =json_decode($response);
            
            if(isset($data->statusCode) && $data->statusCode == 200){
                $message = $data->message;
                return redirect('user')->with('success', 'Berhasil Hapus data');
            }else{
                $message = $data->message;
                return redirect()->back()->with('alert', $message);
            }
        }else{
            return view('user.form');
        }
    }

    public function update_user($id,Request $request)
    {
        $message = "";
        if(count($request->all()) > 0){
            $admin = ($request->input("txtadmin") != '') ? $request->input("txtadmin") : 0;
           
            // send to api save user
             $params = [
                'id_user' => $request->input("txtid"),
                'nama' => $request->input("txtname"),
                'jabatan' => $request->input("txtjabatan"),
                'wa' => $request->input("txtwa"),
                'user_name' => $request->input("txtusername"),
                'password'=> $request->input("txtpass"),
                'administrator'=> $admin,
            ];
            
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/add_user","POST",$params);
            $data =json_decode($response);
            
            if(isset($data->statusCode) && $data->statusCode == 200){
                $user = $data->user;
                $message = $data->message;
                return redirect('user')->with('success', $message);
            }else{
                $message = $data->message;
                return redirect()->back()->with('alert', $message);
            }
        }else{
            $user =[];
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/user_id/".$id,"GET");
            $data =json_decode($response);
           
            if(isset($data->statusCode) && $data->statusCode == 200){
                $user = $data->users;
                $message = $data->message;
               
                return view('user.form_update',['data' => $user]);
            }else{
                $message = $data->message;
                return redirect()->back()->with('alert', $message);
            }
        }
    }

    public function delete_user($id)
    {
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/delete/". $id,"POST");
        $data =json_decode($response);
       
        if(isset($data->statusCode) && $data->statusCode == 200){
            $message = $data->message;
            return redirect('user')->with('success', $message);
        }else{
            $message = $data->message;
            return redirect('user')->back()->with('alert', $message);
        }

        return redirect()->route('user');
    }
}