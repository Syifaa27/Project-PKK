<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailSewa_model;
use App\DataBarang_model;
use Validator;
use Auth; 


class DetailSewaController extends Controller
{
    public function store(Request $req)
    {
        if(Auth::user()->hak_akses=="admin"){
        $validator=Validator::make($req->all(),
            [
                'id_sewa'=>'required',
                'id_barang'=>'required',
                'qty'=>'required',
                'denda'=>'required'
            ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $harga = DataBarang_model::where('id',$req->id_barang)->first();
        $subtotal = @$harga->harga * $req->qty;

        $simpan=DetailSewa_model::create([
                'id_sewa'=>$req->id_sewa,
                'id_barang'=>$req->id_barang,
                'qty'=>$req->qty,
                'subtotal'=>$subtotal,
                'denda'=>$req->denda

        ]);
            return Response()->json(['status'=>'Data berhasil di tambahkan']);
        } else {
            return Response()->json(['status'=>'anda bukan admin']);
        }
    }

    public function update($id,Request $req)
    {
        if(Auth::user()->hak_akses=="admin"){
        $validator=Validator::make($req->all(),
        [
            'id_sewa'=>'required',
            'id_barang'=>'required',
            'qty'=>'required',
            'denda'=>'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $harga = DataBarang_model::where('id',$req->id_barang)->first();
        $subtotal = $harga->harga * $req->qty;

        $ubah=DetailSewa_model::where('id',$id)->update ([
                'id_sewa'=>$req->id_sewa,
                'id_barang'=>$req->id_barang,
                'qty'=>$req->qty,
                'subtotal'=>$subtotal,
                'denda'=>$req->denda
        ]);
            return Response()->json(['status'=>'Data Berhasil di Ubah']);
        } else {
            return Response()->json(['status'=>'anda bukan admin']);
        }
    }
    public function destroy($id)
    {   
        if(Auth::user()->hak_akses=="admin"){
        $hapus=DetailSewa_model::where('id',$id)->delete();
            return Response()->json(['status'=>'Data Berhasil di Hapuss']);
        } else {
            return Response()->json(['status'=>'anda bukan admin']);
        }
    }

    public function tampil()

    {
        
            $detail_transaksi=DetailSewa_model::get();
            return response()->json($detail_transaksi);
       {
            return response()->json(['status'=>'gagal']);

        }
    }

}
