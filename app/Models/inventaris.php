<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inventaris extends Model
{
    protected $fillable = [
        'nama', 'kategori', 'stok', 'harga'
    ];
}
