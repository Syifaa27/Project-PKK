<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sewa_model;
use Validator;
use Auth;
use DB;


class SewaController extends Controller
{
    public function store(Request $req)
    {
       
        $validator=Validator::make($req->all(),
            [
                'id_petugas'=>'required',
                'id_penyewa'=>'required',
                'tgl_sewa'=>'required',
                'tgl_kembali'=>'required'
            ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $simpan=Sewa_model::create([
                'id_petugas'=>$req->id_petugas,
                'id_penyewa'=>$req->id_penyewa,
                'tgl_sewa'=>$req->tgl_sewa,
                'tgl_kembali'=>$req->tgl_kembali                
        ]);
            return Response()->json(['status'=>'Data Berhasil Ditambahkan']);
         {
            return Response()->json(['status'=>'Gagal']);
        }
    }
    
//    public function getSewa(Request $r){
         
//           $sewa = DB::table('sewa')
//           ->join('pelanggan', 'pelanggan.id', '=', 'sewa.id_pelanggan')
//           ->join('petugas', 'petugas.id', '=', 'sewa.id_petugas')
//           ->where('tgl_sewa', '>=', $r->tgl_sewa)
//           ->where('tgl_kembali', '<=', $r->tgl_kembali)
//           ->select('sewa.tgl_sewa', 'pelanggan.nama', 'pelanggan.alamat', 'pelanggan.telp',
//                   'sewa.tgl_selesai', 'sewa.id')
//           ->get();
    
//           $hasil = array();
    
//           foreach ($sewa as $t){
//             $grand = DB::table('detail_sewa')
//             ->where('id_sewa', '=', $t->id)
//             ->groupBy('id_sewa')
//             ->select(DB::raw('sum(subtotal) as grandtotal'))
//             ->first();
    
//             $detail = DB::table('detail_sewa')
//             ->join('data_barang', 'data_barang.id', '=', 'detail_sewa.id_barang')
//             ->where('id_sewa', '=', $t->id)
//             ->select('detail_sewa.*', 'data_barang.*')
//             ->get();
    
//             $hasil2 = array();
    
//             foreach ($detail as $d){
//               $hasil2[] = array(
//                 'id sewa' => $d->id_sewa,
//                 'Data Barang' => $d->nama_barang,
//                 'qty' => $d->qty,
//                 'subtotal' => $d->subtotal,
//                 'denda' => $d->denda
//               );
//             }
    
//             $hasil[] = array(
//               'tgl sewa' => $t->id_sewa,
//               'nama' => $t->nama,
//               'alamat' => $t->alamat,
//               'telp' => $t->telp,
//               'tgl kembali' => $t->tgl_kembali,
//               'total transaksi' => $grand,
//               'detail transaksi' => $hasil2,
//             );
//           }
    
//           return response()->json(compact('hasil'));
    
//         {
//           echo "Gagal!";
//         }
//       }

    public function update($id,Request $req)
    {
        if(Auth::user()->hak_akses=="admin"){
        $validator=Validator::make($req->all(),
        [
            'id_petugas'=>'required',
                'id_penyewa'=>'required',
                'tgl_sewa'=>'required',
                'tgl_kembali'=>'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=Sewa_model::where('id',$id)->update ([
            'id_petugas'=>$req->id_petugas,
            'id_penyewa'=>$req->id_penyewa,
            'tgl_sewa'=>$req->tgl_sewa,
            'tgl_kembali'=>$req->tgl_kembali 
        ]);
            return Response()->json(['status'=>'Data Berhasil Di Ubah']);
         } else {
            return Response()->json(['status'=>'Anda Bukan Admin']);
        }
    }
    public function destroy($id)
    {   
        if(Auth::user()->hak_akses=="admin"){
        $hapus=Sewa_model::where('id',$id)->delete();
            return Response()->json(['status'=>'Data Berhasil Di Hapus']);
        } else {
            return Response()->json(['status'=>'Anda Bukan Admin']);
        }
    }

    public function tampil()

    {
            $dt_sewa=Sewa_model::get();
            return response()->json($dt_sewa);
        {
            return response()->json(['status'=>'Gagal']);

        }
    }

}
