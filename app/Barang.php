<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    public $primaryKey = 'id_barang';

    public $incrementing = false;

    public $timestamps = false;

    protected $table = 't_barang';

    protected $fillable = ['id_barang','nama_barang','jumlah_barang','harga','id_merk'];

    protected $keyType = 'string';

    public function merk()
    {
    	return $this->hasOne('\App\Merk', 'id_merk', 'id_merk');
    }
}
