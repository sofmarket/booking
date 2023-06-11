<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{

    private $types = ['family', 'double', 'single'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hotel_id' => $this->random(1, 3),
            'name' => $this->faker->name(),
            'floor' => 'A1',
            'type' => $this->types[$this->random(0, count($this->types) - 1)],
            'beds' => $this->random(1, 5),
            'price' => $this->random(100, 500),
        ];
    }

    private function random($min, $max) {
        return rand($min, $max);
    }

}
