<?php

namespace Database\Factories;

use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderFactory extends Factory
{
    protected $model = PurchaseOrder::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'purchase_abstract' => $this->faker->word,
            'budget' => $this->faker->numberBetween(1000, 100000),
            'schedule' => $this->faker->date(),
        ];
    }
}
