<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $fillable = ['id', 'nama', 'no_hp', 'alamat', 'level'];

}
