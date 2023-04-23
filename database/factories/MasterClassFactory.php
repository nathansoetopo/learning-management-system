<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterClass>
 */
class MasterClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'slug' => Str::slug($this->faker->name()),
            'price' => $this->faker->numberBetween(50000, 400000),
            'description' => $this->faker->paragraph(),
            'duration' => 12,
            'image' => $this->faker->imageUrl(800, 600),
            // 'active_dashboard' => $this->faker->randomElement([true, false]),
            'status' => 'active'
        ];
    }
}
