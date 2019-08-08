<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DJual extends Model
{
    public $primaryKey = 'id_djual';

    public $incrementing = false;

    public $timestamps = false;

    protected $table = 't_djual';

    protected $fillable = ['id_jual','id_barang','jumlah_jual','harga_jual'];

    public function jual()
    {
    	return $this->hasOne('\App\Jual', 'id_jual', 'id_jual');	
    }

    public function barang()
    {
    	return $this->hasOne('\App\Barang', 'id_barang', 'id_barang');
    }
}
