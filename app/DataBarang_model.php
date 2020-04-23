<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataBarang_model extends Model
{
    protected $table="data_barang";
    protected $primaryKey="id";
    protected $fillable = [
       'nama_barang', 'harga','keterangan'
    ];
}
