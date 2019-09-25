<?php

use App\Color;
use Illuminate\Database\Seeder;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Color::create([
                'name' => 'بدون رنگ',
                'nameCode' => '-1',
            ]
        );
        Color::create([
                'name' => 'بنفش',
                'nameCode' => '#6d3392',
            ]
        );
        Color::create([
                'name' => 'آبی',
                'nameCode' => '#1e90ff',
            ]
        );
        Color::create([
                'name' => 'زرد',
                'nameCode' => '#edba4b',
            ]
        );
        Color::create([
                'name' => 'قرمز',
                'nameCode' => '#ff2d2d',
            ]
        );
        Color::create([
                'name' => 'مشکی',
                'nameCode' => '#21191d',
            ]
        );
        Color::create([
                'name' => 'نارنجی',
                'nameCode' => '#f29c2b',
            ]
        );
        Color::create([
                'name' => 'سفید',
                'nameCode' => '#ffffff',
            ]
        );
        Color::create([
                'name' => 'سبز',
                'nameCode' => '#32a817',
            ]
        );
    }
}
