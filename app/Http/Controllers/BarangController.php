<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Exports\ViewExporterBarang;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    protected $redirectTo = 'layout';

    public function index(){
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/barang","GET",[]);
        $data =json_decode($response);
        if(isset($data->statusCode) && $data->statusCode == 200){
            $data = $data->data;
        }
        
        return view('barang.barang',['data' => $data]);
    }

    public function add_data(Request $request)
    {
          
        if(count($request->all()) > 0){

            $request->validate([
                'txtdesc' => 'required',
            ]);
                // send to api save user
             $params = [
                'deskripsi' => $request->input("txtdesc"),
                'kategori_id' => $request->input("txtkategori"),
                'kondisi_id' => $request->input("txtkondisi"),
                'jml' => $request->input("txtjml"),
            ];
         
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/add_barang","POST",$params);
            $data =json_decode($response);
            
            if(isset($data->statusCode) && $data->statusCode == 200){
                $message = $data->message;
                return redirect()->route('barang')->with('success', $message);
            }else{
                $message = $data->message;
                return redirect()->back()->with('alert', $message);
            }
        }else{
            $kategori = []; $kondisi = [];
            // ambil data katogori //
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/kategori","GET",[]);
            $data =json_decode($response);
            if(isset($data->statusCode) && $data->statusCode == 200){
                $kategori = $data->data;
            }

            // ambil data kondisi //
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/kondisi","GET",[]);
            $data =json_decode($response);
            $data = $data->data;
           
            return view('barang.form',['kategori' => $kategori,'kondisi' => $data]);
        }
    }

    public function update($id,Request $request)
    {
        $message = "";
        if(count($request->all()) > 0){
            // send to api save user
            $params = [
                'id_barang' => $request->input("txtid"),
                'deskripsi' => $request->input("txtdesc"),
                'kategori_id' => $request->input("txtkategori"),
                'kondisi_id' => $request->input("txtkondisi"),
                'jml' => $request->input("txtjml"),
            ];
         
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/add_barang","POST",$params);
            $data =json_decode($response);
     
            if(isset($data->statusCode) && $data->statusCode == 200){
                $kategori = $data->data;
                $message = $data->message;
                return redirect()->route('barang')->with('success', $message);
            }else{
                $message = $data->message;
                return redirect()->back()->with('alert', $message);
            }
        }else{
            $kategori = []; $kondisi = [];
            // ambil data katogori //
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/kategori","GET",[]);
            $data =json_decode($response);
            if(isset($data->statusCode) && $data->statusCode == 200){
                $kategori = $data->data;
            }

            // ambil data kondisi //
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/kondisi","GET",[]);
            $data =json_decode($response);
            $kondisi = $data->data;

            $barang =[];
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/barang/".$id,"GET");
            $data =json_decode($response);
           
            if(isset($data->statusCode) && $data->statusCode == 200){
                $barang = $data->data;
                $message = $data->message;
              
                return view('barang.form_update',['data' => $barang,'kategori' => $kategori,'kondisi' => $kondisi]);
            }else{
                $message = $data->message;
                return redirect()->back()->with('alert', $message);
            }
        }
    }

    public function delete($id)
    {
       
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/delete_barang/". $id,"POST");
        $data =json_decode($response);
     
        if(isset($data->statusCode) && $data->statusCode == 200){
            $message = $data->message;
            return redirect()->route('barang')->with('success', $message);
        }else{
            $message = "Gagal Hapus Barang";
            return redirect()->back()->with('alert', $message);
        }
    }

    public function export_barang()
    {
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/barang","GET",[]);
        $data =json_decode($response);
        if(isset($data->statusCode) && $data->statusCode == 200){
            $data = $data->data;
        }

        return Excel::download(
            new ViewExporterBarang($data),
            'barang.xls'
        );
    }
}