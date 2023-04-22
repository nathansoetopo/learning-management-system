<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassModel>
 */
class ClassModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'responsible_id' => User::role('mentor')->first()->id,
            'name' => 'Kelas '.$this->faker->name(),
            'description' => $this->faker->paragraph(),
            'capacity' => $this->faker->numberBetween(5, 30),
            'link' => 'http://127.0.0.1:8000/mentee',
            'start_time' => Carbon::now()->addDay(),
            'end_time' => Carbon::now()->addMonth(),
            'status' => 'active'
        ];
    }
}
