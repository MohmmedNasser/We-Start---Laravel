<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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

        $ar = fake()->unique()->words(3, true);

        $name = json_encode([
            'en' =>  $ar,
            'ar' => fake()->words(3, true),
        ], JSON_UNESCAPED_UNICODE);
        return [
            'name' => $name,
            'slug' =>  Str::slug($ar),
            'parent_id' => rand(1, 10),
        ];
    }
}
