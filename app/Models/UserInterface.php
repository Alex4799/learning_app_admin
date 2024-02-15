<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInterface extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'background_color',
        'coverimage',
        'logo',
        'font_color',
        'address',
        'phone',
        'email',
        'map',
    ];
}
