<?php

namespace App\Services;

use Illuminate\Support\Str;

class GameService{

    public function generateUid(){
        return Str::uuid()->toString();
    }
}
