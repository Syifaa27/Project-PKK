<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sewa_model extends Model
{
    protected $table="sewa";
    protected $primaryKey="id";
    protected $fillable = [
       'id_petugas', 'id_penyewa', 'tgl_sewa','tgl_kembali'
    ];
}
