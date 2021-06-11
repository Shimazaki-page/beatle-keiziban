<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThreadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Thread::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->text(100),
            'contents'=>$this->faker->text(100),
            'name'=>$this->faker->name,
            'category_id'=>$this->faker->numberBetween(1,4),
            'thread_file_path'=>null,
        ];
    }
}
