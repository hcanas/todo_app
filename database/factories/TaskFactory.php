<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = ['pending', 'done', 'deleted'];

        return [
            'title' => $this->faker->words(rand(1,3), true),
            'description' => $this->faker->words(rand(4, 20), true),
            'status' => $status[rand(0,2)],
        ];
    }
}
