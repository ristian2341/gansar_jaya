<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class KondisiController extends Controller
{
    protected $redirectTo = 'layout';

    public function index(){
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/kondisi","GET",[]);
        $data =json_decode($response);
        if(isset($data->statusCode) && $data->statusCode == 200){
            $data = $data->users;
        }
        
        return view('kondisi.kondisi',['data' => $data]);
    }

    public function add_data(Request $request)
    {
          
        if(count($request->all()) > 0){
            $admin = ($request->input("txtadmin") != '') ? $request->input("txtadmin") : 0;
          
            // send to api save user
             $params = [
                'kondisi' => $request->input("txtkondisi"),
            ];
         
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/add_kondisi","POST",$params);
            $data =json_decode($response);
            
            if(isset($data->statusCode) && $data->statusCode == 200){
                $message = $data->message;
                return redirect('kondisi')->with('success', 'Input data success');
            }else{
                $message = $data->message;
                return redirect()->back()->with('alert', $message);
            }
        }else{
            return view('kondisi.form');
        }
    }

    public function update($id,Request $request)
    {
        $message = "";
        if(count($request->all()) > 0){
            // send to api save user
             $params = [
                'kondisi_id' => $request->input("txtid"),
                'kondisi' => $request->input("txtkondisi"),
            ];
         
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/add_kondisi","POST",$params);
            $data =json_decode($response);
          
            if(isset($data->statusCode) && $data->statusCode == 200){
                $kondisi = $data->kondisi;
                $message = $data->message;
                return redirect('kondisi')->with('success', $message);
            }else{
                $message = $data->message;
                return redirect()->back()->with('alert', $message);
            }
        }else{
            $kondisi =[];
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/kondisi/".$id,"GET");
            $data =json_decode($response);
            if(isset($data->statusCode) && $data->statusCode == 200){
                $kondisi = $data->data;
                $message = $data->message;
            
                return view('kondisi.form_update',['data' => $kondisi]);
            }else{
                $message = $data->message;
                return redirect()->back()->with('alert', $message);
            }
        }
    }

    public function delete($id)
    {
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/delete_kondisi/". $id,"POST");
        $data =json_decode($response);
       
        if(isset($data->statusCode) && $data->statusCode == 200){
            $message = $data->message;
            return redirect()->route('kondisi')->with('success', $message);
        }else{
            $message = $data->message;
            return redirect()->back()->with('alert', $message);
        }
    }
}