<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table ="kategoris";
    protected $primaryKey ="id";
    public $timestamp ="false";
    protected $fillable = [
        'kd_kategori', 'nama_kategori'
    ];
}
