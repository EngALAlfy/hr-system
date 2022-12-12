<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  \App\Models\User::factory(10)->create();
        //BranchSeeder::run();
         //ProjectSeeder::run();
        // PostSeeder::run();
        //UserRateSeeder::run();
        // UserWalletSeeder::run();
        AttendanceSeeder::run();
    }
}
