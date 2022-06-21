<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GraphData;

class GraphSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        GraphData::factory()->count(730)->create();
    }
}
