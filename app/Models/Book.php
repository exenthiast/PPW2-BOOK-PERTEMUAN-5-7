<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $casts = [
        'tgl_terbit' => 'date',
    ];
    protected $fillable = ['judul', 'pengarang', 'harga', 'tgl_terbit'];
}
