<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['x', 'y', 'is_x', 'game_id'];
    protected $casts = [
        'is_x' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
