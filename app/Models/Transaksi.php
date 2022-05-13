<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksis';
    protected $primaryKey = 'id';
    public $timestamp = false;
    protected $casts = [
        'nama_produk' => 'array',
    ];
    protected $fillable = [
        'user_id', 'alamat', 'provinsi', 'kota', 'kode_pos', 'nama_produk', 'ongkir_id', 'qty', 'total', 'status',
        'resi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ongkir()
    {
        return $this->belongsTo(Ongkir::class);
    }
}
