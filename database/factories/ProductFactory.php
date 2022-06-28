<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Product::class;
    public function definition()
    {
        $name = $this->faker->sentence(1);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text(),
            'content' => $this->faker->text(),
            'user_id' => 1,
            'quality' => 10,
            'discount_percent' => 10,
            'status' => 1,
            'sold' => 0,
            'origin_price' => 500.23392,
            'sale_price' => 10.9573,


        ];
    }
}
