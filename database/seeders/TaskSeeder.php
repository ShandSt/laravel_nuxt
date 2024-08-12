<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = Project::all();
        $users = User::all();

        foreach ($projects as $project) {
            Task::factory()->count(10)->create([
                'project_id' => $project->id,
                'user_id' => $users->isNotEmpty() ? $users->random()->id : null,
            ]);
        }
    }
}
