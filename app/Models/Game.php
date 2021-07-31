<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['uid'];

    public $timestamps = false;
    public function squares(){
        return $this->hasMany(Board::class);
    }
}
