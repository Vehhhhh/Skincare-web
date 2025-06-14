<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promorion extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'title',
        'main_title',
        'description',
        'video_link'
    ];
}
