<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class LapBarangController extends Controller
{
    protected $redirectTo = 'layout';

    public function index(){
        $data = [];
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/laporan_barang","GET",[]);
        $data =json_decode($response);
        if(isset($data->statusCode) && $data->statusCode == 200){
            $data = $data->data;
        }
     
        return view('lapbarang.lapbarang',['data' => $data]);
    }

    public function add_data(Request $request)
    {
          
        if(count($request->all()) > 0){
         
                // send to api save user
             $params = [
                'tanggal' => $request->input("txttgl"),
                'keterangan' => $request->input("txtket"),
                'kondisi' => $request->input("slkondisi"),
                'id_barang' => $request->input("txtbarang"),
                'jml' => $request->input("txtjml"),
            ];
          
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/add_labbarang","POST",$params);
            $data =json_decode($response);
            if(isset($data->statusCode) && $data->statusCode == 200){
                $message = $data->message;
                $data = $data->LapBarang;
                return redirect()->route('view_lapbarang',['id' => $data->nomor])->with('success', 'Simpan data berhasil');
            }else{
                $message = $data->message;
                return redirect()->back()->with('alert', $message);
            }
        }else{
            $kategori = []; 

            $response = Controller::RequestCurl("http://localhost/gansar-api/public/barang_ready","GET",[]);
            $barang =json_decode($response);
            if(isset($barang->statusCode) && $barang->statusCode == 200){
                $barang = $barang->data;
            }
           
            return view('lapbarang.form',['barang' => $barang]);
        }
    }

    public function update($id,Request $request)
    {
        $message = "";
        if(count($request->all()) > 0){
            // send to api save user
            $params = [
                'nomor' => $request->input("txtnomor"),
                'tanggal' => $request->input("txttgl"),
                'keterangan' => $request->input("txtket"),
                'kondisi' => $request->input("slkondisi"),
                'id_barang' => $request->input("txtbarang"),
                'jml' => $request->input("txtjml"),
            ];
      
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/add_labbarang","POST",$params);
            $data =json_decode($response);
            if(isset($data->statusCode) && $data->statusCode == 200){
                $message = $data->message;
                $data = $data->LapBarang;
             
                return redirect()->route('view_lapbarang',['id' => $data->nomor])->with('success', $message);
            }else{
                $message = $data->message;
                return redirect()->back()->with('error', $message);
            }
        }else{
            // ambil data laporan //
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/search_laporan/".$id,"GET");
            $data =json_decode($response);
            if(isset($data->statusCode) && $data->statusCode == 200){
                $lap_barang = $data->data;
            }

            $barang =[];
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/barang_ready","GET",[]);
            $barang =json_decode($response);
            
            return view('lapbarang.form_update',['barang' => $barang,'lap_barang' => $lap_barang]);
        }
    }

    public function delete($id)
    {
       
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/delete_labbarang/". $id,"GET");
        $data =json_decode($response);
        
        if(isset($data->statusCode) && $data->statusCode == 200){
            $message = $data->message;
           
            return redirect()->route('lap_barang')->with('success', $message);
        }else{
            $message = "Gagal Hapus Barang";
            return redirect()->back()->with('error', $message);
        }
    }

    public function view($id)
    {
        $message ="";
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/search_laporan/".$id,"GET");
        $data =json_decode($response);
        if(isset($data->statusCode) && $data->statusCode == 200){
            $message = $data->message;  
            $data = $data->data;
            return view('lapbarang.view',['data' => $data,'message' => $message]);
        }else{
            $message = $data->message;
            return redirect()->back()->with('error', $message);
        }
    }

    public function approve($id)
    {
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/approve_labbarang/". $id,"GET");
        $data =json_decode($response);
         if(isset($data->statusCode) && $data->statusCode == 200){
            $message = $data->message;
            return redirect()->route('lap_barang')->with('success', $message);
        }else{
            $message = "Gagal Approve Laporan";
            return redirect()->route('lap_barang')->with('error', $message);
        }
    }

}