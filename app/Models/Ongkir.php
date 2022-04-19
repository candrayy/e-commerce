<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ongkir extends Model
{
    use HasFactory;
    protected $table = 'ongkirs';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'kd_ongkir', 'ongkir'
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
