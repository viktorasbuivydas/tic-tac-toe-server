<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Game;
use Illuminate\Database\Seeder;
use App\Services\BoardService;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $games = Game::factory(3)->create()->each(function ($game) {
            $board = (new BoardService())->generateSeedBoard($game->id);
            $game->squares()->insert($board);
            foreach($board as $square){
                if($square['is_x'] !== null){
                    $game->actions()->create($square);
                    $player = $square['is_x'] ? 'X' : 'O';
                    $log_text = 'Player put ' . $player . ' on this square: x: ' . $square['x'] . ' y: ' . $square['y'];
                    $game->logs()->create(
                        [
                            "log" => $log_text
                        ]
                    );
                }
            }
        });
    }
}
