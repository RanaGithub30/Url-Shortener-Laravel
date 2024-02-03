<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlShorten extends Model
{
    use HasFactory;

    protected $table = "url_shortens";
    protected $fillable = [
        'old_url',
        'new_url'
    ];
}
