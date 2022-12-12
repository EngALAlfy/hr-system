<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'date' => Carbon::now()->day(rand(1 , Carbon::now()->daysInMonth))->format("Y-m-d"),
            'date' => Carbon::today(),
            'branch_id' => Branch::inRandomOrder()->first()->id,
            'situation' => ['attend', 'absent'][rand(0, 1)], #الموقف
            'info' => $this->faker->paragraph(2),
            'user_id' => User::inRandomOrder()->first()->id,
            'token_by_user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
