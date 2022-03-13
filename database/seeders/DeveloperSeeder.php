<?php

namespace Database\Seeders;

use App\Models\Developer;
use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $devs = [
            ['name'=> "dev_1", 'level'=> 1],
            ['name'=> "dev_2", 'level'=> 2],
            ['name'=> "dev_3", 'level'=> 3],
            ['name'=> "dev_4", 'level'=> 4],
            ['name'=> "dev_5", 'level'=> 5]
        ];

        Developer::insert($devs);
    }
}
