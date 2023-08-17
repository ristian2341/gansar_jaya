<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PinjamController extends Controller
{
    protected $redirectTo = 'layout';

    public function index(){
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/pinjam","GET",[]);
        $data =json_decode($response);
        if(isset($data->statusCode) && $data->statusCode == 200){
            $data = $data->data;
        }
        
        return view('pinjam.pinjam',['data' => $data]);
    }

    public function add_data(Request $request)
    {
        if(count($request->all()) > 0){
            ini_set('memory_limit', '2048M');
            if(isset($request->barang)){
                // send to api save user
                $detail=[];
                foreach ($request->barang as $key => $barang) {
                    $detail['detail'][] = [
                        'id_barang' => $request->input('barang')[$key],
                        'qty' => $request->input('qty')[$key],
                    ];
                }
                
                $params = [
                    'keterangan' => $request->input("txtket"),
                    'tanggal' => $request->input("txttgl"),
                    'tgl_kembali' => $request->input("txttglest"),
                    'id_user' => Session::get('s_id'),
                    'detail' => json_encode($detail['detail']),
                ];
                
                $response = Controller::RequestCurl("http://localhost/gansar-api/public/add_pinjam","POST",$params);
                $data =json_decode($response);
              
                if(isset($data->statusCode) && $data->statusCode == 200){
                    $message = $data->message;
                    $data = $data->pinjam;
                    return redirect()->route('view_pinjam',['id' => $data->nomor_pinjam])->with('success', 'Simpan data berhasil');
                }else{
                    
                    $message = $data->message;
                    return redirect()->back()->with('error',$message);
                }
            }else{
                return redirect()->back()->with('error',"Barang belum dipilih");
            }
        }else{
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/barang_ready","GET",[]);
            $barang =json_decode($response);
            if(isset($barang->statusCode) && $barang->statusCode == 200){
                $barang = $barang->data;
            }
          
            return view('pinjam.form',['barang' => $barang]);
        }
    }

    public function update($id,Request $request)
    {
        $message = "";
        if(count($request->all()) > 0){
            ini_set('memory_limit', '2048M');
            if(isset($request->barang)){
                // send to api save user
                $detail=[];
                foreach ($request->barang as $key => $barang) {
                    $detail['detail'][] = [
                        'id_barang' => $request->input('barang')[$key],
                        'qty' => $request->input('qty')[$key],
                    ];
                }

                // send to api save user
                $params = [
                    'nomor_pinjam' => $id,
                    'keterangan' => $request->input("txtket"),
                    'tanggal' => $request->input("txttgl"),
                    'tgl_kembali' => $request->input("txttglest"),
                    'id_user' => Session::get('s_id'),
                    'detail' => json_encode($detail['detail']),
                ];
            
                $response = Controller::RequestCurl("http://localhost/gansar-api/public/add_pinjam","POST",$params);
                $data =json_decode($response);
        
                if(isset($data->statusCode) && $data->statusCode == 200){
                    $kategori = $data->data;
                    $message = $data->message;
                    return redirect()->route('pinjam')->with('success', 'Update data berhasil');
                }else{
                    $message = $data->message;
                    return redirect()->back()->with('alert', $message);
                }
            }else{
                return redirect()->back()->with('error',"Barang belum dipilih");
            }
        }else{
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/barang","GET",[]);
            $barang =json_decode($response);
            if(isset($barang->statusCode) && $barang->statusCode == 200){
                $barang = $barang->data;
            }
           
            $pinjam =[];
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/pinjam/".$id,"GET");
            $data =json_decode($response);
          
            if(isset($data->statusCode) && $data->statusCode == 200){
                $pinjam = $data->data;
                $detail = $data->detail;
                $message = $data->message;
                
                return view('pinjam.form_update',['pinjam' => $pinjam,'detail' => $detail,'barang' => $barang]);
            }else{
                $message = $data->message;
                return redirect()->back()->with('error', $message);
            }
        }
    }

    public function delete($id)
    {
       
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/delete_pinjam/". $id,"GET");
        $data =json_decode($response);
     
        if(isset($data->statusCode) && $data->statusCode == 200){
            $message = $data->message;
            return redirect()->route('pinjam')->with('success', $message);
        }else{
            $message = "Gagal Hapus Pinjam";
            return redirect()->back()->with('error', $message);
        }
    }

    public function view($id)
    {
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/pinjam/".$id,"GET");
        $data =json_decode($response);
        if(isset($data->statusCode) && $data->statusCode == 200){
            $pinjam = $data->data;
            $detail = $data->detail;
            $message = $data->message;
           
            return view('pinjam.view',['pinjam' => $pinjam,'detail' => $detail]);
        }else{
            $message = $data->message;
            return redirect()->back()->with('error', $message);
        }
    }

    public function approve($id)
    {
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/approve_pinjam/". $id,"GET");
        $data =json_decode($response);
       
        if(isset($data->statusCode) && $data->statusCode == 200){
            $message = $data->message;
            return redirect()->route('pinjam')->with('success', $message);
        }else{
            $message = "Gagal Approve Pinjam";
            return redirect()->route('pinjam')->with('error', $message);
        }
    }

}