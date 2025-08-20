<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->word,
            'date' => $this->faker->date,
            'time' => $this->faker->time,
            'location' => $this->faker->unique()->word,
            'available_slots' => $this->faker->integer,
            'image' =>  asset('img/events/public/img/Events/1f7d9e863dd6ffb1eee42c150a40512c.jpg') ,
            'description' => $this->faker->text,
        ];
    }
}
