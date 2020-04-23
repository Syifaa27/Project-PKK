<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataBarang_model;
use Validator;
use Auth;

class DataBarangController extends Controller
{
    public function store(Request $req)
    {
        if(Auth::user()->hak_akses=="admin"){
        $validator=Validator::make($req->all(),
            [
                'nama_barang'=>'required',
                'harga'=>'required',
                'keterangan'=>'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $simpan=DataBarang_model::create([
                'nama_barang'=>$req->nama_barang,
                'harga'=>$req->harga,
                'keterangan'=>$req->keterangan

                
        ]);
            return Response()->json(['status'=>'Data Berhasil Ditambahkan']);
        } else {
            return Response()->json(['status'=>'anda bukan admin']);
        }
    }

    public function update($id,Request $req)
    {
        if(Auth::user()->hak_akses=="admin"){
        $validator=Validator::make($req->all(),
        [
            'nama_barang'=>'required',
            'harga'=>'required',
            'keterangan'=>'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=DataBarang_model::where('id',$id)->update ([
            'nama_barang'=>$req->nama_barang,
            'harga'=>$req->harga,
            'keterangan'=>$req->keterangan
        ]);
            return Response()->json(['status'=>'Data Berhasil Diubah']);
        } else {
            return Response()->json(['status'=>'anda bukan admin']);
        }
    }
    public function destroy($id)
    {   
        if(Auth::user()->hak_akses=="admin"){
        $hapus=DataBarang_model::where('id',$id)->delete();
            return Response()->json(['status'=>'Data Berhasil Dihapus']);
        } else {
            return Response()->json(['status'=>'anda bukan admin']);
        }
    }

    public function tampil()

    {
            $data_barang=DataBarang_model::get();
            return response()->json($data_barang);
        {
            return response()->json(['status'=>'gagal']);

        }
    }
}
