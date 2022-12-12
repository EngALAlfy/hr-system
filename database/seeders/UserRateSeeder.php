<?php

namespace Database\Seeders;

use App\Models\UserRate;
use Illuminate\Database\Seeder;

class UserRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRate::factory(100)->create();
    }
}
