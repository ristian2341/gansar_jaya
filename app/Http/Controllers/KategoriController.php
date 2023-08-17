<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
{
    protected $redirectTo = 'layout';

    public function index(){
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/kategori","GET",[]);
        $data =json_decode($response);
        if(isset($data->statusCode) && $data->statusCode == 200){
            $data = $data->data;
        }
        
        return view('kategori.kategori',['data' => $data]);
    }

    public function add_data(Request $request)
    {
          
        if(count($request->all()) > 0){

            $request->validate([
                'txtkategori' => 'required',
            ]);

              // send to api save user
             $params = [
                'kategori' => $request->input("txtkategori"),
            ];
         
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/add_kategori","POST",$params);
            $data =json_decode($response);
            
            if(isset($data->statusCode) && $data->statusCode == 200){
                $message = $data->message;
                return redirect('kategori')->with('success', 'Input data success');
            }else{
                $message = $data->message;
                return redirect()->back()->with('alert', $message);
            }
        }else{
            return view('kategori.form');
        }
    }

    public function update($id,Request $request)
    {
        $message = "";
        if(count($request->all()) > 0){
            // send to api save user
             $params = [
                'kategori_id' => $request->input("txtid"),
                'kategori' => $request->input("txtkategori"),
            ];
         
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/add_kategori","POST",$params);
            $data =json_decode($response);
     
            if(isset($data->statusCode) && $data->statusCode == 200){
                $kategori = $data->data;
                $message = $data->message;
                return redirect('kategori')->with('success', $message);
            }else{
                $message = $data->message;
                return redirect()->back()->with('alert', $message);
            }
        }else{
            $kategori =[];
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/kategori/".$id,"GET");
            $data =json_decode($response);
            if(isset($data->statusCode) && $data->statusCode == 200){
                $kategori = $data->data;
                $message = $data->message;
            
                return view('kategori.form_update',['data' => $kategori]);
            }else{
                $message = $data->message;
                return redirect()->back()->with('alert', $message);
            }
        }
    }

    public function delete($id)
    {
       
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/delete_kategori/". $id,"POST");
        $data =json_decode($response);
     
        if(isset($data->statusCode) && $data->statusCode == 200){
            $message = $data->message;
            return redirect()->route('kategori')->with('success', $message);
        }else{
            $message = $data->message;
            return redirect()->back()->with('alert', $message);
        }
    }
}