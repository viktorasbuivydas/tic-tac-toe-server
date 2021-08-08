<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['uid', 'is_finished', 'winning_moves'];

    protected $casts = [
        'is_finished' => 'boolean',
        'winning_moves' => 'array'
    ];

    public $timestamps = false;

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function squares()
    {
        return $this->hasMany(Board::class);
    }

    public function square()
    {
        return $this->hasOne(Board::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    public function lastAction()
    {
        return $this->hasOne(Action::class)->latest();
    }
}
