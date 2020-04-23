<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailSewa_model extends Model
{
    protected $table="detail_sewa";
    protected $primaryKey="id";
    protected $fillable = [
       'id_sewa', 'id_barang','qty', 'subtotal','denda'
    ];
}
