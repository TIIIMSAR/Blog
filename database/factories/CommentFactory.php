<?php

namespace Database\Factories;

use App\Models\Commet;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 2,   
            'post_id' => 1,   
            'comment_id' => 1,   
            'content' => $this->faker->text(),
            'is_approved' => $this->faker->boolean(),
        ];
    }
}
