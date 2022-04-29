<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'company_id' => 1,
            'category_id' => $this->faker->numberBetween(1, 20),
            "name" => $this->faker->name,
            'code' => $this->faker->numberBetween(10000, 99999),
            'purchase_price' => '15000',
            'retail_price' => '16000',
            'wholesale_price' => '16000',
            'unit' => $this->faker->realText($maxNbChars = 10, $indexSize = 2),
            'remark' => $this->faker->realText($maxNbChars = 50, $indexSize = 2),
            'description' => $this->faker->realText($maxNbChars = 50, $indexSize = 2),


        ];
    }
}
