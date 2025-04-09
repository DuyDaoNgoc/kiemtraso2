<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $table = 'slide'; // Đảm bảo model trỏ đúng bảng
    protected $fillable = ['image', 'title', 'description'];
}
