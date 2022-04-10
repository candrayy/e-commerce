<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $primaryKey = 'id';
    public $timestamp = false;
    protected $fillable = [
        'kategori_id', 'gambar', 'kd_produk', 'nama_produk',
        'harga', 'stok', 'deskripsi', 'slug',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }
}
