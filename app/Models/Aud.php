<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aud extends Model
{
    use HasFactory;

    protected $table = 'auds'; // Correct table name

    protected $fillable = ['file_name', 'file_path']; // Fillable attributes
}
