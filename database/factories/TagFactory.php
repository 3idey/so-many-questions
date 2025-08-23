<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'php',
                'laravel',
                'mysql',
                'javascript',
                'vue',
                'react',
                'api',
                'backend',
                'frontend',
                'database',
                'html',
                'css',
                'tailwind',
                'bootstrap',
                'materialize',
                'design',
            ]), // WE make it an array its better
        ];
    }
}
