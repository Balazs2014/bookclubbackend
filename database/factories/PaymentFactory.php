<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'member_id' => $this->faker->numberBetween(1, 10),
            'amount' => $this->faker->numberBetween(5, 10) * 1000,
            'paid_at' => Carbon::now()->subDays($this->faker->numberBetween(1, 10)),
        ];
    }
}
