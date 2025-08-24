<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    use HasFactory;
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
                'BatMan',
                'SuperMan',
                'WonderWoman',
                'Flash',
                'GreenLantern',
                'Aquaman',
                'Cyborg',
                'Hawkeye',
                'BlackWidow',
                'SpiderMan',
                'CaptainAmerica',
                'IronMan',
                'Thor',
                'Hulk',
                'BlackPanther',
                'DoctorStrange',
                'AntMan',
                'The Question',
                'The Riddler',
                'The Penguin',
                'Two-Face',
                'The Joker',
                'Doom',
                'AOT',
                'Manga',
                'Demon Slayer',
                'Attack on Titan',
            ]), // WE make it an array its better
        ];
    }
}
