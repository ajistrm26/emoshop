<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    public $primaryKey = 'id_merk';

    public $incrementing = false;

    public $timestamps = false;

    protected $table = 't_merk';

    protected $fillable = ['id_merk','nama_merk'];

    protected $keyType = 'string';
}
