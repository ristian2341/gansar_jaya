<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PengembalianController extends Controller
{
    protected $redirectTo = 'layout';

    public function index(){
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/pengembalian","GET",[]);
        $data =json_decode($response);
        if(isset($data->statusCode) && $data->statusCode == 200){
            $data = $data->data;
        }
       
        return view('pengembalian.pengembalian',['data' => $data]);
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
                    'nomor_pinjam' => $request->input("slpinjam"),
                    'tanggal' => $request->input("txttgl"),
                    'id_user' => Session::get('s_id'),
                    'detail' => json_encode($detail['detail']),
                ];
                $response = Controller::RequestCurl("http://localhost/gansar-api/public/add_pengembalian","POST",$params);
                $data =json_decode($response);
            
                if(isset($data->statusCode) && $data->statusCode == 200){
                    $message = $data->message;
                    $data = $data->pengembalian;
                    return redirect()->route('view_pengembalian',['id' => $data->nomor])->with('success', 'Simpan data berhasil');
                }else{
                    
                    $message = $data->message;
                    return redirect()->back()->with('error',$message);
                }
            }else{
                return redirect()->back()->with('error',"Barang belum dipilih");
            }
        }else{
            $pinjam = [];
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/pinjam_data","GET",[]);
            $pinjam =json_decode($response);
            if(isset($pinjam->statusCode) && $pinjam->statusCode == 200){
                $pinjam = $pinjam->data;
            }
            return view('pengembalian.form',['pinjams' => $pinjam,'barang' => []]);
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
                    'nomor' => $request->input("txtnomor"),
                    'nomor_pinjam' => $request->input("slpinjam"),
                    'keterangan' => $request->input("txtket"),
                    'tanggal' => $request->input("txttgl"),
                    'tgl_kembali' => $request->input("txttglest"),
                    'id_user' => Session::get('s_id'),
                    'detail' => json_encode($detail['detail']),
                ];
            
                $response = Controller::RequestCurl("http://localhost/gansar-api/public/add_pengembalian","POST",$params);
                $data =json_decode($response);
        
                if(isset($data->statusCode) && $data->statusCode == 200){
                    $message = $data->message;
                    $data = $data->pengembalian;
                    
                    return redirect()->route('view_pengembalian',['id' => $data->nomor])->with('success', 'Simpan data berhasil');
                }else{
                    $message = $data->message;
                    return redirect()->back()->with('alert', $message);
                }
            }else{
                return redirect()->back()->with('error',"Barang belum dipilih");
            }
        }else{
            $kembali =[];
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/pengembalian/".$id,"GET");
            $data =json_decode($response);
          
            if(isset($data->statusCode) && $data->statusCode == 200){
                $kembali = $data->data;
                $detail = $data->detail;
                $message = $data->message;
                
                return view('pengembalian.form_update',['data' => $kembali,'detail' => $detail]);
            }else{
                $message = $data->message;
                return redirect()->back()->with('error', $message);
            }
        }
    }

    public function delete($id)
    {
       
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/delete_pengembalian/". $id,"GET");
        $data =json_decode($response);
     
        if(isset($data->statusCode) && $data->statusCode == 200){
            $message = $data->message;
            return redirect()->route('pinjam')->with('success', $message);
        }else{
            $message = "Gagal Hapus Pinjam";
            return redirect()->back()->with('alert', $message);
        }
    }

    public function view($id)
    {
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/pengembalian/".$id,"GET");
        $data =json_decode($response);
 
        if(isset($data->statusCode) && $data->statusCode == 200){
            $pengembalian = $data->data;
            $detail = $data->detail;
            $message = $data->message;
           
            return view('pengembalian.view',['pengembalian' => $pengembalian,'detail' => $detail]);
        }else{
            $message = $data->message;
            return redirect()->back()->with('error', $message);
        }
    }

    public function approve($id)
    {
        $response = Controller::RequestCurl("http://localhost/gansar-api/public/approve_pengembalian/". $id,"GET");
        $data =json_decode($response);
        if(isset($data->statusCode) && $data->statusCode == 200){
            $message = $data->message;
            return redirect()->route('pengembalian')->with('success', $message);
        }else{
            $message = "Gagal Approve Pengembalian";
            return redirect()->route('pengembalian')->with('error', $message);
        }
    }

    public function detail_pinjam(Request $request)
    {
        $tr ="";$success = false;
        if($request->nomor_pinjam){
            $response = Controller::RequestCurl("http://localhost/gansar-api/public/barang_pinjam/". $request->nomor_pinjam,"GET");
            $data = json_decode($response);
           
            if($data->statusCode == 200){
                $success = true;
                foreach ($data->data as $key => $value) 
                {
                    $tr .= "<tr data-id_barang=".$value->id_barang." data-jml=".$value->jml.">";
                    $tr .= "<td><input type='hidden' name='barang[]' value=".$value->id_barang.">".$value->deskripsi."</td>";
                    $tr .= "<td><input type='hidden' name='qty[]' value=".$value->jml.">".$value->jml."</td>";
                    $tr .= "</td>";
                }  
            }
        }
        return ['success' => $success,'tr' => $tr];
    }

}