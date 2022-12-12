<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $branch_id = Branch::inRandomOrder()->first()->id;
        $project = Project::where('branch_id' , $branch_id)->inRandomOrder()->first();

        while($project == null){
            $branch_id = Branch::inRandomOrder()->first()->id;
            $project = Project::where('branch_id' , $branch_id)->inRandomOrder()->first();
        }

        return [
            'title' => $this->faker->word(),
            'photo' => 'bg-title-02.jpg',
            'info' => $this->faker->paragraph(2),
            'branch_id' => $branch_id,
            'project_id' => $project->id,
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
