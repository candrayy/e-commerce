<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $table = 'keranjangs';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'produk_id',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
