<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->optional()->date,
            'status' => $this->faker->randomElement(['ToDo', 'In Progress', 'Done']),
        ];
    }
}
