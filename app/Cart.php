<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $primaryKey = 'id_cart';

    public $incrementing = false;

    public $timestamps = false;

    protected $table = 't_cart';

    protected $fillable = ['id_cart','id_barang','jumlah_cart','harga_cart','id_user'];

    public function barang()
    {
    	return $this->hasOne('\App\Barang', 'id_barang', 'id_barang');
    }

    public function User()
    {
    	return $this->hasOne('\App\User', 'id', 'id_user');	
    }
}
