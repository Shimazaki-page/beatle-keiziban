<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'contents'=>$this->faker->text(100),
            'thread_id'=>$this->faker->numberBetween(1,50),
            'comment_file_path'=>null,
        ];
    }
}
