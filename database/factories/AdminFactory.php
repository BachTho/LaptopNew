<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Admin::class;
    public function definition()
    {
        $name = $this->faker->sentence(1);
        return [
            'name' => $name,
            'description' => $this->faker->text(),
            'user_id' => 1,
        ];
    }
}
