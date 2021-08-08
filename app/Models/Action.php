<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = ['is_x', 'game_id'];

    protected $casts = [
        'is_x' => 'boolean',
    ];
}
