<?php


namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class CategoryFactory extends Factory
{
    protected $model = Category::class;
    public function definition()
    {
        return [

            'category_name' => $this->faker->word,
            'status' => 1,
            'added_by' => User::all()->random()->id,
        ];
    }

}
