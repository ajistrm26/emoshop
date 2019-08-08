<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jual extends Model
{
    public $primaryKey = 'id_jual';

    public $incrementing = false;

    public $timestamps = false;

    protected $table = 't_jual';

    protected $fillable = ['id_jual','tgl_jual','harga_total','id_user'];

    public function User()
    {
    	return $this->hasOne('\App\User', 'id', 'id_user');	
    }
}
