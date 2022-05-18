<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\GameSetting;
use App\Models\Market;
use App\Models\MarketWebsite;
use App\Models\Website;
use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Game::query()->count() > 0) {
            return;
        }

        $rows = [
            [
                'code' => '4D',
                'title' => '4D',
            ],
            [
                'code' => '3D',
                'title' => '3D',
            ],
            [
                'code' => '2D',
                'title' => '2D',
            ],
            [
                'code' => '2DD',
                'title' => '2D Depan',
            ],
            [
                'code' => '2DT',
                'title' => '2D Tengah',
            ],
        ];


        $games = collect($rows)->map(function ($row) {
            return Game::firstOrCreate([
                'code' => $row['code']
            ], [
                'title' => $row['title'],
                'category' => null,
                'menu_id' => 4,
            ]);
        });

        $websites = Website::limit(10)->get();

        foreach ($games as $game) {
            foreach ($websites as $website) {
                $gameSetting = $game->setting()->where(['website_id' => $website->id])->first()
                    ?? GameSetting::make([
                            'game_id' => $game->id,
                            'website_id' => $website->id,
                        ]);

                $gameSetting->save();
            }
        }
    }
}
