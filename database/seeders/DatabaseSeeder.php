<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $users =  User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $tags  = Tag::factory(5)->create();

        // Create questions with answers & tags
        Question::factory()
            ->count(10)
            ->for($users->random())
            ->has(
                Answer::factory()
                    ->count(5)
                    ->state(function () use ($users) {
                        return [
                            'user_id' => $users->random()->id,
                            'is_best' => false,
                        ];
                    }),
                'answers'
            )
            ->afterCreating(function (Question $question) use ($tags) {
                // Mark one answer as best
                $answer = $question->answers()->inRandomOrder()->first();
                if ($answer) {
                    $answer->update(['is_best' => true]);
                }

                $question->tags()->attach(
                    $tags->random(rand(1, 3))->pluck('id')
                );
            })
            ->create();
    }
}
