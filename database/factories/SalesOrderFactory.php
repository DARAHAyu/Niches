<?php

namespace Database\Factories;

use App\Models\SalesOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesOrderFactory extends Factory
{
    protected $model = SalesOrder::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'sales_abstract' => $this->faker->word,
            'budget' => $this->faker->numberBetween(1000, 100000),
            'schedule' => $this->faker->date(),
        ];
    }
}
