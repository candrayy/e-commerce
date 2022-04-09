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
    protected $fillable = [
        'id_user', 'ongkir', 'total', 'status',
        'resi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
