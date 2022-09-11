<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->words(2, true);
        $slug = Str::slug($name);
        return [
            'name' => $name,
            'slug' => $slug,
            'image' => 'default.svg',
            'order_at' => $this->faker->numberBetween(1, 30),
            'parent_id' => $this->faker->numberBetween(1, 10),
            'publish' => $this->faker->numberBetween(0, 1),
            'feature' => $this->faker->numberBetween(0, 1),
        ];
    }
}
